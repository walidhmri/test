<?php
use App\Http\Controllers\Ingenieur\CommentController;
use App\Http\Controllers\Ingenieur\SolutionController;
use App\Http\Controllers\Ingenieur\TicketController;
use App\Models\Comment;
use App\Models\ticket;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ingenieur\ProfileController;







Route::middleware(['auth', 'ingenieurMiddleware','oualid-demo-actions'])->group(function () {
    Route::get('/ingenieur', function () {
        $tickets = ticket::where('assign', auth()->user()->id)->orWhere('department_id', Auth::user()->department_id)->get();
        $comments = Comment::whereIn('ticket_id', $tickets->pluck('id'))->get();
        return view('ingenieur.dashboard',compact('comments', 'tickets'));
    })->name('ingenieur.dashboard');

    Route::get('ingenieur/profile', [ProfileController::class, 'index'])->name('ingenieur.profile.show');
    Route::get('ingenieur/settings', [ProfileController::class, 'update'])->name('ingenieur.profile.update');
    Route::get('ingenieur/tickets',[TicketController::class, 'index'])->name('ingenieur.ticket.list');
    Route::get('ingenieur/tickets/{id}/show',[TicketController::class, 'show'])->name('ingenieur.ticket.show');
    Route::get('ingenieur/comments',[CommentController::class, 'index'])->name('ingenieur.comments.list');




    Route::patch('ingenieur/tickets/{id}/update',[TicketController::class, 'update'])->name('ingenieur.ticket.update');
    Route::get('ingenieur/tickets/{id}/solve',[SolutionController::class, 'index'])->name('ingenieur.ticket.solve');
    Route::post('ingenieur/tickets/solution/add',[SolutionController::class, 'store'])->name('ingenieur.ticket.solution.store');

   



    

});