<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\QueueTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index(HomeController $homeController)
    {
        $user_data = $homeController->getUserData();
        $pendingTickets = $this->getPendingTickets();

        return view('dashboard.staff.dashboard', ['pendingTickets' => $pendingTickets, 'user_data' => $user_data]);
    }

    public function getPendingTickets()
    {
        $accountId = Auth::user()->id;
        $account = Accounts::find($accountId);
        $departmentId = $account->department_id;

        // Get the staff member's department id
        $pendingTickets = QueueTicket::with('services')
            ->where('department_id', $departmentId)
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $pendingTickets;
    }
}
