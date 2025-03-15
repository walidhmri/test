<?php

namespace App\Http\Controllers\Admin;
use App\Models\Teket;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Teket::paginate(4);
        $employees = User::get();
        return view('admin.ticket.list',compact('tickets','employees'));
    }
}
