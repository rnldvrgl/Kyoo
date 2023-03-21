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
        $c_signed_clearances = $this->getCollegeSignedClearance();
        $hs_signed_clearances = $this->getHSSignedClearance();
        return view(
            'dashboard.staff.librarian-dashboard',
            [
                'c_signed_clearances' => $c_signed_clearances,
                'hs_signed_clearances' => $hs_signed_clearances,
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
            ->whereIn('student_department', ['College', 'Graduate School'])
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
            ->whereIn('student_department', ['Senior High School', 'Junior High School'])
            ->where('clearance_status', 'Pending')
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $p_hs_clearance_tickets;
    }

    public function getCollegeSignedClearance()
    {
        // Get the staff member's department id
        $c_signed_clearance = QueueTicket::with('services')
            ->whereIn('student_department', ['College', 'Graduate School'])
            ->whereIn('clearance_status', ['Cleared', 'Not Cleared'])
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $c_signed_clearance;
    }

    public function getHSSignedClearance()
    {
        // Get the staff member's department id
        $hs_signed_clearance = QueueTicket::with('services')
            ->whereIn('student_department', ['Junior High School', 'Senior High School'])
            ->whereIn('clearance_status', ['Cleared', 'Not Cleared'])
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $hs_signed_clearance;
    }
}
