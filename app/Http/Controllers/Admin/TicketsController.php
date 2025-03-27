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
        $tickets = Teket::paginate(10);
        $employees = User::where('role', 'user')->get();
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
        $employee = User::find($request->user_id);
        $ticket=Teket::find($request->id);
        return view('admin.ticket.show',compact('ticket','employee'));
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
    public function filter(Request $request)
{
    $employees = User::where('role', 'user')->get();

    if (!$request->filled('priority') && !$request->filled('employee_id') && !$request->filled('status') && !$request->filled('month')) {
        return redirect()->route('admin.tickets.list');
    }

    $query = Teket::query();
    if ($request->filled(key: 'month')) {
        $selectedDate = strtotime($request->month); // تحويل إلى Timestamp
        $query->whereYear('created_at', date('Y', $selectedDate))
              ->whereMonth('created_at', date('m', $selectedDate));
    }
    if ($request->filled('priority')) {
        $query->where('priority', $request->priority);
    }
    if ($request->filled('employee_id')) {
        $query->where('user_id', $request->employee_id); // يجب أن يكون الحقل مطابقًا لهيكل قاعدة البيانات
    }
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // تنفيذ البحث مع التصفح
    $tickets = $query->paginate(10)->appends($request->query());

    return view('admin.ticket.list', compact('tickets', 'employees'));
}

}
