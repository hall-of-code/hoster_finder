<?php

use App\Http\Controllers\API_Controlling\Access\accessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Lite API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//[ api user-protected Routes / USER API ]
Route::middleware(["auth:sanctum"])->group(function () {
    Route::prefix('/api/v1/user')->group(function () {
        Route::get('/tokens', [accessController::class, 'getTokensFromUser']);
        Route::post('/tokens', [accessController::class, 'createTokenForUser']);
        Route::put('/tokens', [accessController::class, 'updateTokenByName']);
        Route::delete('/tokens', [accessController::class, 'deleteTokenByName']);
    });
});

/*Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});*/
