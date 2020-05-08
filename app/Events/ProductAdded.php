<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function broadcastOn()
    {
        return new Channel('products');
    }
}
