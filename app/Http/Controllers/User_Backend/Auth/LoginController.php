<?php

namespace App\Http\Controllers\User_Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Object_;

class LoginController extends Controller
{
    public function construct()
    {
        //
    }

    //returns the User Backend Login Page wich is avaible at /u/login
    public function show_login_page()
    {
        return view('User_Backend.Auth.login');
    }

    //makes the login process
    public function make_login_user() :string
    {
        $credentials = Request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $get_user = User::where('email', $credentials['email'])->first();
        if($get_user->method_typ > 0)
        {
            $info_provider = "other Authenticated Account.";
            switch($get_user->method_typ)
            {
                case 1:
                    $info_provider = "Google Account.";
                    break;
                case 2:
                    $info_provider = "GitHub Account.";
                    break;
            }
            return redirect()->back()->withErrors(['This E-Mail is associated with an '.$info_provider]);
        }

        if ( Auth::attempt($credentials, Request()->get('remember')) ) {
            Request()->session()->regenerate();
            return redirect()->route('user.dashboard', ['locale' => \request()->route()->locale]);
        }

        return back()->withErrors([
            'email' => 'Ups...wir konnten leider keinen Account mit diesen Login Daten finden.',
        ]);
    }

    //makes logout
    public function make_logout_user() :string
    {
        Auth::logout();
        Request()->session()->invalidate();
        Request()->session()->regenerateToken();
        return redirect()->route('user.login_page', ['locale' => \request()->route()->locale]);
    }
}
