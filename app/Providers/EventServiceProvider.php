<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Created' => [
            'App\Listeners\CreatedListener',
        ],
        'App\Events\Deleted' => [
            'App\Listeners\DeletedListener',
        ],
        'App\Events\Updated' => [
            'App\Listeners\UpdatedListener',
        ],
        'App\Events\StatusChange' => [
            'App\Listeners\StatusChangeListener',
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
