<?php

namespace App\Listeners;

use App\Events\ClearanceStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearanceStatus
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ClearanceStatusEvent  $event
     * @return void
     */
    public function handle(ClearanceStatusEvent $event)
    {
        return $event;
    }
}
