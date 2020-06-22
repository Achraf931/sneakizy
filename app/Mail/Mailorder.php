<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailorder extends Mailable
{
    use Queueable, SerializesModels;
    protected $email, $name, $object, $user;

    public function __construct($email, $name, $object, $user)
    {
        $this->email = $email;
        $this->name = $name;
        $this->user = $user;
        $this->object = $object;
    }

    public function build()
    {
        return $this->from($this->email, $this->name)
            ->subject($this->object)
            ->view('mailOrder')
            ->with(['user' => $this->user]);
    }
}
