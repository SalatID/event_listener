<?php

namespace App\Events;
use App\Models\Notifikasi;

class NotifikasiEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data=$data;
        $this->create();
    }

    public function create()
    {
        echo "event satu ".date('Y-m-d H:i:s');
        // Notifikasi::create(['message'=>$this->data.' '.date('Y-m-d H:i:s')]);
    }

}
