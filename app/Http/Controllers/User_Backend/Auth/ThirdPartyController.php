<?php

namespace App\Http\Controllers\User_Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class ThirdPartyController extends Controller
{
    //[gets the method and redirect to given Provider, data stored in config/services.php]
    public function thirdPartyRedirect($locale, $method = 1)
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


    //takes Socialite response from Google/Github/ect end login or when user not exists: register him.
    public function thirdPartyAuthProceed(string $locale, int $method = 1): \Illuminate\Http\RedirectResponse
    {
        switch ($method)
        {
            case (2):
                $extern = 'github';
                break;
            default:
                $extern = 'google';
        }

        $extern_data = Socialite::driver($extern)->user(); //gets User-Data-Object from Driver.
        return $this->registerOrLoginThirdPartyUser($extern_data, $extern, $method);
    }

    //registers and/or login user
    private function registerOrLoginThirdPartyUser(\Laravel\Socialite\Contracts\User $extern_data, string $extern, int $method_typ): \Illuminate\Http\RedirectResponse
    {
        $username = $extern_data->getNickname() ?? $extern_data->getName();
        $email    = $extern_data->getEmail();
        $registerHandler = new RegisterController();
        $loginHandler = new LoginController();

        $new_user_data = (object) [];
        $new_user_data->username = $extern_data->getNickname() ?? $extern_data->getName();
        $new_user_data->role = 0;
        $new_user_data->email = $extern_data->getEmail();
        $new_user_data->password = $extern; //google/github/ect is the password for socialite authenticated users because they uses id for auth
        $new_user_data->method_typ = $method_typ;
        $new_user_data->method_val = $extern_data->getId(); //user ID from Google/Github/ect is instead of password
        $new_user_data->avatar_url = $extern_data->getAvatar();

        if($registerHandler->check_if_user_already_exists($username, $email) == False)
        {
            $registerHandler->create_new_user($new_user_data);
        }
        $credentials = ['email' => $new_user_data->email, 'password' => $new_user_data->password];
        return $loginHandler->login_user($credentials, True);
    }
}
