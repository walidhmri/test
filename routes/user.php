<?php
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\User\UserController;
use App\Models\Teket;
use App\Models\User;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TicketsController;

Route::middleware(['auth', 'userMiddleware'])->group(function (): void {
    Route::get('dashboard',[UserController::class,'index'])->name('dashboard');
   Route::get('/dashboard/tickets',[TicketsController::class,'index'])->name('dasboard.tickets'); 
   Route::post('/dashboard/ticketes/add',[TicketsController::class,'store'])->name('employee.tickets.create');
   Route::delete('/dashboard/tickets/{id}', [TicketsController::class, 'destroy'])->name('employee.tickets.destroy');
   Route::post('/logout', [TicketsController::class, 'logout'])->name('logout');
   Route::get('dashboard/profile', [UserController::class, 'Profile'])->name('employee.profile.edit');
   Route::get('dashboard/profile/edit', [UserController::class, 'editProfile'])->name('employee.profile.edits');
   Route::post('/chat/sessions', [ChatController::class, 'createSession'])->name('chat.create');
   Route::get('/chat/sessions/current', [ChatController::class, 'getUserSession'])->name('chat.session');
   Route::post('/chat/messages', [ChatController::class, 'sendUserMessage'])->name('chat.send');
    Route::patch('dashboard/profile/update', [UserController::class, 'updateProfile'])->name('employee.profile.update');
});
?>