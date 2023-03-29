<?php

namespace App\Listeners;

use App\Events\PromotionalVideoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewVideo
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\PromotionalVideoEvent  $event
     * @return void
     */
    public function handle(PromotionalVideoEvent $event)
    {
        return $event;
    }
}
