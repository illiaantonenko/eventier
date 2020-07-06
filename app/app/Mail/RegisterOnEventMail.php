<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterOnEventMail extends Mailable
{
    use Queueable, SerializesModels;

    private $event;
    private $eventRegistration;
    private $user;

    /**
     * Create a new message instance.
     *
     * @param $eventRegistration
     */
    public function __construct($eventRegistration)
    {
        $this->eventRegistration = $eventRegistration;
        $this->user = User::where('id','=',$eventRegistration->user_id)->with('profile')->first();
        $this->event = Event::where('id','=',$eventRegistration->event_id)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.eventRegistration')->with([
            'hash' => $this->eventRegistration->hash,
            'user' => $this->user,
            'event' =>$this->event
        ]);
    }
}
