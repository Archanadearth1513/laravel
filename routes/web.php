<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\DashboardController;


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

Route::get('/', function () {
    return view('welcome');
});

//for signup route
Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('signup',[SignupController::class,'signup']);

//login rout
Route::get('login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('login',[LoginController::class,'login']);

Route::get('otp/verify', [LoginController::class, 'showOtpVerifyForm'])->name('otp.verify');
Route::post('otp/verify', [LoginController::class, 'verifyOtp'])->name('otp.verify');

//OTP verification
Route::get('/otp-verify', [OtpController::class, 'showOtpForm'])->name('otp');
Route::post('/otp-verify', [OtpController::class, 'verifyOtp']);


//Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



/*
<queries-15-08>
- how can use thios signup api in postman
- i have applied autogenerate password functionality but still showing msg that filout field

*/