<?php
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TicketsController;

Route::middleware(['auth', 'userMiddleware'])->group(function (): void {
    Route::get('dashboard',[UserController::class,'index'])->name('dashboard');
   Route::get('dashboard/tickets/create',[TicketsController::class,'create'])->name('dasboard.tickets'); 
   Route::post('dashboard/ticketes/add',[TicketsController::class,'store'])->name('employee.tickets.store');
   Route::delete('dashboard/tickets/{id}', [TicketsController::class, 'destroy'])->name('employee.tickets.destroy');
   Route::get('dashboard/profile', [UserController::class, 'Profile'])->name('employee.profile.edit');
    Route::patch('dashboard/profile/update', [UserController::class, 'updateProfile'])->name('employee.profile.update');
    Route::get('dashboard/tickets/list',[TicketsController::class,'index'])->name('employee.tickets.list');
    Route::get('dashboard/tickets/{id}/edit', [TicketsController::class, 'edit'])->name('employee.tickets.edit');
    Route::patch('dashboard/tickets/edit/{id}',[TicketsController::class , 'update'])->name('employee.tickets.update');
    Route::patch('dashboard/profile/update/password',[UserController::class ,'updatePassword'])->name('employee.profile.password');
    Route::get('dashboard/tickets/{id}/show', [TicketsController::class, 'show'])->name('employee.tickets.show');
    Route::post('dashboard/tickets/{id}/comment', [TicketsController::class, 'addComment'])->name('employee.tickets.comment');

});
?>