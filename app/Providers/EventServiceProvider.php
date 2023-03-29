<?php

namespace App\Providers;

use App\Events\LiveQueueEvent;
use App\Events\PendingTicketsEvent;
use App\Events\RequestClearanceEvent;
use App\Listeners\LiveQueue;
use App\Listeners\NewTicket;
use App\Listeners\PendingClearance;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LiveQueueEvent::class => [
            LiveQueue::class,
        ],
        NewTicketEvent::class => [
            NewTicket::class,
        ],
        RequestClearanceEvent::class => [
            PendingClearance::class,
        ],
        // Event::class => [Listener::class],
        // ! NOTE: Execute php artisan event:generate after registering the event listener
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
