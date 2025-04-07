<?php
use App\Http\Controllers\Ingenieur\SolutionController;
use App\Http\Controllers\Ingenieur\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ingenieur\ProfileController;







Route::middleware(['auth', 'ingenieurMiddleware'])->group(function () {
    Route::get('/ingenieur/dashboard', function () {
        return view('ingenieur.dashboard');
    })->name('ingenieur.dashboard');
    Route::get('ingenieur/profile', [ProfileController::class, 'index'])->name('ingenieur.profile.show');
    Route::get('ingenieur/settings', [ProfileController::class, 'update'])->name('ingenieur.profile.update');
    Route::get('ingenieur/tickets',[TicketController::class, 'index'])->name('ingenieur.ticket.list');
    Route::get('ingenieur/tickets/{id}/show',[TicketController::class, 'show'])->name('ingenieur.ticket.show');
    Route::patch('ingenieur/tickets/{id}/update',[TicketController::class, 'update'])->name('ingenieur.ticket.update');
    Route::get('ingenieur/tickets/{id}/solve',[SolutionController::class, 'index'])->name('ingenieur.ticket.solve');
    Route::post('ingenieur/tickets/solution/add',[SolutionController::class, 'store'])->name('ingenieur.ticket.solution.store');

   



    

});