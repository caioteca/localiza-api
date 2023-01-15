<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\AtmBombaController;
use App\Http\Controllers\API\SugestoeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    //http://localhost:8000/api/auth/login use in postman
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/bloqueio', [AuthController::class, 'bloqueio']);
    //Route::get('/user-profile', [AuthController::class, 'userProfile']); 
    Route::resource('atm_bomba', AtmBombaController::class);
    Route::resource('sugestoes_reclamacao', SugestoeController::class);
    //Route::post('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'forgotPassword']);
    //Route::post('/verify/pin', [App\Http\Controllers\ForgotPasswordController::class, 'verifyPin']);
    //Route::post('/reset-password', [App\Http\Controllers\ResetPasswordController::class, 'resetPassword']
    //);
     
});
