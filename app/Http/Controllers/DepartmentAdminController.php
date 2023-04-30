<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Accounts;
use App\Models\Department;
use App\Models\QueueTicket;
use App\Models\AccountLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\SheetCollection;
use App\Http\Controllers\MainAdminExportController;

class DepartmentAdminController extends Controller
{
    // * FOR DEPARTMENT ADMIN DASHBOARD * //
    // Declare a property
    public $department_queue_ticket_data;

    /**
     * 
     */

    public function fetchFilteredDepartmentAdminData(Request $request, MainAdminExportController $mainadmin)
    {
        // dd($request);

        // Ticket Status
        $ticketStatus = $request->ticketStatus;
        $ticketStartDate = $request->ticketStartDate;
        $ticketEndDate = $request->ticketEndDate;

        // Staff Status
        $staffStatus = $request->staffStatus;
        $department_id = $request->department;

        // Queue Counts
        $queueStartDate = $request->queueStartDate;
        $queueEndDate = $request->queueEndDate;

        // Occupied Departments
        $occupiedDepartment_id = $request->occupiedDepartment;

        // Hidden Role
        $role = $request->role;

        // Processes
        $filteredTicketData = $mainadmin->getTicketData($ticketStatus, $ticketStartDate, $ticketEndDate, $department_id);
        $filteredStaffData = $mainadmin->getStaffData($staffStatus, $department_id);
        $filteredQueueCountsData = $mainadmin->getQueueCountsData($queueStartDate, $queueEndDate, $department_id);
        $occupiedDepartmentsData = $mainadmin->getOccupiedDepartmentData($occupiedDepartment_id, $role);

        // Test each Processes here
        // dd($filteredTicketData);
        
        // Create new sheets for each filtered Data
        $results = new SheetCollection([
            "Tickets" => $filteredTicketData,
            "Staff Status" => $filteredStaffData,
            "Queue Counts" => $filteredQueueCountsData,
            "Occupied Departments" => $occupiedDepartmentsData,
        ]);

        if($results->isEmpty()){
            return response()->json(['code' => 400, 'msg' => 'No data found with the specified filters.']);
        }

        // Export the tickets to a CSV file
        $fileName = "department-admin-report.xlsx";
        (new FastExcel($results))->export(storage_path('app/public/' . $fileName));

        // Get the URL to the exported file
        $url = Storage::url($fileName);
        
        // Return response
        return response()->json(['code' => 200, 'msg' => 'Export Successful', 'url' => $url, 'fileName' => $fileName]);
    }

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

    // Count Completed tickets for the department
    public function countDepartmentCompletedTickets()
    {
        $completeCount = 0;
        $tickets = $this->department_queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {
            if (
                $ticket->status == 'Complete'
            ) {
                $completeCount++;
            }
        }

        return $completeCount;
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
