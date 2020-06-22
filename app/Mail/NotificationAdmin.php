<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Message;
class NotificationAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct(Message $message)
    {
        $this->data = $message;
    }

    public function build()
    {
        return $this->from('mail@example.com', 'Mailtrap')
            ->subject('New Order')
            ->markdown('mail.messageAdmin')
            ->with([
                'firstName' => $this->data->firstName,
                'nickname' => $this->data->nickname,
                'address' => $this->data->address,
                'postal' => $this->data->postalCode,
                'city' => $this->data->city,
                'dataSession' => $this->data->dataSession,
            ]);

    }
}
