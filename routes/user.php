<?php
use App\Http\Controllers\AdminController;

use App\Http\Controllers\User\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TicketsController;

Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('dashboard', function () {
        return view('employee.dashboard');
    })->name('dashboard');
   Route::get('/dashboard/tickets',[TicketsController::class,'index'])->name('dasboard.tickets'); 
   Route::post('/dashboard/ticketes/add',[TicketsController::class,'store'])->name('employee.tickets.create');
   Route::delete('/dashboard/tickets/{id}', [TicketsController::class, 'destroy'])->name('employee.tickets.destroy');
   Route::post('/logout', [TicketsController::class, 'logout'])->name('logout');
   Route::get('dashboard/profile', [UserController::class, 'Profile'])->name('employee.profile.edit');
   Route::get('dashboard/profile/edit', [UserController::class, 'editProfile'])->name('employee.profile.edits');

    Route::patch('dashboard/profile/update', [UserController::class, 'updateProfile'])->name('employee.profile.update');

    


});