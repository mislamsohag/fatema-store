<?php

use App\Http\Middleware\TokenVeficationMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;



Route::get('/', function () {
    return view('welcome');
});

Route::post('/user-registration', [UsersController::class, 'UserRegistration']);
Route::post('/user-login', [UsersController::class, 'UserLogin']);
Route::post('/send-otp', [UsersController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UsersController::class, 'VerifyOTP']);
// Token Verify with Middleware
Route::post('/reset-password', [UsersController::class, 'ResetPassword'])
->middleware([TokenVeficationMiddleware::class]);
 