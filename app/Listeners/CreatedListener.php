<?php

namespace App\Listeners;

use App\Events\Created;
use App\Logs;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatedListener
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
     * @param  Created  $event
     * @return void
     */
    public function handle(Created $event)
    {
        Logs::create(['description' => '"'.$event->data->title.'" başlıklı görev Oluşturuldu.']);
    }
}
