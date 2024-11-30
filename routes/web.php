<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

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

//user api routes
Route::post('/register',[UserController::class,'UserRegistration']);
Route::post('/login',[UserController::class,'UserLogin']);
Route::post('/send-otp',[UserController::class,'SendOTPCode']);
Route::post('/verify-otp',[UserController::class,'VerifyOTP']);
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/logout', [UserController::class, 'UserLogout']);


//category api Routes
Route::post('/add-category',[CategoryController::class,'addCategory']);
Route::get('/get-category',[CategoryController::class,'getCategory']);


// Income Api Routes
Route::post('/add-income',[IncomeController::class,'addIncome']);



// this route use tasting purpose!
Route::get('/test', [IncomeController::class, 'addIncome']);
