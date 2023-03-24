<?php

namespace App\Listeners;

use App\Events\PendingTicketsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewTicket
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\PendingTicketsEvent  $event
     * @return void
     */
    public function handle(PendingTicketsEvent $event)
    {
        return $event;
    }
}
