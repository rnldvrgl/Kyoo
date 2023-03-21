<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\QueueTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LibrarianController extends Controller
{
    public function index(HomeController $homeController)
    {

        $user_data = $homeController->getUserData();
        $p_c_clearance_tickets = $this->getCollegesPendingClearance();
        $p_hs_clearance_tickets = $this->getHSPendingClearances();

        return view(
            'dashboard.staff.librarian-dashboard',
            [
                'p_hs_clearance_tickets' => $p_hs_clearance_tickets,
                'p_c_clearance_tickets' => $p_c_clearance_tickets,
                'user_data' => $user_data,
            ]
        );
    }


    public function getCollegesPendingClearance()
    {
        // Get the staff member's department id
        $p_c_clearance_tickets = QueueTicket::with('services')
            ->where('student_department', ['College', 'Graduate School'])
            ->where('clearance_status', 'Pending')
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $p_c_clearance_tickets;
    }

    public function getHSPendingClearances()
    {
        // Get the staff member's department id
        $p_hs_clearance_tickets = QueueTicket::with('services')
            ->where('student_department', ['Senior High School', 'Junior High School'])
            ->where('clearance_status', 'Pending')
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $p_hs_clearance_tickets;
    }
}