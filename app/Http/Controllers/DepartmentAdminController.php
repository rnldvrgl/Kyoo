<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountLogin;
use App\Models\Accounts;
use App\Models\Department;
use App\Models\QueueTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentAdminController extends Controller
{
    // * FOR DEPARTMENT ADMIN DASHBOARD * //
    // Declare a property
    public $department_queue_ticket_data;

    // Fetch all queue tickets data for the department
    public function getDepartmentQueueTickets()
    {
        $accountLogin = AccountLogin::where('email', Auth::user()->email)->first();
        $account = Accounts::where('login_id', $accountLogin->id)->first();
        $department_id = $account->department_id;

        $dateToday = Carbon::now()->format('Y-m-d');
        $queueTickets = QueueTicket::where('date', $dateToday)
            ->where('department_id', $department_id)
            ->get();

        $this->department_queue_ticket_data = [
            'queueTickets' => $queueTickets,
        ];

        return $this->department_queue_ticket_data;
    }

    // Count Pending tickets for the department
    public function countDepartmentPendingTickets()
    {
        $pendingCount = 0;
        $tickets = $this->department_queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {
            if ($ticket->status == 'Pending') {
                $pendingCount++;
            }
        }

        return $pendingCount;
    }

    // Count Serving tickets for the department
    public function countDepartmentServingTickets()
    {
        $servingCount = 0;
        $tickets = $this->department_queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {
            if ($ticket->status == 'Serving' || $ticket->status == 'Calling') {
                $servingCount++;
            }
        }

        return $servingCount;
    }

    // Count Served tickets for the department
    public function countDepartmentServedTickets()
    {
        $servedCount = 0;
        $tickets = $this->department_queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {
            if ($ticket->status == 'Complete' || $ticket->status == 'Cancelled') {
                $servedCount++;
            }
        }

        return $servedCount;
    }

    // Count Cancelled tickets for the department
    public function countDepartmentCancelledTickets()
    {
        $cancelledCount = 0;
        $tickets = $this->department_queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {
            if ($ticket->status == 'Cancelled') {
                $cancelledCount++;
            }
        }

        return $cancelledCount;
    }

    // Fetch year to display on the dropdown for the department
    public function getDepartmentYear()
    {
        $accountLogin = AccountLogin::where('email', Auth::user()->email)->first();
        $account = Accounts::where('login_id', $accountLogin->id)->first();
        $department_id = $account->department_id;
        $years = QueueTicket::distinct()
            ->where('department_id', $department_id)
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

    // Fetch data based on the year selected from the dropdown for the department
    public function getDepartmentDataForYear($year)
    {
        $accountLogin = AccountLogin::where('email', Auth::user()->email)->first();
        $account = Accounts::where('login_id', $accountLogin->id)->first();
        $department_id = $account->department_id;
        $data = QueueTicket::select(DB::raw('MONTH(date) as month'), DB::raw('COUNT(*) as queue_count'))
            ->whereYear('date', $year)
            ->where('department_id', $department_id)
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy(DB::raw('MONTH(date)'))
            ->get();
        return response()->json($data);
    }
}
