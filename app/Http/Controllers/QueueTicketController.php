<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QueueTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class QueueTicketController extends Controller
{
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


    // public function serveTicket(Request $request)
    // {
    //     $queueNumber = $request->input('queueNumber');

    //     // Update the current serving ticket view with queueNumber
    //     // For example, you could update the database or session to track the current ticket being served

    //     // Update the pending tickets view with the next queue number
    //     $nextTicket = QueueTicket::where('ticket_number', '>', $queueNumber)
    //         ->orderBy('ticket_number')
    //         ->first();

    //     if ($nextTicket) {
    //         $nextQueueNumber = $nextTicket->queue_number;
    //         $nextTicketId = $nextTicket->id;
    //         $response = [
    //             'status' => 'success',
    //             'nextQueueNumber' => $nextQueueNumber,
    //             'nextTicketId' => $nextTicketId,
    //         ];
    //     } else {
    //         $response = [
    //             'status' => 'success',
    //             'nextQueueNumber' => null,
    //             'nextTicketId' => null,
    //         ];
    //     }

    //     return response()->json($response);
    // }
}
