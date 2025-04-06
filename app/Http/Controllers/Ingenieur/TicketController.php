<?php

namespace App\Http\Controllers\Ingenieur;

use App\Http\Controllers\Controller;
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
}
