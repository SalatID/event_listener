<?php

namespace App\Events;

class NotifikasiDuaEvent extends Event
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
        sleep(2);
        echo "event dua ".date('Y-m-d H:i:s');
        // Notifikasi::create(['message'=>$this->data.' '.date('Y-m-d H:i:s')]);
    }
}
