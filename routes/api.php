<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiTicketController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::put('/password', [AuthController::class, 'updatePassword']);
    
    // Dashboard
    
    // Update your routes to use the new controller name
    // ...
    Route::get('/dashboard', [ApiTicketController::class, 'dashboard']);
    Route::get('/tekets', [ApiTicketController::class, 'index']);
    Route::post('/tekets', [ApiTicketController::class, 'store']);
    Route::get('/tekets/{id}', [ApiTicketController::class, 'show']);
    Route::put('/tekets/{id}', [ApiTicketController::class, 'update']);
    Route::delete('/tekets/{id}', [ApiTicketController::class, 'destroy']);

});