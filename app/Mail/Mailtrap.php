<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailtrap extends Mailable
{
    use Queueable, SerializesModels;
    protected $email, $name, $object, $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $object, $content)
    {
        $this->email = $email;
        $this->name = $name;
        $this->object = $object;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, $this->name)
            ->subject($this->object)
            ->view('mail')
            ->with(['content' => $this->content]);
    }
}
