<?php

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


Route::middleware(["auth:sanctum"])->group(function () {
    Route::prefix('/v1')->group(function () {
        Route::prefix('/testing')->group(function () {
            Route::get('/echo/{msg?}', function ($msg = "Hello, World!") { return $msg; });
        });
    });
});

/*Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});*/
