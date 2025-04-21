<div class="Ticket">
    <h2>{{ $ticket->title }}</h2>
    <p>Created by: {{ $ticket->user->name }}</p>
    <p>Status: {{ $ticket->status }}</p>
</div>