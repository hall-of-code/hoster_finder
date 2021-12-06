<?php

namespace App\Http\Middleware\Auth;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class loginThirdPartyProofMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //validates if user is permitted to login or only can login via ThirdParty
    public function handle(Request $request, Closure $next)
    {
        Request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(User::where('email', Request()->get('email'))->where('method_typ', '>', 0)->count() != 0)
        {
            return redirect()->back()->withErrors(['email' => __('Es ist ein unerwarteter Fehler aufgetreten.')]);
        }
        return $next($request);
    }
}
