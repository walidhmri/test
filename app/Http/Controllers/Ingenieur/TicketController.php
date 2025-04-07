<?php

namespace App\Http\Controllers\Ingenieur;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use App\Models\ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(){
        
        $tickets=Ticket::where('assign',Auth::user()->id)->orderBy('updated_at' ,'desc')->paginate(10);
        $employees =User::all();
        return view('ingenieur.ticket.list',compact('tickets'));
    }
    public function show(Request $request){
        
        $ticket= Ticket::findOrFail($request->id);
        if(Auth::user()->id!=$ticket->assign){
            return redirect()->back()->with('error','you don\'t have permission to see this ticket');
        }
        $solutions=Solution::where('ticket_id',$ticket->id)->get();
        return view('ingenieur.ticket.show',compact('ticket','solutions'));
    }
  public function update(Request $request){
    $request->validate(
        [
            'priority'=> 'required|in:low,medium,high',
            'status'=> 'required',
        ]
        );
    $tikcet=ticket::findOrFail($request->id);
    $tikcet->status=$request->status;
    $tikcet->priority=$request->priority;
    $tikcet->save();
    return redirect()->back()->with('success','Ticket updated successfully');
  }
    
}
