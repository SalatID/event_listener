<?php

namespace App\Events;

class NotifikasiTigaEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->create();
    }
    public function create()
    {
        echo "event tiga ".date('Y-m-d H:i:s');
        // Notifikasi::create(['message'=>$this->data.' '.date('Y-m-d H:i:s')]);
    }
}
