<?php
use App\Http\Controllers\AdminController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TicketsController;

Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('dashboard', function () {
        return view('employee.dashboard');
    })->name('dashboard');
   Route::get('/dashboard/tickets',[TicketsController::class,'index'])->name('tickets'); 
    


});