<?php

namespace App\Http\Controllers\API_Controlling\Access;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class accessController extends Controller
{
    //create api token for currnetly logged in user
    public function createTokenForUser()
    {
        $api_token = Auth()->user()->createToken("mytoken");
        return response()->json(['api_token' => $api_token->plainTextToken]);
    }
}
