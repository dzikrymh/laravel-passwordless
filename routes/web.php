<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginFromMagicLinkController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('dashboard', DashboardController::class)
    ->name('dashboard')
    ->middleware('auth');
    
Route::post('logout', LogoutController::class)
    ->name('logout')
    ->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    
    Route::get('login/wml/{user:email}', LoginFromMagicLinkController::class)
        ->name('login.with-magic-link')
        ->middleware('signed');

    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
});
