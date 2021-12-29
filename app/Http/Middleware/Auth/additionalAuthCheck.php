<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class additionalAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return string
     */
    public function handle(Request $request, Closure $next)
    {
        if ( auth('sanctum')->check())
        {
            auth()->shouldUse('sanctum');
            return $next($request);
        }
        else if(auth()->check())
        {
            auth()->shouldUse('web');
            return $next($request);
        }
        if (! $request->expectsJson())
        {
            return route('user.login_page', app()->getLocale());
        }
        else
        {
            return response()->json(['error' => 'User Authentication isnt defined.']);
        }
    }
}
