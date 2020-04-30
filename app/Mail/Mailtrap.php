<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailtrap extends Mailable
{
    private $url;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sneakizy@ecommerce.com', 'Sneakizy')
            ->subject('SnapMail message')
            ->view('mail')
            ->with(['url' => $this->url]);
    }
}
