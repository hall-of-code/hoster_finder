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

    //login user into account simple variant
    public function login_user($credentials, bool $remember = True): \Illuminate\Http\RedirectResponse
    {
        if ( Auth::attempt($credentials, $remember))
        {
            Request()->session()->regenerate();
            return redirect()->route('user.dashboard', ['locale' => \request()->route()->locale]);
        }
        return redirect()->route('user.login_page', ['locale' => \request()->route()->locale])->withErrors([
            'email' => __('Ups...wir konnten leider keinen Account mit diesen Login Daten finden.'),
        ]);
    }

    //makes the login process for form posts
    public function make_login_user(): \Illuminate\Http\RedirectResponse
    {
        $credentials = Request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        return $this->login_user($credentials, Request()->get('remember'));
    }

    //makes logout
    public function make_logout_user() :\Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        Request()->session()->invalidate();
        Request()->session()->regenerateToken();
        return redirect()->route('user.login_page', ['locale' => \request()->route()->locale]);
    }
}
