<?php

namespace App\Providers;

use App\Events\ClearanceStatusEvent;
use App\Events\LiveQueueEvent;
use App\Events\PromotionalTextEvent;
use App\Events\PromotionalVideoEvent;
use App\Events\RequestClearanceEvent;
use App\Listeners\ClearanceStatus;
use App\Listeners\LiveQueue;
use App\Listeners\NewPromotionalText;
use App\Listeners\NewTicket;
use App\Listeners\NewVideo;
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
        ClearanceStatusEvent::class => [
            ClearanceStatus::class,
        ],
        PromotionalVideoEvent::class => [
            NewVideo::class
        ],
        PromotionalTextEvent::class => [
            NewPromotionalText::class
        ]
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
