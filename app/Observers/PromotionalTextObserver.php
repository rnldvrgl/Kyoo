<?php

namespace App\Observers;

use App\Events\PromotionalTextEvent;
use App\Models\PromotionalText;

class PromotionalTextObserver
{
    /**
     * Handle the PromotionalText "created" event.
     *
     * @param  \App\Models\PromotionalText  $promotionalText
     * @return void
     */
    public function created(PromotionalText $promotionalText)
    {
        //
    }

    /**
     * Handle the PromotionalText "updated" event.
     *
     * @param  \App\Models\PromotionalText  $promotionalText
     * @return void
     */
    public function updated(PromotionalText $promotionalText)
    {
        event(new PromotionalTextEvent($promotionalText));
    }

    /**
     * Handle the PromotionalText "deleted" event.
     *
     * @param  \App\Models\PromotionalText  $promotionalText
     * @return void
     */
    public function deleted(PromotionalText $promotionalText)
    {
        //
    }

    /**
     * Handle the PromotionalText "restored" event.
     *
     * @param  \App\Models\PromotionalText  $promotionalText
     * @return void
     */
    public function restored(PromotionalText $promotionalText)
    {
        //
    }

    /**
     * Handle the PromotionalText "force deleted" event.
     *
     * @param  \App\Models\PromotionalText  $promotionalText
     * @return void
     */
    public function forceDeleted(PromotionalText $promotionalText)
    {
        //
    }
}
