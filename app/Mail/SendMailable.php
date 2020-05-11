<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($to,$temp_password,$name)
    {
        $this->to = $to;
        $this->temp_password = $temp_password;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return view('email.create')->with([
            'name'          => $this->name,
            'password'      => $this->temp_password,
            'email'         => $this->to
        ]);
    }
}
