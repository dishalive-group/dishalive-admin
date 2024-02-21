<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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


Route::get('/', [UserController::class, 'login']);
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'registerNow']);
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'loginNow']);
Route::get('reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password', [UserController::class, 'resetPasswordNow']);
Route::get('change-password', [UserController::class, 'changePassword'])->name('change-password');
Route::post('change-password', [UserController::class, 'changePasswordNow']);
Route::get('resend-otp', [UserController::class, 'resendOTP']);
Route::post('verify-otp', [UserController::class, 'verifyOTP']);
Route::get("logout", [UserController::class, "logout"]);   


//Dashboard Routes with middleware
Route::group(['prefix'=>'/dashboard', 'middleware' => ['dashboard']], function(){
    
    Route::get("/", [DashboardController::class, "index"]);
    Route::get("/schedule-campaign", [DashboardController::class, "scheduleCampaign"]);
    Route::post("/schedule-campaign", [DashboardController::class, "scheduleCampaignNow"]);
    Route::get("/user-campaigns", [DashboardController::class, "userCampaigns"]);
    Route::get("/reports", [DashboardController::class, "reports"]);
    Route::get("/transactions", [DashboardController::class, "transactions"]);


    Route::group(['prefix'=>'/page'], function(){
        Route::get("/", [PageController::class, "index"]);
    });

});