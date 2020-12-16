<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\EmailVerificationController;
use App\Mail\TwoFactorAuthenticationEmail;
use App\Mail\VerificationEmail;
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

// Two Factor Routes (maybe need to make this for authenticated users)
Route::post('/twoFactor/resend', [TwoFactorController::class, 'resend'])->name('twoFactor.resend');
Route::post('/twoFactor/verify', [TwoFactorController::class, 'store'])->name('twoFactor.verify');
Route::get('/twoFactor', [TwoFactorController::class, 'show'])->name('twoFactor.show');

// Register Routes
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.check');

// Login Routes
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'store'])->name('login.check');

// Email verification routes
Route::post('/email_verification/resend', [EmailVerificationController::class, 'resend'])->name('email_verification.resend');
Route::get('/email_verification/verify', [EmailVerificationController::class, 'store'])->name('email_verification.verify');
Route::get('/email_verification', [EmailVerificationController::class, 'index'])->name('email_verification.index');


/* 
    Routes only accessible to an authenticated user, who's email has been verified
    and has passed two factor authentication
*/
Route::middleware(['auth','twoFactor','emailVerify'])->group(function () {
    // Change password routes
    Route::get('/changePassword', [ChangePasswordController::class, 'show'])->name('change_password.show');
    Route::post('/changePassword', [ChangePasswordController::class, 'store'])->name('change_password.check');
    //Logout and welcome page route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', function () { return view('welcome'); })->name('welcome');
});

