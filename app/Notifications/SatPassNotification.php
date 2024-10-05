<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SatPassNotification extends Notification
{
    use Queueable;
    public $user;
    public $location;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $location)
    {
        $this->user = $user;
        $this->location = $location;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $via_=[];
        if($this->location=='email'){
            $via_[]='mail';
        }
        if($this->location=='sms'){
            $via_[]='sms';
        }
        if($this->location=='both'){
            $via_[]='mail';
            $via_[]='sms';
        }
        // return $via_;
        return ['mail'];
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
            //
        ];
    }
}
