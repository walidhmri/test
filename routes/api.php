<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [UserController::class, 'login'])->name('api.login');
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('api.logout');
    
});