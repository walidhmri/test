<?php

namespace App\Http\Controllers\Admin;
use App\Models\Department;
use App\Models\Solution;
use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\CreateSolutionNotification;
use App\Notifications\CreateTicketNotification;
use Auth;
use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Notification;


class TicketsController extends Controller
{
    public function index(Request $request)
    {
        $solutions=Solution::get();
        $employees = User::where('role', 'user')->get();
        $query = Ticket::query(); 

        if ($request->filled('month')) {
            try {
                $selectedDate = \Carbon\Carbon::parse($request->month);
                $query->whereYear('created_at', $selectedDate->year)
                      ->whereMonth('created_at', $selectedDate->month);
            } catch (\Exception $e) {
            }
        }
        if (in_array($request->order, ['asc', 'desc'])) {
            $query->orderBy('id', $request->order);
        } else {
            $query->orderBy('id', 'desc');
        }
    
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('assign')) {
            if($request->assign=='true'){
                $query->whereNotNull('assign');
            }elseif($request->assign=='false'){
                $query->whereNull('assign');
            }
        }
    
        if ($request->filled('employee_id')) {
            $query->where('user_id', $request->employee_id);
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $tickets = $query->paginate(10);
        
        return view('admin.Ticket.list', compact('tickets', 'employees','solutions'));
    }
    


    function destroy(Request $request)
    {
        $ticket=Ticket::find($request->id);
        $ticket->delete();
        return redirect()->back()->with('success', 'تم حذف التذكرة بنجاح.');
    }
    function show(Request $request)
    {
        $employee = User::find($request->user_id);
        $ingenieurs = User::where('role', 'ingenieur')->get();
        $ticket=Ticket::find($request->id);
        $solutions =Solution::where('ticket_id',$ticket->id)->paginate(10);

        foreach ($solutions as $solution) {
            $solution->html_description = Markdown::convertToHtml($solution->description);
        }
        $departments=Department::get();
        return view('admin.Ticket.show',compact('ticket','employee','solutions','ingenieurs','departments'));
    }
    public function update(Request $request)
    {
        $request->validate(
            [
                'status' => 'required',
                'priority' => 'required',
                'assign'=> 'nullable',
                'department_id'=>'nullable'
            ]);
        $ticket=Ticket::find($request->id);
        $ticket->status=$request->status;
        $ticket->assign=$request->assign;
        $ticket->priority=$request->priority;
        $ticket->department_id=$request->department_id;	
        $ticket->save();
        $user = User::find($ticket->user_id);
        $etat= 'Updated';
        
        $ticket->user_id =Auth::user()->id;

        Notification::send($user, new CreateTicketNotification($ticket, $etat));
        return redirect()->route('admin.tickets.list')->with(['success' => "تم تحديث حالة التذكرة $ticket->id بنجاح."]);
    }
function idfill($id)
{
    return redirect()->route('admin.profile.show' , ['id' => $id]);
}

}