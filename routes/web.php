<?php

use App\Http\Controllers\User_Backend\Auth\LoginController;
use App\Http\Controllers\User_Backend\Auth\RegisterController;
use App\Http\Controllers\User_Backend\Main\DashboardController;
use App\Http\Middleware\SetLocaleByUrlParam;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/{locale?}')->group(function () {
    Route::middleware(SetLocaleByUrlParam::class)->group(function () {
        Route::prefix('/u')->group(function () {
            Route::get('/register', [RegisterController::class, 'show_register_page'])->name('user.register_page');
            Route::post('/register/make', [RegisterController::class, 'make_register_user'])->name('user.register');
            Route::get('/register/redirect/{method}', [RegisterController::class, 'make_register_socialite_redirect'])->name('user.socialite.redirect');
            Route::get('/register/proceed/{method}', [RegisterController::class, 'make_register_socialite_proceed'])->name('user.socialite.proceed');
            Route::get('/login', [LoginController::class, 'show_login_page'])->name('user.login_page');
            Route::post('/login/make', [LoginController::class, 'make_login_user'])->name('user.login');
            Route::get('/logout', [LoginController::class, 'make_logout_user'])->name('user.logout');
            Route::get('/dashboard', [DashboardController::class, 'show_dashboard_page'])->name('user.dashboard')->middleware(['auth']);
        });
    });
});
