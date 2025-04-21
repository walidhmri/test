<?php
use App\Http\Controllers\Ingenieur\CommentController;
use App\Http\Controllers\Ingenieur\SolutionController;
use App\Http\Controllers\Ingenieur\TicketController;
use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ingenieur\ProfileController;







Route::middleware(['auth', 'ingenieurMiddleware','oualid-demo-actions'])->group(function () {
    Route::get('/ingenieur', function () {
        $tickets = Ticket::where('assign', auth()->user()->id)->orWhere('department_id', Auth::user()->department_id)->get();
        $comments = Comment::whereIn('Ticket_id', $tickets->pluck('id'))->get();
        return view('ingenieur.dashboard',compact('comments', 'tickets'));
    })->name('ingenieur.dashboard');

    Route::get('ingenieur/profile', [ProfileController::class, 'index'])->name('ingenieur.profile.show');
    Route::get('ingenieur/settings', [ProfileController::class, 'update'])->name('ingenieur.profile.update');
    Route::get('ingenieur/Tickets',[TicketController::class, 'index'])->name('ingenieur.Ticket.list');
    Route::get('ingenieur/Tickets/{id}/show',[TicketController::class, 'show'])->name('ingenieur.Ticket.show');
    Route::get('ingenieur/comments',[CommentController::class, 'index'])->name('ingenieur.comments.list');




    Route::patch('ingenieur/Tickets/{id}/update',[TicketController::class, 'update'])->name('ingenieur.Ticket.update');
    Route::get('ingenieur/Tickets/{id}/solve',[SolutionController::class, 'index'])->name('ingenieur.Ticket.solve');
    Route::post('ingenieur/Tickets/solution/add',[SolutionController::class, 'store'])->name('ingenieur.Ticket.solution.store');

   



    

});