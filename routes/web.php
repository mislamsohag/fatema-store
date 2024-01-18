<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\TokenVerificationMiddleware;



Route::get('/', [UsersController::class, 'DashboardPage']);
Route::get('/home', [UsersController::class, 'DashboardPage']);


// Auth Pages View Routes
Route::get('/registration-page', [UsersController::class, 'RegistrationPage']);
Route::get('/login-page', [UsersController::class, 'LoginPage']);
Route::get('/sendOTP-page', [UsersController::class, 'SendOTPPage']);
Route::get('/verifyOTP-page', [UsersController::class, 'VerifyOTPPage']);

// Auth Related
Route::post('/user-registration', [UsersController::class, 'UserRegistration']);
Route::post('/user-login', [UsersController::class, 'UserLogin']);
Route::post('/send-otp', [UsersController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UsersController::class, 'VerifyOTP']);

// Auth Protected Routes
Route::post('/reset-password', [UsersController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/passwordReset-page', [UsersController::class, 'PasswordResetPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard', [UsersController::class, 'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/profilePage', [UsersController::class, 'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile', [UsersController::class, 'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/profileUpdate', [UsersController::class, 'ProfileUpdate'])->middleware([TokenVerificationMiddleware::class]);


//Logout
Route::get('/logout', [UsersController::class, 'UserLogout']);


// Categories Routes
Route::get('/category-view', [CategoryController::class, 'CategoryView'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/category-list', [CategoryController::class, 'CategoryList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/category-create', [CategoryController::class, 'CategoryCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/category-update', [CategoryController::class, 'CategoryUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/category-delete', [CategoryController::class, 'CategoryDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/category-by-id', [CategoryController::class, 'CategoryById'])->middleware([TokenVerificationMiddleware::class]);


// Customer Routes
Route::get('/customer-page', [CustomerController::class, 'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/customer-list', [CustomerController::class, 'CustomerList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/customer-create', [CustomerController::class, 'CustomerCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/customer-delete', [CustomerController::class, 'CustomerDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/customer-update', [CustomerController::class, 'CustomerUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/single-customer', [CustomerController::class, 'SingleCustomer'])->middleware([TokenVerificationMiddleware::class]);

// Product Routes
Route::get('/product-page', [ProductController::class, 'ProductPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/product-list', [ProductController::class, 'ProductList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/product-store', [ProductController::class, 'Store'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/product-delete', [ProductController::class, 'Delete'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/product-update', [ProductController::class, 'Update'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/single-product', [ProductController::class, 'SingleProduct'])->middleware([TokenVerificationMiddleware::class]);


// Invoice routes
Route::get('/invoice-page', [InvoiceController::class, 'InvoicePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/sale-page', [InvoiceController::class, 'SalePage'])->middleware([TokenVerificationMiddleware::class]);
