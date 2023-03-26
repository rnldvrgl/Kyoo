<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\QueueTicket;
use App\Models\QueueTicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistrarController extends Controller
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
        $c_completed_tickets = $queueTicketController->countStaffCompletedTickets();
        $avg_serving_time = $queueTicketController->getAverageServiceTime();
        $avg_wait_time = $queueTicketController->getAverageWaitingTime();


        return view(
            'dashboard.staff.registrar-dashboard',
            [
                'avg_wait_time' => $avg_wait_time,
                'avg_serving_time' => $avg_serving_time,
                'c_cancelled_tickets' => $c_cancelled_tickets,
                'c_completed_tickets' => $c_completed_tickets,
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
            ->whereIn('id', function ($query) use ($departmentId) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('queue_tickets')
                    ->where('department_id', $departmentId)
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
            ->where('status', 'On Hold')
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $HoldTickets;
    }
}
