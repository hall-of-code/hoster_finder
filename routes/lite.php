<?php

use App\Http\Controllers\API_Controlling\Access\accessController;
use App\Http\Controllers\API_Controlling\Applications\applicationController;
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
    Route::prefix('/api')->group(function () {
        Route::prefix('/v1')->group(function () {
            Route::prefix('/user')->group(function () {
                Route::prefix('/settings')->group(function () {
                    Route::prefix('/access')->group(function () {
                        Route::get   ('/tokens', [accessController::class, 'getTokensFromUser'])->name('api.v1.user.tokens.list');
                        Route::post  ('/tokens', [accessController::class, 'createTokenForUser'])->name('api.v1.user.tokens.create');
                        Route::put   ('/tokens', [accessController::class, 'updateTokenByName'])->name('api.v1.user.tokens.update');
                        Route::delete('/tokens', [accessController::class, 'deleteTokenByName'])->name('api.v1.user.tokens.delete');

                        Route::get   ('/applications', [applicationController::class, 'listApplications'])->name('api.v1.user.applications.list');
                        Route::post  ('/applications', [applicationController::class, 'createApplication'])->name('api.v1.user.applications.create');
                        Route::put   ('/applications', [applicationController::class, 'updateApplication'])->name('api.v1.user.applications.update');
                        Route::delete('/applications', [applicationController::class, 'deleteApplication'])->name('api.v1.user.applications.delete');
                        Route::put   ('/applications/regenerate', [applicationController::class, 'regenerateApplicationToken'])->name('api.v1.user.applications.regenerate');

                        Route::get   ('/applications/logs', [applicationController::class, 'getApplicationsLogs'])->name('api.v1.user.applications.logs');
                    });
                });
            });
        });
    });
});

/*Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});*/
