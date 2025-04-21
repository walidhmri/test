<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateTicketNotification extends Notification
{
    use Queueable;

    private $ticket;
    private $etat;
    public function __construct($ticket,$etat)
    {
        $this->etat= $etat;
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'etat' => $this->etat,
            'ticket_id' => $this->ticket->id,
            'title' => $this->ticket->title,
            'user_id' => $this->ticket->user->name,
            'priority' => $this->ticket->priority,
            'created_at' => $this->ticket->created_at,
        ];
    }
}
