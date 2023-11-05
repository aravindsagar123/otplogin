<?php

use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
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
Route::get('/',[OtpController::class,'index'])->name('index');
Route::post('store-user',[OtpController::class,'store'])->name('store');
Route::get('/verifyotp/{user_id}',[VerificationController::class,'verify'])->name('verify');
Route::post('otp/login', [VerificationController::class,'otplogin'])->name('otp.getlogin');