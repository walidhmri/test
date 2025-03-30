<?php

namespace App\Http\Controllers\Admin;
use App\Models\Solution;
use App\Models\Teket;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function index(Request $request)
    {
        $employees = User::where('role', 'user')->get();
        $query = Teket::query(); 
    
        if ($request->filled('month')) {
            try {
                $selectedDate = \Carbon\Carbon::parse($request->month);
                $query->whereYear('created_at', $selectedDate->year)
                      ->whereMonth('created_at', $selectedDate->month);
            } catch (\Exception $e) {
            }
        }
        if (in_array($request->order, ['asc', 'desc'])) {
            $query->orderBy('created_at', $request->order);
        } else {
            $query->orderBy('created_at', 'desc');
        }
    
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
    
        if ($request->filled('employee_id')) {
            $query->where('user_id', $request->employee_id);
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $tickets = $query->paginate(10);
        
        return view('admin.ticket.list', compact('tickets', 'employees'));
    }
    


    function destroy(Request $request)
    {
        $ticket=Teket::find($request->id);
        $ticket->delete();
        return redirect()->back()->with('success', 'تم حذف التذكرة بنجاح.');
    }
    function show(Request $request)
    {
        $employee = User::find($request->user_id);
        $ticket=Teket::find($request->id);
        $solutions =Solution::where('teket_id',$ticket->id)->get();
        return view('admin.ticket.show',compact('ticket','employee','solutions'));
    }
    public function update(Request $request)
    {
        $request->validate(
            [
                'status' => 'required',
                'priority' => 'required',
            ]);
        $ticket=Teket::find($request->id);
        $ticket->status=$request->status;
        $ticket->priority=$request->priority;
        $ticket->save();
        return redirect()->back()->with('success', 'تم تحديث حالة التذكرة بنجاح.');
    }
function idfill($id)
{
    return redirect()->route('admin.profile.show' , ['id' => $id]);
}

}