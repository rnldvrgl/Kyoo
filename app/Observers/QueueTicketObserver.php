<?php

namespace App\Observers;

use App\Events\LiveQueueEvent;
use App\Events\PendingTicketsEvent;
use App\Events\RequestClearanceEvent;
use App\Models\QueueTicket;
use App\Models\QueueTicketService;
use Illuminate\Support\Facades\Log;

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
        if ($queueTicket->status == "Pending") {
            // Fetch the services of the created queue ticket
            $services = QueueTicketService::where('ticket_id', $queueTicket->id)->with('service')->get()->pluck('service');

            event(new PendingTicketsEvent($queueTicket, $services));
        }
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
        } else if($queueTicket->clearance_status != null && $queueTicket->clearance_status == "Cleared"){
            // 
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
