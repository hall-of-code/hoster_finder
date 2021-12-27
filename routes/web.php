<?php

use App\Http\Controllers\User_Backend\Auth\AccountActivateAndResetController;
use App\Http\Controllers\User_Backend\Auth\LoginController;
use App\Http\Controllers\User_Backend\Auth\RegisterController;
use App\Http\Controllers\User_Backend\Auth\Telegram\TelegramController;
use App\Http\Controllers\User_Backend\Auth\ThirdPartyController;
use App\Http\Controllers\User_Backend\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\User_Backend\Main\DashboardController;
use App\Http\Middleware\SetLocaleByUrlParam;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

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
            Route::post('/register/make', [RegisterController::class, 'registerNormalUser'])->name('user.register');
            Route::get('/register/confirm/{code?}/{uid?}', [AccountActivateAndResetController::class, 'confirm_account_by_code'])->name('user.account.confirm');
            Route::get('/thirdparty/redirect/{method}', [ThirdPartyController::class, 'thirdPartyRedirect'])->name('user.socialite.redirect');
            Route::get('/thirdparty/proceed/{method}', [ThirdPartyController::class, 'thirdPartyAuthProceed'])->name('user.socialite.proceed');
            Route::get('/login', [LoginController::class, 'show_login_page'])->name('user.login_page');
            Route::post('/login/make', [LoginController::class, 'make_login_user'])->name('user.login')->middleware('Auth.loginThirdPartyProofMiddleware');

            Route::middleware(['auth'])->group(function () {
                Route::prefix('/settings')->group(function () {
                    Route::prefix('/security')->group(function () {
                        Route::prefix('/2fa')->group(function () {
                            Route::prefix('/methods')->group(function () {
                                Route::prefix('/telegram')->group(function () {
                                    Route::get('/reload', [TelegramController::class, 'return_telegram_chatid'])->name('user.settings.security.2fa.telegram.reload');
                                    Route::get('/link={?chatid}', [TelegramController::class, 'link_telegram_to_user'])->name('user.settings.security.2fa.telegram.link');
                                    Route::get('/remove={?chatid}', [TelegramController::class, 'link_telegram_to_user'])->name('user.settings.security.2fa.telegram.remove');
                                    Route::get('/update={?newchatid}', [TelegramController::class, 'link_telegram_to_user'])->name('user.settings.security.2fa.telegram.update');
                                });
                            });
                        });
                    });
                });
                Route::get('/register/show/confirm', [AccountActivateAndResetController::class, 'show_confirm_code_page'])->name('user.account.show_confirm_page');
                Route::post('/register/confirm/{code?}/{uid?}', [AccountActivateAndResetController::class, 'confirm_account_by_code'])->name('user.account.confirm_post');
                Route::get('/protect/2fa/show', [TwoFactorAuthenticationController::class, 'show_2fa_page'])->name('user.protection.show_2fa');
                Route::post('/protect/2fa/send', [TwoFactorAuthenticationController::class, 'handle_2fa_request'])->name('user.protection.post_2fa');
                Route::get('/protect/2fa/test', [TwoFactorAuthenticationController::class, 'add_telegram'])->name('user.protection.send_2fa'); //sehr schlechte sache hier nix festes
                Route::get('/logout', [LoginController::class, 'make_logout_user'])->name('user.logout');
                Route::get('/dashboard', [DashboardController::class, 'show_dashboard_page'])->name('user.dashboard')->middleware(['Auth.accountNotActivatedRedirect']);
            });
        });
    });
});
