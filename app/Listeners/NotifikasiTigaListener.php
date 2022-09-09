<?php

namespace App\Listeners;

use App\Events\NotifikasiEvent;
use App\Models\NotifikasiTiga;

class NotifikasiTigaListener
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
        echo "listener tiga ".date('Y-m-d H:i:s');
        NotifikasiTiga::create(['message'=>$event->data.' '.date('Y-m-d H:i:s')]);
    }
}
