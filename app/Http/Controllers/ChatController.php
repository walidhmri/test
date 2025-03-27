<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ChatController extends Controller
{
    /**
     * Display the admin chat dashboard.
     */
    public function adminDashboard(): View
    {
        return view('admin.chat');
    }

    /**
     * Get all chat sessions for admin.
     */
    public function getSessions(Request $request): JsonResponse
    {
        $query = ChatSession::with('user')
            ->orderBy('last_activity_at', 'desc');

        // Filter by status if provided
        if ($request->has('status') && in_array($request->status, ['active', 'waiting', 'closed'])) {
            $query->where('status', $request->status);
        }

        // Search by user name, email or last message
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhere('last_message', 'like', "%{$search}%");
            });
        }

        $sessions = $query->get();

        return response()->json(['data' => $sessions]);
    }

    /**
     * Get messages for a specific chat session.
     */
    public function getMessages($sessionId): JsonResponse
    {
        $session = ChatSession::with('user')->findOrFail($sessionId);
        $messages = $session->messages()->with('user:id,name')->orderBy('created_at')->get();

        // Mark all unread messages as read if admin is viewing
        if (Auth::user()->role === 'admin') {
            $session->messages()->where('is_read', false)
                ->where('sender_type', 'user')
                ->update(['is_read' => true]);

            // Update unread count
            $session->update(['unread_count' => 0]);
        }

        return response()->json([
            'session' => $session,
            'messages' => $messages
        ]);
    }

    /**
     * Send a message from staff to user.
     */
    public function sendStaffMessage(Request $request, $sessionId): JsonResponse
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $session = ChatSession::findOrFail($sessionId);

        $message = $session->messages()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'sender_type' => 'staff',
            'is_read' => false
        ]);

        // Update session last message and activity
        $session->update([
            'last_message' => $request->content,
            'last_activity_at' => now()
        ]);

        return response()->json($message);
    }

    /**
     * Update chat session status.
     */
    public function updateSessionStatus(Request $request, $sessionId): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:active,waiting,closed'
        ]);

        $session = ChatSession::findOrFail($sessionId);
        $session->update(['status' => $request->status]);

        return response()->json($session);
    }

    /**
     * Create a new chat session for a user.
     */
    public function createSession(Request $request): JsonResponse
    {
        // Check if user already has an active session
        $existingSession = ChatSession::where('user_id', Auth::id())
            ->whereIn('status', ['active', 'waiting'])
            ->first();

        if ($existingSession) {
            return response()->json($existingSession);
        }

        // Create new session
        $session = ChatSession::create([
            'user_id' => Auth::id(),
            'status' => 'waiting',
            'last_activity_at' => now()
        ]);

        // Add initial welcome message
        $message = $session->messages()->create([
            'content' => 'Hello! How can we help you today?',
            'sender_type' => 'staff',
            'is_read' => true
        ]);

        // Update session with initial message
        $session->update([
            'last_message' => $message->content
        ]);

        return response()->json([
            'id' => $session->id,  // ✅ تأكد من تضمين الـ `id`
            'user_id' => $session->user_id,
            'status' => $session->status,
            'last_activity_at' => $session->last_activity_at,
            'last_message' => $session->last_message,
            'created_at' => $session->created_at,
            'updated_at' => $session->updated_at,
            'messages' => $session->messages // ✅ تأكد من تضمين الرسائل أيضًا
        ]);    }

    /**
     * Send a message from user to staff.
     */
    public function sendUserMessage(Request $request): JsonResponse
    {
        $request->validate([
            'content' => 'required|string',
            'session_id' => 'required|exists:chat_sessions,id'
        ]);

        $session = ChatSession::findOrFail($request->session_id);

        // Ensure the session belongs to the authenticated user
        if ($session->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message = $session->messages()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'sender_type' => 'user',
            'is_read' => false
        ]);

        // Update session last message, activity and unread count
        $session->update([
            'last_message' => $request->content,
            'last_activity_at' => now(),
            'unread_count' => $session->unread_count + 1
        ]);

        return response()->json($message);
    }

    /**
     * Get the current user's active chat session.
     */
    public function getUserSession(): JsonResponse
    {
        $session = ChatSession::with('messages')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['active', 'waiting'])
            ->first();

        return response()->json($session);
    }
}