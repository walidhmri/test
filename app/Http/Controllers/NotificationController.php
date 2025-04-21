<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
{
    $notification = auth()->user()->unreadNotifications()->findOrFail($id);
    $notification->markAsRead();

    // Optionnel : redirection vers la page du ticket
    return redirect()->route('admin.Tickets.show', [
        'id' => $notification->data['ticket_id'],
        'user_id' => $notification->data['user_id'],
    ]);
}

public function delete($id)
{
    auth()->user()->notifications()->where('id', $id)->delete();
    return back();
}

public function clearAll()
{
    auth()->user()->unreadNotifications->markAsRead();
    return back();
}

public function index()
{
    $notifications = auth()->user()->notifications()->paginate(10);
    return view('notifications.index', compact('notifications'));
}

public function markSolutionAsRead($id)
{
    $notification = auth()->user()->unreadNotifications()->findOrFail($id);
    if ($notification->type === \App\Notifications\CreateSolutionNotification::class) {
        $notification->markAsRead();

        return redirect()->route('admin.Tickets.show', [
            'id' => $notification->data['ticket_id'],
            'user_id' => $notification->data['user_id']
        ]);
    }
    return back();
}

public function clearSolutionAll()
{
    $notifications = auth()->user()->unreadNotifications->where('type', \App\Notifications\CreateSolutionNotification::class);
    foreach ($notifications as $notif) {
        $notif->markAsRead();
    }
    return back();
}

public function solutionIndex()
{
    $notifications = auth()->user()->notifications()->where('type', \App\Notifications\CreateSolutionNotification::class)->paginate(10);
    return view('notifications.solution', compact('notifications'));
}


}
