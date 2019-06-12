<?php

namespace App\Listeners;

use App\Events\Deleted;
use App\Logs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletedListener
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
     * @param  Deleted  $event
     * @return void
     */
    public function handle(Deleted $event)
    {
        Logs::create(['description' => '"'.$event->data->title.'" başlıklı görev Silindi.']);
    }
}
