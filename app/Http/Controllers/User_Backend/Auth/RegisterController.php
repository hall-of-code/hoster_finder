<?php

namespace App\Http\Controllers\User_Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use HCaptcha\HCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    //shows register page for /u/register
    public function show_register_page()
    {
        return view('User_Backend.Auth.register');
    }

    //checks if user already exists, when yes return True, when not return False.
    public function check_if_user_already_exists(string $username, string $email) :bool
    {
        if (User::where('username', $username)->count() != 0 or User::where('email', $email)->count() != 0)
        {
            return True;
        }
        return False;
    }

    //makes the Register Process
    public function registerNormalUser(): \Illuminate\Http\RedirectResponse
    {
        Request()->validate([
            'username' => 'required|min:4|unique',
            'password' => 'required|min:12',
            'email' => 'required|email',
        ]);

        $hcaptcha = new HCaptcha(env('H_CAPTCHA_TOKEN'));
        $resp = $hcaptcha->verify(Request()->get('h-captcha-response'), Request()->ip());
        if (!$resp->isSuccess()) {
            return redirect()->back()->withErrors(['Invalid Captcha Error']);
        }

        if($this->check_if_user_already_exists() == True)
        {
            return redirect()->back()->withErrors([__('User mit der Email oder dem Username existiert berreits.')]);
        }
        $new_user_data =  (object) [];
        $new_user_data->username = Request()->get('username');
        $new_user_data->role = 0;
        $new_user_data->email = Request()->get('email');
        $new_user_data->password = Request()->get('password');
        $this->create_new_user($new_user_data);
        $loginHandler = new LoginController();
        return $loginHandler->login_user(['email' => Request()->get('email'), 'password' => Request()->get('password')], Request()->get('remember')); //makes the login process;
    }

    public function create_new_user($new_user_data) :int
    {
        $in = new User();
        $in->username   = $new_user_data->username;
        $in->role       = $new_user_data->role;
        $in->email      = $new_user_data->email;
        $in->password   = Hash::make($new_user_data->password);
        $in->method_typ = $new_user_data->method_typ ?? 0;
        $in->method_val = Hash::make($new_user_data->method_val) ?? 0;
        $in->avatar_url = $new_user_data->avatar_url ?? asset('/res/images/logo.png');
        $in->save();
        return 0;
    }
}
