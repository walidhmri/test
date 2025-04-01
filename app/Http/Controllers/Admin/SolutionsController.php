<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use App\Models\ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SolutionsController extends Controller
{
    public function index(Request $request)
    {
        $ticket = ticket::find($request->id);
        $solutions = Solution::where('ticket_id', $ticket->id)->get();
        return view('admin.solutions.create',compact('solutions','ticket'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'ticket_id' => 'required',
        ]);
        $solution = new Solution();
        $solution->title = $request->title;
        $solution->description = $request->description;
        $solution->ticket_id = $request->ticket_id;
        $solution->user_id = Auth::user()->id;
        $solution->save();
        return redirect()->route('admin.tickets.show', [ 'user_id' => $request->user_id,'id' => $request->ticket_id ,])->with('success', 'تم إضافة حل التذكرة بنجاح.');
    }
    public function destroy(Request $request)
    {
        $solution = Solution::find($request->id);
        $solution->delete();
        return redirect()->back()->with('success', 'تم  حذف حل التذكرة بنجاح.');
        
    }
    public function update(Request $request)
    {
        $solution = Solution::find($request->id);
        $solution->title = $request->title;
        $solution->description = $request->description;
        $solution->save();
        return redirect()->back()->with('success', 'تم تعديل حل التذكرة ' . $solution->id . ' بنجاح.');
    }
}
