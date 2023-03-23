<?php

namespace App\Listeners;

use App\Events\LiveQueueEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LiveQueue implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\LiveQueueEvent  $event
     * @return void
     */
    public function handle(LiveQueueEvent $event)
    {
        return $event;
    }
}
