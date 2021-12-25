<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;

class accountNotActivatedRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //this middleware redirects if the user account is not activated

    public function handle(Request $request, Closure $next)
    {
        switch (Auth()->user()->acc_status)
        {
            case 1:
                return $next($request);
                break;
            case 2:
                return back()->withErrors(''); //todo hier muss noch die middleware redirecten wenn man sein passwort zurückgesetzt hat.
                break;
            default:
                return redirect()->route('user.account.show_confirm_page', App()->getLocale());
        }
    }
}
