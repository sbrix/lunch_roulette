<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class RSVPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $e,User $u)
    {
        $this->event=$e;
        $this->user=$u;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.RSVPMail');
    }
}
