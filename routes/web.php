<?php

use App\Http\Middleware\TokenVeficationMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;



Route::get('/', function () {
    return view('pages.dashboard.dashboard-page');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard-page');
});

Route::post('/user-registration', [UsersController::class, 'UserRegistration']);
Route::post('/user-login', [UsersController::class, 'UserLogin']);
Route::post('/send-otp', [UsersController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UsersController::class, 'VerifyOTP']);
// Token Verify with Middleware
Route::post('/reset-password', [UsersController::class, 'ResetPassword'])
->middleware([TokenVeficationMiddleware::class]);


// AllPages View Routes
Route::get('/registration-page', [UsersController::class, 'RegistrationPage']);
Route::get('/login-page', [UsersController::class, 'LoginPage']);
Route::get('/sendOTP-page', [UsersController::class, 'SendOTPPage']);
Route::get('/verifyOTP-page', [UsersController::class, 'VerifyOTPPage']);
Route::get('/passwordReset-page', [UsersController::class, 'PasswordResetPage']);

//Logout
Route::get('/logout', [UsersController::class, 'UserLogout']);