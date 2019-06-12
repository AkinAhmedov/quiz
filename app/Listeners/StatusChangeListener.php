<?php

namespace App\Listeners;

use App\Events\StatusChange;
use App\Logs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StatusChangeListener
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
     * @param  StatusChange  $event
     * @return void
     */
    public function handle(StatusChange $event)
    {
        $newstatus = ($event->data->status==1) ? 'Tamamlanmadı.' : 'Tamamlandı.';
        Logs::create(['description' => '"'.$event->data->title.'" başlıklı görev '.$newstatus]);
    }
}
