<?php

namespace App\Listeners;

use App\Events\NewTicketEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewTicket
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\NewTicketEvent  $event
     * @return void
     */
    public function handle(NewTicketEvent $event)
    {
        return $event;
    }
}
