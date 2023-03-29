<?php

namespace App\Listeners;

use App\Events\RemoveFromLiveQueueEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IsQueueComplete
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\RemoveFromLiveQueueEvent  $event
     * @return void
     */
    public function handle(RemoveFromLiveQueueEvent $event)
    {
        return $event;
    }
}
