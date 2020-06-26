<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailorder extends Mailable
{
    use Queueable, SerializesModels;
    protected $email, $name, $products;

    public function __construct($email, $name, $products)
    {
        $this->email = $email;
        $this->name = $name;
        $this->products = $products;
    }

    public function build()
    {
        return $this->from($this->email, $this->name)
            ->subject('Merci pour votre commande !')
            ->view('mailOrder')
            ->with(['products' => $this->products]);
    }
}
