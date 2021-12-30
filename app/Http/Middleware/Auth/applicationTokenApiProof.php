<?php

namespace App\Http\Middleware\Auth;

use App\Models\api\applications;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class applicationTokenApiProof
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ( auth('sanctum')->check())
        {
            auth()->shouldUse('sanctum');
            $user_id = auth()->user()->id;
            if (applications::where('user_id', $user_id)->where('app_token', Request('app_token'))->count() > 0)
            {
                return $next($request);
            }
        }
        return response()->json(['error' => 'app_token is not usable or fails. ']);
    }
}
