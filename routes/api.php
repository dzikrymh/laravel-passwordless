<?php

use App\Http\Controllers\APIs\AuthController;
use App\Http\Controllers\APIs\MagicLinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');

        Route::get('login/magic-link/{user:email}', MagicLinkController::class)
            ->name('login.api-magic-link')
            ->middleware('signed');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', function (Request $request) {
            return $request->user();
        });

        Route::post('logout', 'logout');
    });
});
