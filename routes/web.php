<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifyController;
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
Route::get('/email', function () {
    return new VerificationEmail('test@test.com', '###');
});

Route::get('/register', [RegisterController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [RegisterController::class, 'registerCheck'])->name('registerCheck');
Route::get('/login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'loginCheck'])->name('loginCheck');
Route::get('/verify', [VerifyController::class, 'verify'])->name('verify');
Route::post('/newVerificationEmail', [RegisterController::class, 'sendVerificationEmail'])->name('newVerificationEmail');

Route::middleware('auth')->group(function () {
    Route::get('/changepassword', [LoginController::class, 'changePasswordForm'])->name('changepasswordForm');
    Route::post('/changepassword', [LoginController::class, 'changePassword'])->name('changepassword');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', function () { return view('welcome'); })->name('welcome');
});

