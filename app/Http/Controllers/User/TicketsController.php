<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use Illuminate\Http\Request;
use App\Models\Teket;
use App\Models\User;
use App\Jobs\GenerateAISolution; 
use Illuminate\Support\Facades\Http;


class TicketsController extends Controller
{

    public function index()
    {
        $tickets = Teket::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        return view('employee.liste',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('employee.tickets');
    }

    /**
     * Store a newly created resource in storage.
     */// Ajoute cette ligne en haut

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'priority'=>'required',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', 
    ]);

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destination = public_path('storage/uploads'); 

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $file->move($destination, $filename);

        $filepath = 'uploads/' . $filename;
    } else {
        $filepath = null;
    }

    $ticket=Teket::create([
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
        'user_id' => auth()->user()->id,
        'file' => $filepath
    ]); 
    $ticket->save();

    // ✅ Lancer le Job pour générer la solution en arrière-plan
    GenerateAISolution::dispatch($ticket);

    return redirect()->route('dasboard.tickets')->with('success', 'تمت إضافة التذكرة بنجاح. سيتم إنشاء الحل قريبًا.');
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
        $ticket = Teket::findOrFail($id); // Get a single model instance
        return view('employee.update', compact('ticket')); // Adjust view name as needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high,urgent', 
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', 
        ]);
        $ticket=Teket::find($request->id);
        $ticket->title=$request->title;
        $ticket->description=$request->description;
        $ticket->priority=$request->priority;
        $ticket->save();
    
        return redirect()->back()->with('success', 'Ticket mis à jour avec succès.');
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
