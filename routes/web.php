<?php


use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\TokenVerificationMiddleware;



Route::get('/', [UsersController::class, 'DashboardPage']);
Route::get('/home', [UsersController::class, 'DashboardPage']);

Route::post('/user-registration', [UsersController::class, 'UserRegistration']);
Route::post('/user-login', [UsersController::class, 'UserLogin']);
Route::post('/send-otp', [UsersController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UsersController::class, 'VerifyOTP']);

// Protected Routes
Route::post('/reset-password', [UsersController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/passwordReset-page', [UsersController::class, 'PasswordResetPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard', [UsersController::class, 'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/profilePage', [UsersController::class, 'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile', [UsersController::class, 'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/profileUpdate', [UsersController::class, 'ProfileUpdate'])->middleware([TokenVerificationMiddleware::class]);


// AllPages View Routes
Route::get('/registration-page', [UsersController::class, 'RegistrationPage']);
Route::get('/login-page', [UsersController::class, 'LoginPage']);
Route::get('/sendOTP-page', [UsersController::class, 'SendOTPPage']);
Route::get('/verifyOTP-page', [UsersController::class, 'VerifyOTPPage']);

//Logout
Route::get('/logout', [UsersController::class, 'UserLogout']);


// Categories Routes
Route::get('/category-view', [CategoryController::class, 'CategoryView']);
