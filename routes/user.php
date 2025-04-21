<?php
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TicketsController;

Route::middleware(['auth', 'userMiddleware','oualid-demo-actions'])->group(function (): void {
    Route::get('dashboard',[UserController::class,'index'])->name('dashboard');
   Route::get('dashboard/Tickets/create',[TicketsController::class,'create'])->name('dasboard.Tickets'); 
   Route::post('dashboard/Ticketes/add',[TicketsController::class,'store'])->name('employee.Tickets.store');
   Route::delete('dashboard/Tickets/{id}', [TicketsController::class, 'destroy'])->name('employee.Tickets.destroy');
   Route::get('dashboard/profile', [UserController::class, 'Profile'])->name('employee.profile.edit');
    Route::patch('dashboard/profile/update', [UserController::class, 'updateProfile'])->name('employee.profile.update');
    Route::get('dashboard/Tickets/list',[TicketsController::class,'index'])->name('employee.Tickets.list');
    Route::get('dashboard/Tickets/{id}/edit', [TicketsController::class, 'edit'])->name('employee.Tickets.edit');
    Route::patch('dashboard/Tickets/edit/{id}',[TicketsController::class , 'update'])->name('employee.Tickets.update');
    Route::patch('dashboard/profile/update/password',[UserController::class ,'updatePassword'])->name('employee.profile.password');
    Route::get('dashboard/Tickets/{id}/show', [TicketsController::class, 'show'])->name('employee.Tickets.show');
    Route::post('dashboard/Tickets/{id}/comment', [TicketsController::class, 'addComment'])->name('employee.Tickets.comment');

});
?>