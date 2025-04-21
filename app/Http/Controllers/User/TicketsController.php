<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Solution;
use Illuminate\Http\Request;
use App\Models\ticket;
use App\Models\User;
use App\Jobs\GenerateAISolution; 
use Illuminate\Support\Facades\Http;


class TicketsController extends Controller
{

    public function index(Request $request)
    {
        $query = ticket::where('user_id', auth()->user()->id);
        
        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by priority
        if ($request->has('priority') && $request->priority != 'all') {
            $query->where('priority', $request->priority);
        }
        
        // Search by title
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        // Sort order
        $sortField = $request->has('sort_field') ? $request->sort_field : 'id';
        $sortOrder = $request->has('sort_order') ? $request->sort_order : 'desc';
        
        $query->orderBy($sortField, $sortOrder);
        
        $tickets = $query->paginate(10)->appends($request->except('page'));
        
        return view('employee.liste', compact('tickets'));
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
        'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096', 
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

    $ticket=ticket::create([
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
        'user_id' => auth()->user()->id,
        'file' => $filepath
    ]); 
    $ticket->save();

    GenerateAISolution::dispatch($ticket);

    return redirect()->route('employee.tickets.list')->with('success', 'تمت إضافة التذكرة بنجاح. سيتم إنشاء الحل قريبًا.');
}


    

  
public function show(string $id)
{
    $ticket = ticket::findOrFail($id);
    $solutions = Solution::where('ticket_id', $ticket->id)->get(); // Get all solutions for the ticket
    $comments = Comment::where('ticket_id', $ticket->id)
                      ->orderBy('created_at', 'asc')
                      ->get(); // Get all comments for the ticket
    
    return view('employee.show', compact('ticket', 'solutions', 'comments'));
}

public function addComment(Request $request, string $id)
{
    $request->validate([
        'content' => 'required|string'
    ]);
    
    $ticket = ticket::findOrFail($id);
    
    $comment = new Comment();
    $comment->ticket_id = $ticket->id;
    $comment->user_id = auth()->id();
    $comment->content = $request->content;
    $comment->save();
    
    return redirect()->back()->with('success', 'Commentaire ajouté avec succès');
}

 

    public function edit(string $id)
    {

        $ticket = ticket::findOrFail($id);
        if($ticket->status == 'solved' || $ticket->status == 'closed'){
            return redirect()->route('employee.tickets.list')->with('error', 'Ticket is closed and cannot be edited already '.$ticket->status.' status');
        }
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
        $ticket=ticket::find($request->id);
        $ticket->title=$request->title;
        $ticket->description=$request->description;
        $ticket->priority=$request->priority;
        $ticket->save();
    
        return redirect()->route('employee.tickets.list')->with('success', 'Ticket mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
      
         $ticket=ticket::find($request->id);
         if(!$ticket){
            return redirect()->route('employee.tickets.list')->with('error', 'Ticket not found');
         }
         $ticket->delete();
        return redirect()->route('employee.tickets.list')->with('success', 'Ticket supprimé avec succès');
    }

}
