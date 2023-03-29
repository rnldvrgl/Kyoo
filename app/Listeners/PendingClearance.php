<?php

namespace App\Listeners;

use App\Events\RequestClearanceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PendingClearance
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\RequestClearanceEvent  $event
     * @return void
     */
    public function handle(RequestClearanceEvent $event)
    {
        return $event;
    }
}
