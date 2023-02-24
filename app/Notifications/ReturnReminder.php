<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReturnReminder extends Notification
 implements ShouldQueue
{
    use Queueable;

    public $username;
    public $bookname;
    public $lateint;
    public $latefee;

    public function __construct($username,$bookname,$lateint)
    {
        $this->username = $username;
        $this->bookname = $bookname;
        $this->lateint = $lateint;
        $this->latefee = $lateint*10;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->username.', we are observing that it has been a long time you didn"t return the book'.$this->bookname.'. You are fined '.$this->latefee.'Taka for this disobidience.')
                    // ->action('Notification Action', url('/'))
                    ->line('Please return the book and contact with the librarian.');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
