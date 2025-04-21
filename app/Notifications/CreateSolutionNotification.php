<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateSolutionNotification extends Notification
{
    use Queueable;

    private $solution;
    private $etat;

    /**
     * Create a new notification instance.
     */
    public function __construct($solution, $etat)
    {
        $this->etat = $etat;
        $this->solution = $solution;
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
            'id' => $this->solution->id,
            'ticket_id' => $this->solution->ticket_id,
            'user_id' => $this->solution->user->name,
        ];
    }
}
