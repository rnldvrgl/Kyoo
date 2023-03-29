<?php

namespace App\Observers;

use App\Events\ClearanceStatusEvent;
use App\Models\QueueTicket;
use App\Events\LiveQueueEvent;
use App\Events\NewTicketEvent;
use Illuminate\Support\Facades\Log;
use App\Events\RequestClearanceEvent;

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
        event(new NewTicketEvent($queueTicket));
    }

    /**
     * Handle the QueueTicket "updated" event.
     *
     * @param  \App\Models\QueueTicket  $queueTicket
     * @return void
     */
    public function updated(QueueTicket $queueTicket)
    {
        if ($queueTicket->status == "Serving" || $queueTicket->status == "Calling") {
            event(new LiveQueueEvent($queueTicket));
        }

        if($queueTicket->clearance_status != null && $queueTicket->clearance_status == "Pending")
        {
            event(new RequestClearanceEvent($queueTicket));
        } else if($queueTicket->clearance_status != null && $queueTicket->clearance_status == "Cleared" || $queueTicket->clearance_status == "Not Cleared"){
            event(new ClearanceStatusEvent($queueTicket));
        }
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
