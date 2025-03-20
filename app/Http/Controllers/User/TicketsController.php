<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teket;
use App\Models\User;


class TicketsController extends Controller
{

    public function index()
    {
        $tickets = Teket::where('user_id', auth()->user()->id)->paginate(5);
        return view('employee.tickets',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('employee.tickets.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority'=>'required'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filepath = $file->store('uploads','public');
        } else {
            return back()->withErrors(['error' => 'يرجى اختيار ملف للرفع.']);
        }
        
        
        $ticket=Teket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => auth()->user()->id,
            'file' => $filepath
        ]); 
        return redirect()->route('dasboard.tickets')->with('success', 'تمت إضافة التذكرة بنجاح.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
      
         $ticket=Teket::find($request->id);
         if(!$ticket){
            return redirect()->route('employee.tickets')->with('error', 'Ticket not found');
         }
         $ticket->delete();
        return redirect()->route('dasboard.tickets')->with('success', 'Ticket supprimé avec succès');
    }
}
