<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SneakerAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sneaker;

    public function __construct($sneaker)
    {
        $this->sneaker = $sneaker;
    }

    public function broadcastOn()
    {
        return new Channel('sneakers');
    }
}
