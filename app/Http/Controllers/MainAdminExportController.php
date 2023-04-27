<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Accounts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QueueTicket;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

use Illuminate\Support\Facades\Storage;

class MainAdminExportController extends Controller
{    
    /**
     * fetchFilteredMainAdminData
     *
     * @param  mixed $request
     * @return void
     */
    public function fetchFilteredMainAdminData(Request $request)
    {
        // Ticket Status
        $ticketStatus = $request->ticketStatus;
        $ticketStartDate = $request->ticketStartDate;
        $ticketEndDate = $request->ticketEndDate;

        // Staff Status
        $staffStatus = $request->staffStatus;
        $department_id = $request->department;

        $filteredTicketData = $this->getTicketData($ticketStatus, $ticketStartDate, $ticketEndDate);
        $filteredStaffData = $this->getStaffData($staffStatus, $department_id);

        // TODO: Occupied Departments, Feedbacks (All), and Staff Leaderboard (All)

        // dd($filteredStaffData);

        // Create new sheets for each filtered Data
        $results = new SheetCollection([
            "Tickets" => $filteredTicketData,
            "Staff Status" => $filteredStaffData,
        ]);

        // dd($results);

        if($results->isEmpty()){
            return response()->json(['code' => 400, 'msg' => 'No data found with the specified filters.']);
        }

        // Export the tickets to a CSV file
        $fileName = "main-admin-report.xlsx";
        (new FastExcel($results))->export(storage_path('app/public/' . $fileName));

        // Get the URL to the exported file
        $url = Storage::url($fileName);
        
        // Return response
        return response()->json(['code' => 200, 'msg' => 'Export Successful', 'url' => $url, 'fileName' => $fileName]);
    }
    
    /**
     * getTicketData
     *
     * @param  mixed $ticketStatus
     * @param  mixed $ticketStartDate
     * @param  mixed $ticketEndDate
     * @return void
     */
    public function getTicketData($ticketStatus, $ticketStartDate, $ticketEndDate)
    {
        $query = QueueTicket::query();

        // if empty, fetch all tickets
        if(empty($ticketStatus) && empty($ticketStartDate) && empty($ticketEndDate)){
            $query->get();
        }

        // if ticketStatus not empty
        if(!empty($ticketStatus)){
            $query->where('status', '=', $ticketStatus)->get();
        }

        // if only $ticketStartDate is not empty
        if (!empty($ticketStartDate) && empty($ticketEndDate)) {
            $query->where('date', '>=', $ticketStartDate);
        }

        // if only $ticketEndDate is not empty
        if (empty($ticketStartDate) && !empty($ticketEndDate)) {
            $query->where('date', '<=', $ticketEndDate);
        }

        // if date not empty
        if(!empty($ticketStartDate) && !empty($ticketEndDate)){
            $query->whereBetween('date', [$ticketStartDate, $ticketEndDate]);
        }

        $tickets = $query->get();

        // dd($tickets);

        $array = [];

        foreach($tickets as $ticket){
            $toExcel = array(
                "Ticket Number" => $ticket->ticket_number,
                "Name" => $ticket->student_name,
                "Department" => $ticket->student_department,
                "Course" => $ticket->student_course,
                "Status" => $ticket->status,
                "Date Created" => Carbon::parse($ticket->created_at)->format('Y-m-d H:i:s'),
                "Number of Services" => $ticket->services->count(),
            );

            array_push($array, $toExcel);
        }

        return $array;
    }
        
    /**
     * getStaffData
     *
     * @param  mixed $status
     * @param  mixed $department_id
     * @return void
     */
    public function getStaffData($staffStatus, $department_id)
    {
        $query = Accounts::query();

        // if both empty
        if (empty($staffStatus) && empty($department_id)) {
            // return response()->json(['code' => 400, 'msg' => 'Please provide at least one filter.']);
            $query->whereHas('account_role', function($query){
                $query->where('name','!=', 'Main Admin')->where('id','!=', 1);
            });
        }

        // if empty staffStatus
        if (!empty($staffStatus)) {
            $query->whereHas('account_login', function($query) use ($staffStatus){
                $query->where('status', '=', $staffStatus);
            });
        }

        // if empty department_id
        if (!empty($department_id)) {
            $query->where('department_id', '=', $department_id);
        }

        // Fetch the result
        $accounts = $query->get();

        if ($accounts->isEmpty()) {
            return response()->json(['code' => 400, 'msg' => 'No accounts found with the specified filters.']);
        }

        $array = [];

        foreach($accounts as $account){
            $toExcel = array(
                "Name" => $account->account_details->name,
                "Department" => $account->department->name,
                "Status" => $account->account_login->status,
            );

            array_push($array, $toExcel);
        }

        return $array;
    }
}
