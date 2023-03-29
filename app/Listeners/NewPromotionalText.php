<?php

namespace App\Listeners;

use App\Events\PromotionalTextEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewPromotionalText
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\PromotionalTextEvent  $event
     * @return void
     */
    public function handle(PromotionalTextEvent $event)
    {
        return $event;
    }
}
