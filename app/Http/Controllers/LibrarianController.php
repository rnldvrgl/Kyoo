<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\QueueTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class LibrarianController extends Controller
{
    public function index(HomeController $homeController)
    {

        $user_data = $homeController->getUserData();
        $p_c_clearance_tickets = $this->getCollegesPendingClearance();
        $p_hs_clearance_tickets = $this->getHSPendingClearances();
        $c_signed_clearances = $this->getCollegeSignedClearance();
        $hs_signed_clearances = $this->getHSSignedClearance();
        $count_signed_clearances = $this->countSignedClearance();
        $count_completed_clearances = $this->countCompletedClearance();
        $count_uncleared_clearances = $this->countUnclearedClearance();
        return view(
            'dashboard.staff.librarian-dashboard',
            [
                'count_completed_clearances' => $count_completed_clearances,
                'count_uncleared_clearances' => $count_uncleared_clearances,
                'count_signed_clearances' => $count_signed_clearances,
                'c_signed_clearances' => $c_signed_clearances,
                'hs_signed_clearances' => $hs_signed_clearances,
                'p_hs_clearance_tickets' => $p_hs_clearance_tickets,
                'p_c_clearance_tickets' => $p_c_clearance_tickets,
                'user_data' => $user_data,
            ]
        );
    }

    public function fetchFilteredLibrarianTicket(Request $request)
    {
        // Declare them variables
        $student_department = $request->department;
        $student_course = $request->course;
        $clearance_status = $request->clearance_status;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Query the Model
        $query = QueueTicket::query();

        // Check if they are empty
        if(empty($student_department) && empty($student_course) && empty($clearance_status)){
            return response()->json(['msg' => 'Please provide at least one filter.']);
            // return redirect('/librarian/dashboard')->with('library-msg', 'Please provide at least one filter.');
        }
    
        // Dropdown Filters
        if (!empty($student_department)) {
            $query->where('student_department', $student_department);
        }

        if (!empty($student_course)) {
            $query->where('student_course' ,$student_course);
        }

        if (!empty($clearance_status)) {
            $query->where('clearance_status', $clearance_status);
        }
    
        // Date Filters
        if (!empty($startDate)) {
            $query->whereDate('created_at', '>=', $startDate);
        }
    
        if (!empty($endDate)) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $tickets = $query->get(['id', 'student_name', 'student_department', 'student_course', 'clearance_status', 'created_at']);
            
        if ($tickets->isEmpty()) {
            return response()->json(['msg' => 'No tickets found with the specified filters.']);
            // return redirect('/librarian/dashboard')->with('library-msg', 'No tickets found with the specified filters.');
        }
    
        (new FastExcel($tickets))->download('librarian-ticket.csv');

        return response()->json(['msg' => 'Excel has been downloaded.']);
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
            ->orderBy('created_at', 'asc')
            ->get();

        return $hs_signed_clearance;
    }

    // * FOR LIBRARIAN STATISTICS
    // Count Cancelled Tickets per Staff
    public function countStaffCancelledTickets()
    {
        $cancelledCount = 0;
        $tickets = QueueTicket::all();

        if ($tickets) {
            foreach ($tickets as $ticket) {
                if ($ticket->status == 'Cancelled' && $ticket->login_id == session('account_id')) {
                    $cancelledCount++;
                }
            }
        }

        return $cancelledCount;
    }

    public function countSignedClearance()
    {
        $signedCollegeCount = 0;
        $signedHSCount = 0;
        $tickets = QueueTicket::all();

        if ($tickets) {
            foreach ($tickets as $ticket) {
                if ($ticket->clearance_status == 'Cleared' || $ticket->clearance_status == 'Not Cleared') {
                    if ($ticket->student_department == 'College' || $ticket->student_department == 'Graduate School') {
                        $signedCollegeCount++;
                    } elseif ($ticket->student_department == 'Junior High School' || $ticket->student_department == 'Senior High School') {
                        $signedHSCount++;
                    }
                }
            }
        }

        return ['signedCollegeCount' => $signedCollegeCount, 'signedHSCount' => $signedHSCount];
    }

    public function countCompletedClearance()
    {
        $clearedCollegeCount = 0;
        $clearedHSCount = 0;
        $tickets = QueueTicket::all();

        if ($tickets) {
            foreach ($tickets as $ticket) {
                if ($ticket->clearance_status == 'Cleared') {
                    if ($ticket->student_department == 'College' || $ticket->student_department == 'Graduate School') {
                        $clearedCollegeCount++;
                    } elseif ($ticket->student_department == 'Junior High School' || $ticket->student_department == 'Senior High School') {
                        $clearedHSCount++;
                    }
                }
            }
        }

        return ['clearedCollegeCount' => $clearedCollegeCount, 'clearedHSCount' => $clearedHSCount];
    }

    public function countUnclearedClearance()
    {
        $unclearedCollegeCount = 0;
        $unclearedHSCount = 0;
        $tickets = QueueTicket::all();

        if ($tickets) {
            foreach ($tickets as $ticket) {
                if ($ticket->clearance_status == 'Not Cleared') {
                    if ($ticket->student_department == 'College' || $ticket->student_department == 'Graduate School') {
                        $unclearedCollegeCount++;
                    } elseif ($ticket->student_department == 'Junior High School' || $ticket->student_department == 'Senior High School') {
                        $unclearedHSCount++;
                    }
                }
            }
        }

        return ['unclearedCollegeCount' => $unclearedCollegeCount, 'unclearedHSCount' => $unclearedHSCount];
    }

}
