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
                //whitelisting feature implemented
                $app_perms = applications::where('user_id', $user_id)->where('app_token', Request('app_token')->get(['app_perms']))['app_perms'];
                $perms_parts = explode('WHITELIST:', $app_perms);
                if(sizeof($perms_parts) >= 2)
                {
                    if(!str_contains(self::getIp(), $perms_parts[1]) || !str_contains("*", $perms_parts[1]))
                    {
                        return response()->json(['error' => 'client is not whitelisted.']);
                    }
                }
                return $next($request);
            }
        }
        return response()->json(['error' => 'app_token is not usable or fails. ']);
    }

    static function getIp(): ?string
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}
