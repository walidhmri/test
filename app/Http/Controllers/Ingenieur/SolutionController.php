<?php

namespace App\Http\Controllers\Ingenieur;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
 
    public function index(Request $request){
        $ticket=Ticket::findOrFail($request->id);
        
        return view('ingenieur.solutions.create',compact('ticket'));
    }
    public function store(Request $request){
            $request->validate([
                'title' => 'required|string|max:255',
        'description' => 'required|string',
        'id' => 'required|integer|exists:Tickets,id',
            ]);
            $ticket=Ticket::findOrFail($request->id);
            if(Auth::user()->id!=$ticket->assign && Auth::user()->department_id!=$ticket->department_id){
                return redirect()->back()->with('error','you don\'t have permission to see this Ticket');
            }
            Solution::create([
                'title' => $request->title,
                'description' => $request->description,
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
            ]); 
             return redirect()->route('ingenieur.Ticket.show',$ticket->id)->with('success','Solution added successfully');         
        
    }
}
