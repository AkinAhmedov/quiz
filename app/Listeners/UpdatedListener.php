<?php

namespace App\Listeners;

use App\Events\Updated;
use App\Logs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  Updated  $event
     * @return void
     */
    public function handle(Updated $event)
    {
        Logs::create(['description' => '"'.$event->data->title.'" başlıklı görev Güncellendi.']);
    }
}
