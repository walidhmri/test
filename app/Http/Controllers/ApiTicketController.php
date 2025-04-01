<?php
// app/Http/Controllers/TicketController.php

namespace App\Http\Controllers;

use App\Models\ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApiTicketController extends Controller
{
    public function index()
    {
        $tickets = ticket::where('user_id', Auth::id())->with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($tickets);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string|in:low,medium,high,urgent',
            'file' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket = new ticket();
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->priority = $request->priority;
        $ticket->status = 'pending';
        $ticket->user_id = Auth::id();
        
        if ($request->has('file')) {
            $ticket->file = $request->file;
        }
        
        $ticket->save();

        return response()->json([
            'message' => 'Ticket created successfully',
            'ticket' => $ticket,
        ], 201);
    }

    public function show($id)
    {
        $ticket = ticket::where('user_id', Auth::id())->with('user')->findOrFail($id);
        return response()->json($ticket);
    }

    public function update(Request $request, $id)
    {
        $ticket = ticket::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string|in:low,medium,high,urgent',
            'status' => 'required|string|in:pending,in-progress,resolved,closed',
            'signedToEnG' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->priority = $request->priority;
        $ticket->status = $request->status;
        $ticket->signedToEnG = $request->signedToEnG;
        $ticket->save();

        return response()->json([
            'message' => 'Ticket updated successfully',
            'ticket' => $ticket,
        ]);
    }

    public function destroy($id)
    {
        $ticket = ticket::findOrFail($id);
        $ticket->delete();

        return response()->json([
            'message' => 'Ticket deleted successfully',
        ]);
    }

    public function dashboard()
    {
        // Get total tickets count
        $totalTickets = ticket::where('user_id', Auth::id())->count();
        
        // Get tickets by status
        $pendingTickets = ticket::where('status', 'pending')
            ->where('user_id', Auth::id())
            ->count();
        
        $resolvedTickets = ticket::where('status', 'resolved')
        ->where('user_id', Auth::id())
        ->count();
        
        // Get urgent tickets
        $urgentTickets = ticket::where('priority', 'urgent')
        ->where('user_id', Auth::id())
        ->count();
        
        // Get ticket counts by priority
        $priorityCounts = [
            'low' => ticket::where('priority', 'low')
            ->where('user_id', Auth::id())
            ->count(),
            'medium' => ticket::where('priority', 'medium')
            ->where('user_id', Auth::id())
            ->count(),
            'high' => ticket::where('priority', 'high')
            ->where('user_id', Auth::id())
            ->count(),
            'urgent' => $urgentTickets,
        ];
        
        // Get ticket counts by status
        $statusCounts = [
            'pending' => $pendingTickets,
            'in-progress' => ticket::where('status', 'in-progress')
            ->where('user_id', Auth::id())
            ->count(),
            'resolved' => $resolvedTickets,
            'closed' => ticket::where('status', 'closed')
            ->where('user_id', Auth::id())
            ->count(),
        ];
        
        // Get recent tickets
        $recentTickets = ticket::with('user')
                              ->where('user_id', Auth::id())
                              ->orderBy('created_at', 'desc')
                              ->limit(5)
                              ->get();

        return response()->json([
            'total_tickets' => $totalTickets,
            'pending_tickets' => $pendingTickets,
            'resolved_tickets' => $resolvedTickets,
            'urgent_tickets' => $urgentTickets,
            'priority_counts' => $priorityCounts,
            'status_counts' => $statusCounts,
            'recent_tickets' => $recentTickets,
        ]);
    }
}