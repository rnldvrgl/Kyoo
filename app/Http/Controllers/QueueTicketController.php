<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QueueTicket;
use Illuminate\Http\Request;

class QueueTicketController extends Controller
{
    // Declare a property
    public $queue_ticket_data;

    // Fetch all queue tickets data
    public function getQueueTickets()
    {
        $queueTickets = QueueTicket::all();

        $this->queue_ticket_data = [
            'queueTickets' => $queueTickets,
        ];

        return $this->queue_ticket_data;
    }

    // Count Pending tickets
    public function countPendingTickets()
    {
        $pendingCount = 0;

        $tickets = $this->queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {

            if ($ticket->status == 'Pending') {
                $pendingCount++;
            }
        }
        return $pendingCount;
    }

    // Count Serving tickets
    public function countServingTickets()
    {
        $servingCount = 0;

        $tickets = $this->queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {

            if ($ticket->status == 'Serving') {
                $servingCount++;
            }
        }
        return $servingCount;
    }

    // Count Served tickets
    public function countServedTickets()
    {
        $servedCount = 0;

        $tickets = $this->queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {

            if ($ticket->status == 'Served') {
                $servedCount++;
            }
        }
        return $servedCount;
    }

    // Count Cancelled tickets
    public function countCancelledTickets()
    {
        $cancelledCount = 0;

        $tickets = $this->queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {

            if ($ticket->status == 'Cancelled') {
                $cancelledCount++;
            }
        }
        return $cancelledCount;
    }
}
