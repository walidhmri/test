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
    function destroy(Request $request)
    {
        $ticket=Teket::find($request->id);
        $ticket->delete();
        return redirect()->route('admin.tickets.list')->with('success', 'تم حذف التذكرة بنجاح.');
    }
    function show(Request $request)
    {
        $ticket=Teket::find($request->id);
        return view('admin.ticket.show',compact('ticket'));
    }
    public function filter(Request $request)
    {
        $employees =User::where('role','user')->get();
        if($request->employee_id == 'all') {
            $tickets = Teket::where('priority', $request->priority and 'status', $request->status)->paginate(4);
            return view('admin.ticket.list',compact('tickets','employees'));
        }


           
        
        $tickets = Teket::where('priority', $request->priority)
        ->where('id', $request->employee_id)
        ->where('status', $request->status)
        ->paginate(4);
        return view('admin.ticket.list',compact('tickets','employees'));
    }
}
