<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;



Route::get('/', function () {
    return view('welcome');
});

Route::post('/user-registration', [UsersController::class, 'UserRegistration']);
Route::post('/user-login', [UsersController::class, 'UserLogin']);
