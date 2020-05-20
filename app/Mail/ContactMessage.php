<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Contact;
class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->data = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data->mail, $this->data->lastName)
            ->subject($this->data->subject)
            ->markdown('mail.email')
            ->with([
                'firstName' => $this->data->firstName,
                'lastName' => $this->data->lastName,
                'subject' => $this->data->subject,
                'message' => $this->data->message,
            ]);
    }
}
