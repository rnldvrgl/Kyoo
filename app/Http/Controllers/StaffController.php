<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\QueueTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index(HomeController $homeController)
    {
        // Create an instance of the QueueTicketController
        $queueTicketController = new QueueTicketController();
        $user_data = $homeController->getUserData();
        $pendingTickets = $this->getPendingTickets();
        $servingTicket = $this->getServingTicket();
        $holdingTickets = $this->getOnHoldTickets();
        $c_cancelled_tickets = $queueTicketController->countStaffCancelledTickets();

        return view(
            'dashboard.staff.regular-dashboard',
            [
                'c_cancelled_tickets' => $c_cancelled_tickets,
                'pendingTickets' => $pendingTickets,
                'user_data' => $user_data,
                'servingTicket' => $servingTicket,
                'holdingTickets' => $holdingTickets
            ]
        );
    }

    public function getPendingTickets()
    {
        $accountId = Auth::user()->id;
        $account = Accounts::find($accountId);
        $departmentId = $account->department_id;

        // Get the staff member's department id
        $pendingTickets = QueueTicket::with('services')
            ->where('department_id', $departmentId)
            ->whereIn('status', ['Pending', 'Calling']) // use whereIn instead of where
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $pendingTickets;
    }

    public function getServingTicket()
    {
        $accountId = Auth::user()->id;
        $account = Accounts::find($accountId);
        $departmentId = $account->department_id;

        // Get the staff member's department id
        $servingTicket = QueueTicket::with('services')
            ->whereIn('id', function ($query) use ($departmentId, $accountId) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('queue_tickets')
                    ->where('department_id', $departmentId)
                    ->where('account_id', $accountId)
                    ->where('status', 'Serving')
                    ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
                    ->groupBy('department_id');
            })
            ->first();

        return $servingTicket;
    }

    public function getOnHoldTickets()
    {
        $accountId = Auth::user()->id;
        $account = Accounts::find($accountId);
        $departmentId = $account->department_id;

        // Get the staff member's department id
        $HoldTickets = QueueTicket::with('services')
            ->where('department_id', $departmentId)
            ->where('account_id', $accountId)
            ->where('status', 'On Hold')
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $HoldTickets;
    }
}
