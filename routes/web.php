<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index']);
Route::get('/test', [HomeController::class, 'test']);

//All user routes

Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTP']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);

Route::middleware(TokenVerificationMiddleware::class)->group(function () {
    Route::get('/DashboardPage', [UserController::class, 'DashboardPage']);
    Route::post('/user-logout', [UserController::class, 'UserLogout']);
    Route::post('/reset-password', [UserController::class, 'ResetPassword']);
});
