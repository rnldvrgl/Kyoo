<?php

namespace App\Observers;

use App\Models\PromotionalVideo;
use App\Events\PromotionalVideoEvent;

class PromotionalVideoObserver
{
    /**
     * Handle the PromotionalVideo "created" event.
     *
     * @param  \App\Models\PromotionalVideo  $promotionalVideo
     * @return void
     */
    public function created(PromotionalVideo $promotionalVideo)
    {
        // 
    }

    /**
     * Handle the PromotionalVideo "updated" event.
     *
     * @param  \App\Models\PromotionalVideo  $promotionalVideo
     * @return void
     */
    public function updated(PromotionalVideo $promotionalVideo)
    {
        if($promotionalVideo->is_active == 1){
            event(new PromotionalVideoEvent($promotionalVideo));
        }
    }

    /**
     * Handle the PromotionalVideo "deleted" event.
     *
     * @param  \App\Models\PromotionalVideo  $promotionalVideo
     * @return void
     */
    public function deleted(PromotionalVideo $promotionalVideo)
    {
        //
    }

    /**
     * Handle the PromotionalVideo "restored" event.
     *
     * @param  \App\Models\PromotionalVideo  $promotionalVideo
     * @return void
     */
    public function restored(PromotionalVideo $promotionalVideo)
    {
        //
    }

    /**
     * Handle the PromotionalVideo "force deleted" event.
     *
     * @param  \App\Models\PromotionalVideo  $promotionalVideo
     * @return void
     */
    public function forceDeleted(PromotionalVideo $promotionalVideo)
    {
        //
    }
}
