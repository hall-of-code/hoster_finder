<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

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
        $x = true;
        //try { $x = $request->expectsJson(); } catch (\ErrorException $e) { $x = false; };
        if (! $x)
        {
            return route('user.login_page', app()->getLocale());
        }
        return response()->json(['error' => 'User Authentication isnt defined.']);
    }
}
