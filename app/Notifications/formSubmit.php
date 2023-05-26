<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class formSubmit extends Notification
{
    use Queueable;

    private $report_id;
    private $note;
    /**
     * Create a new notification instance.
     */
    public function __construct($report_id,$note)
    {
        $this->report_id =  $report_id;
        $this->note =  $note;
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
    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage)
                    ->content('One of your invoices has been paid!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'report_id'=>$this->report_id,
            'note'=>$this->note,
            'user_created'=>auth()->user()->name
        ];
    }
}
