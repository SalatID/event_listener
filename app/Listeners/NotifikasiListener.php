<?php

namespace App\Listeners;

use App\Events\NotifikasiEvent;
use App\Models\Notifikasi;

class NotifikasiListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $data;
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  NotifikasiEvent  $event
     * @return void
     */
    public function handle(NotifikasiEvent $event)
    {
        echo "listener satu ".date('Y-m-d H:i:s');
        Notifikasi::create(['message'=>$event->data.' '.date('Y-m-d H:i:s')]);
    }
}
