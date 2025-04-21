<?php

namespace App\Http\Controllers\Ingenieur;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        
        
        $tickets = Ticket::where('assign', auth()->user()->id)->orWhere('department_id',Auth::user()->department_id)->get();
        $comments = Comment::whereIn('Ticket_id', $tickets->pluck('id'))->get();
        $employees= User::where('role', 'employee')->get();
        return view('ingenieur.comments.list',compact('comments','tickets','employees'));
    }

    public function show($id)
    {
        // Logic to fetch and display a specific comment
        return view('ingenieur.comments.show', compact('id'));
    }

    public function store(Request $request)
    {
        // Logic to store a new comment
        return redirect()->route('ingenieur.comments.index');
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing comment
        return redirect()->route('ingenieur.comments.show', ['id' => $id]);
    }

    public function destroy($id)
    {
        // Logic to delete a comment
        return redirect()->route('ingenieur.comments.index');
    }
}
