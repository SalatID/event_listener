<?php

namespace App\Listeners;

use App\Events\NotifikasiEvent;
use App\Models\NotifikasiDua;

class NotifikasiDuaListener
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
     * @param  NotifikasiEvent  $event
     * @return void
     */
    public function handle(NotifikasiEvent $event)
    {
        sleep(10);
        echo "listener dua ".date('Y-m-d H:i:s');
        // NotifikasiDua::create(['message'=>$event->data.' '.date('Y-m-d H:i:s')]);
    }
}
