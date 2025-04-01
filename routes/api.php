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
    Route::get('/tickets', [ApiTicketController::class, 'index']);
    Route::post('/tickets', [ApiTicketController::class, 'store']);
    Route::get('/tickets/{id}', [ApiTicketController::class, 'show']);
    Route::put('/tickets/{id}', [ApiTicketController::class, 'update']);
    Route::delete('/tickets/{id}', [ApiTicketController::class, 'destroy']);

});