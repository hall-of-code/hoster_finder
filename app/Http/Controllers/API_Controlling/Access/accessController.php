<?php

namespace App\Http\Controllers\API_Controlling\Access;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;

class accessController extends Controller
{

    //[POST /tokens create api token for currnetly logged in user
    public function createTokenForUser(): \Illuminate\Http\JsonResponse
    {
        $token_name = Request()->get('token_name') ?? false;
        if($token_name == false) $token_name = "TOKEN#" . str_replace([' ', '-', ':'],'', Carbon::now()); //if token name not provided
        return response()->json(['token_name' => $token_name, 'api_token' => (Auth()->user()->createToken($token_name))->plainTextToken]);
    }

    //[DELETE /tokens delete api token
    public function deleteTokenByName(): \Illuminate\Http\JsonResponse
    {
        $token_name = Request()->get('token_name');//if token name not provided
        Auth()->user()->tokens()->where('name', $token_name)->delete();
        return response()->json(['token_name' => $token_name, 'deleted' => 'true']);
    }

    //[PUT /tokens update api token name
    public function updateTokenByName(): \Illuminate\Http\JsonResponse
    {
        $token_name = Request()->get('token_name');//current token name
        $update_name = Request()->get('update_name');//new token name
        Auth()->user()->tokens()->where('name', $token_name)->first()->update(['name' => $update_name]);
        return response()->json(['token_name' => $update_name, 'updated' => 'true']);
    }

    //[GET /tokens update api token name
    public function getTokensFromUser(): \Illuminate\Http\JsonResponse
    {
        $tokens_arr = Auth()->user()->tokens()->limit(100)->get(['name as token_name', 'last_used_at as last_used', 'created_at as created']);
        return response()->json(['tokens' => $tokens_arr, 'length' => sizeof($tokens_arr)]);
    }
}
