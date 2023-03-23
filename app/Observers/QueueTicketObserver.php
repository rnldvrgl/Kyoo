<?php

namespace App\Observers;

use App\Events\LiveQueueEvent;
use App\Models\QueueTicket;

class QueueTicketObserver
{
    /**
     * Handle the QueueTicket "created" event.
     *
     * @param  \App\Models\QueueTicket  $queueTicket
     * @return void
     */
    public function created(QueueTicket $queueTicket)
    {
        //
    }

    /**
     * Handle the QueueTicket "updated" event.
     *
     * @param  \App\Models\QueueTicket  $queueTicket
     * @return void
     */
    public function updated(QueueTicket $queueTicket)
    {
        event(new LiveQueueEvent($queueTicket));
    }

    /**
     * Handle the QueueTicket "deleted" event.
     *
     * @param  \App\Models\QueueTicket  $queueTicket
     * @return void
     */
    public function deleted(QueueTicket $queueTicket)
    {
        //
    }

    /**
     * Handle the QueueTicket "restored" event.
     *
     * @param  \App\Models\QueueTicket  $queueTicket
     * @return void
     */
    public function restored(QueueTicket $queueTicket)
    {
        //
    }

    /**
     * Handle the QueueTicket "force deleted" event.
     *
     * @param  \App\Models\QueueTicket  $queueTicket
     * @return void
     */
    public function forceDeleted(QueueTicket $queueTicket)
    {
        //
    }
}
