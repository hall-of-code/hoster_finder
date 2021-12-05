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

    //makes the Register Process
    public function make_register_user()
    {
        Request()->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:8',
            'email' => 'required|email',
        ]);

        $hcaptcha = new HCaptcha(env('H_CAPTCHA_TOKEN'));
        $resp = $hcaptcha->verify(Request()->get('h-captcha-response'), Request()->ip());
        if (!$resp->isSuccess()) {
            return redirect()->back()->withErrors(['Invalid Captcha Error']);
        }

        //proof if user with that mail exists
        $user_name = User::where('username', Request()->get('username'))->count();
        $user_mail = User::where('email', Request()->get('email'))->count();
        if(($user_name + $user_mail) > 0)
        {
            return redirect()->back()->withErrors(['username' => 'Ein Account mit dem Benutzernamen oder der E-Mail Adresse exestiert berreits.']);
        }
        $new_user_data =  (object) [];
        $new_user_data->username = Request()->get('username');
        $new_user_data->role = 0;
        $new_user_data->email = Request()->get('email');
        $new_user_data->password = Request()->get('password');
        $this->create_new_user($new_user_data);
        return $this->login_after_register(['email' => Request()->get('email'), 'password' => Request()->get('password')]); //makes the login process;
    }


    //[gets the method and redirect to given Provider, data stored in config/services.php]
    public function make_register_socialite_redirect($locale, $method = 1)
    {
        switch ($method)
        {
            case (1):
                //google
                return Socialite::driver('google')->redirect();
                break;
            case (2):
                //github
                return Socialite::driver('github')->redirect();
                break;
        }
        return redirect()->back()->withErrors([ __('Ein unerwarteter Fehler ist aufgetreten.') ]);
    }

    public function make_register_socialite_proceed($locale, $method = 1): \Illuminate\Http\RedirectResponse
    {
        switch ($method)
        {
            case (1):
                //google
                $user_data = Socialite::driver('google')->user();
                if(User::where('email', $user_data->getEmail())->count() > 0)
                {
                    return redirect()->route('user.register_page', ['locale' => \request()->route()->locale])->withErrors([__('Es existiert berreits ein Account mit dieser Email.')]);
                }
                else
                {
                    $new_user_data = (object) [];
                    $new_user_data->username = $user_data->getNickname() ?? $user_data->getName();
                    $new_user_data->role = 0;
                    $new_user_data->email = $user_data->getEmail();
                    $new_user_data->password = 'google';
                    $new_user_data->method_typ = 1;
                    $new_user_data->method_val = $user_data->getId();
                    $new_user_data->avatar_url = $user_data->getAvatar();
                    $this->create_new_user($new_user_data);
                    return $this->login_after_register(['email' => $new_user_data->email, 'password' => $new_user_data->password]); //makes the login process
                }
                break;
            case (2):
                //github
                $user_data = Socialite::driver('github')->user();
                if(User::where('email', $user_data->getEmail())->count() > 0)
                {
                    return redirect()->route('user.register_page', ['locale' => \request()->route()->locale])->withErrors([__('Es existiert berreits ein Account mit dieser Email.')]);
                }
                else
                {
                    $new_user_data = (object) [];
                    $new_user_data->username = $user_data->getNickname();
                    $new_user_data->role = 0;
                    $new_user_data->email = $user_data->getEmail();
                    $new_user_data->password = 'github';
                    $new_user_data->method_typ = 2;
                    $new_user_data->method_val = $user_data->getId();
                    $new_user_data->avatar_url = $user_data->getAvatar();
                    $this->create_new_user($new_user_data);
                    return $this->login_after_register(['email' => $new_user_data->email, 'password' => $new_user_data->password]); //makes the login process
                }
                break;
        }
        return redirect()->back()->withErrors([ __('Ein unerwarteter Fehler ist aufgetreten.') ]);
    }


    //basic funcitonality ------------------
    public function login_after_register($auth_data): \Illuminate\Http\RedirectResponse
    {
        if ( Auth::attempt($auth_data, true))
        {
            Request()->session()->regenerate();
            return redirect()->route('user.dashboard', ['locale' => \request()->route()->locale]);
        }
        return redirect()->route('user.login_page', ['locale' => \request()->route()->locale]);
    }

    public function create_new_user($new_user_data): int
    {
        $in = new User();
        $in->username = $new_user_data->username;
        $in->role = $new_user_data->role;
        $in->email = $new_user_data->email;
        $in->password = Hash::make($new_user_data->password);
        $in->method_typ = $new_user_data->method_typ ?? 0;
        $in->method_val = $new_user_data->method_val ?? 0;
        $in->avatar_url = $new_user_data->avatar_url ?? asset('/res/images/logo.png');
        $in->save();
        return 0;
    }
}
