<?php

namespace App\Listeners;

use App\Events\ProductAdded;
use App\Events\SneakerAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SneakerAddedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SneakerAdded  $event
     * @return void
     */
    public function handle(SneakerAdded $event)
    {
        //
    }
}
