<?php

namespace App\Listeners;

use App\Events\UserAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserAddedListener
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
     * @param  UserAdded  $event
     * @return void
     */
    public function handle(UserAdded $event)
    {
        //
    }
}
