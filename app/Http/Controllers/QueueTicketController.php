<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Http\Controllers\Controller;
use App\Models\QueueTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class QueueTicketController extends Controller
{
    // * FOR MAIN ADMIN DASHBOARD * //
    // Declare a property
    public $queue_ticket_data;

    // Fetch all queue tickets data
    public function getQueueTickets()
    {
        $dateToday = Carbon::now()->format('Y-m-d');

        $queueTickets = QueueTicket::where('date', $dateToday)->get();

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

    // Fetch year to display on the dropdown
    public function getYear()
    {
        $years = QueueTicket::distinct()
            ->pluck('date')
            ->map(function ($date) {
                return Carbon::parse($date)->year;
            })
            ->unique()
            ->sort('date', 'desc')
            ->values()
            ->toArray();

        rsort($years); // sort by year value

        return compact('years');
    }

    // Fetch data based on the year selected from the dropdown
    public function getDataForYear($year)
    {
        $data = QueueTicket::select(DB::raw('MONTH(date) as month'), DB::raw('COUNT(*) as queue_count'))
            ->whereYear('date', $year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy(DB::raw('MONTH(date)'))
            ->get();

        return response()->json($data);
    }


    // * FOR STAFF SERVING TICKET * //
    public function show($id)
    {
        $ticket = QueueTicket::findOrFail($id);

        return response()->json($ticket);
    }

    public function updateStatus(Request $request, $status)
    {
        $ticketId = $request->ticketId;

        // Retrieve the ticket by ID
        $ticket = QueueTicket::find($ticketId);

        if ($ticket) {

            if ($request->notes) {
                $ticket->notes = $request->notes;
            }

            // Only update the clearance status if it's provided in the request
            if ($request->has('clearance_status')) {
                $clearanceStatus = $request->clearance_status;
                $ticket->clearance_status = $clearanceStatus;
            }

            // Check the actual clearance status of the ticket
            // $actualClearanceStatus = $ticket->clearance_status;

            // Only update the clearance status in the session if it's different from the actual clearance status
            // if ($clearanceStatus !== $actualClearanceStatus) {
            //     session(['clearance_status' => $actualClearanceStatus]);
            // }

            // Update the ticket status
            $ticket->status = $status;

            if ($status === 'Calling') {
                // Add timestamp to called_at column
                if (!$ticket->called_at && !$ticket->waiting_time) {
                    $ticket->called_at = now();
                    $ticket->waiting_time = $ticket->called_at->diffInSeconds($ticket->created_at);
                }
            } elseif ($status === 'Serving') {

                // Event Trigger for Live Queue 
                event(new TestEvent($ticket));

                // Add timestamp to served_at column
                if (!$ticket->served_at) {
                    $ticket->served_at = now();
                }
            } elseif ($status === 'Complete') {
                // Add timestamp to completed_at column
                if (!$ticket->completed_at && !$ticket->service_time && $ticket->served_at) {
                    $ticket->completed_at = now();
                    $ticket->service_time = $ticket->completed_at->diffInSeconds($ticket->served_at);
                }
            }

            $ticket->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ticket not found']);
        }
    }


    public function updateClearanceStatus(Request $request)
    {
        $ticketId = $request->ticketId;

        // Retrieve the ticket by ID
        $ticket = QueueTicket::find($ticketId);

        if ($ticket) {

            if ($request->clearance_status) {
                // Set the clearance status in the session
                session(['clearance_status' => $request->clearance_status]);
                $ticket->clearance_status = $request->clearance_status;
            } else {
                // Get the clearance status from the session
                $ticket->clearance_status = session('clearance_status');
            }

            $ticket->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ticket not found']);
        }
    }


    public function signClearance(Request $request, $status)
    {
        $ticketId = $request->ticketId;

        // Retrieve the ticket by ID
        $ticket = QueueTicket::find($ticketId);

        if ($ticket) {


            // Update the ticket status
            $ticket->clearance_status = $status;

            $ticket->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ticket not found']);
        }
    }
}
