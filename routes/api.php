<?php

use App\Http\Controllers\API_Controlling\Access\accessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('/v1')->group(function () {
    //[ api (sanctum) Protected Routes ]
    Route::middleware(["auth:sanctum", "Auth.app_token"])->group(function () {
        Route::prefix('/work')->group(function () {
            Route::get('/echo/{msg?}', function ($msg = "Hello, World!") { return response()->json(['message' => $msg]); });
        });
    });

    //[ api non-protected Routes / PUBLIC API ]
    Route::middleware(["throttle:50,1"])->group(function () {
        Route::prefix('/public')->group(function () {
            Route::get('/echo/{msg?}', function ($msg = "Hello, World!") { return response()->json(['message' => $msg]); });
            Route::post('/echo/{msg?}', function ($msg = "Hello, World! (This is a POST Route use 'message' to post an echo msg.") { return response()->json(['message' => (Request()->get('message') ?? $msg)]); });
        });
    });
});

/*Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});*/
