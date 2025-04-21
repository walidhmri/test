<?php

namespace App\Http\Controllers\Ingenieur;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function index(){
        $department_id = Auth::user()->department_id;

        if($department_id==null){
            $department_id= 0;
        }
        $tickets=Ticket::where('assign',Auth::user()->id)->orWhere('department_id',$department_id)->orderBy('updated_at' ,'desc')->paginate(10);
        $employees =User::all();
        return view('ingenieur.Ticket.list',compact('tickets'));
    }
    public function show(Request $request){
        
        $ticket= Ticket::findOrFail($request->id);
        if(Auth::user()->id!=$ticket->assign && Auth::user()->department_id!=$ticket->department_id){
            return redirect()->back()->with('error','you don\'t have permission to see this Ticket');
        }
        $solutions=Solution::where('Ticket_id',$ticket->id)->paginate(10);
        return view('ingenieur.Ticket.show',compact('ticket','solutions'));
    }
  public function update(Request $request){
    $request->validate(
        [
            'priority'=> 'required|in:low,medium,high,urgent',
            'status'=> 'required',
        ]
        );
    $tikcet=Ticket::findOrFail($request->id);
    $tikcet->status=$request->status;
    $tikcet->priority=$request->priority;
    $tikcet->save();
    return redirect()->back()->with('success','Ticket updated successfully');
  }
    
}
