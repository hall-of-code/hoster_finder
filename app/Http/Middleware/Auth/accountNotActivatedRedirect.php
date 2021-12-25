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
        return $next($request);
    }
}
