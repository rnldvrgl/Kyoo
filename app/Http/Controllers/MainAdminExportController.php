<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Accounts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountLogin;
use App\Models\Department;
use App\Models\Feedback;
use App\Models\QueueTicket;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

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
        // dd($request);

        // Ticket Status
        $ticketStatus = $request->ticketStatus;
        // $ticketStartDate = $request->ticketStartDate;
        // $ticketEndDate = $request->ticketEndDate;

        // Staff Status
        $staffStatus = $request->staffStatus;
        $department_id = $request->department;

        // Queue Counts
        // $queueStartDate = $request->queueStartDate;
        // $queueEndDate = $request->queueEndDate;

        // Occupied Departments
        $occupiedDepartment_id = $request->occupiedDepartment;

        // Feedback
        $anonymity = $request->anonymity;
        // $feedbackStartDate = $request->feedbackStartDate;
        // $feedbackEndDate = $request->feedbackEndDate;
        
        // Date
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        // Processes
        $filteredTicketData = $this->getTicketData($ticketStatus, $startDate, $endDate);
        $filteredStaffData = $this->getStaffData($staffStatus, $department_id);
        $filteredQueueCountsData = $this->getQueueCountsData($startDate, $endDate);
        $staffLeaderboardData = $this->getStaffLeaderboardData();
        $occupiedDepartmentsData = $this->getOccupiedDepartmentData($occupiedDepartment_id);
        $filteredFeedbackData = $this->getFeedbackData($anonymity, $startDate, $endDate);
        
        // Test each process here
        // dd($filteredFeedbackData);

        // Create new sheets for each filtered Data
        $results = new SheetCollection([
            "Tickets" => $filteredTicketData,
            "Staff Status" => $filteredStaffData,
            "Queue Counts" => $filteredQueueCountsData,
            "Staff Leaderboards" => $staffLeaderboardData,
            "Occupied Departments" => $occupiedDepartmentsData,
            "Feedbacks" => $filteredFeedbackData,
        ]);

        // dd($results);

        if($results->isEmpty()){
            return response()->json(['code' => 400, 'msg' => 'No data found with the specified filters.']);
        }

        // Export the tickets to a xlsx file
        $fileName = "main-admin-report.xlsx";
        (new FastExcel($results))->export(storage_path('app/public/' . $fileName));

        // Get the URL to the exported file
        $url = Storage::url($fileName);
        
        // Return response
        return response()->json(['code' => 200, 'msg' => 'Export Successful', 'url' => $url, 'fileName' => $fileName]);
        // return redirect('/main-admin/dashboard');
    }
    
    /**
     * getFeedbackData
     *
     * @param  mixed $anonymity
     * @param  mixed $feedbackStartDate
     * @param  mixed $feedbackEndDate
     * @return void
     */
    public function getFeedbackData($anonymity, $feedbackStartDate, $feedbackEndDate)
    {
        $query = Feedback::query();

        if(!empty($anonymity) && $anonymity == "all"){
            $query->get();
        }

        if(!empty($anonymity) && $anonymity == "anonymous"){
            $query->where('name', null);
        }
        
        if(!empty($anonymity) && $anonymity == "named"){
            $query->where('name', '!=', null);
        }

        // if only $feedbackStartDate is not empty
        if (!empty($feedbackStartDate) && empty($feedbackEndDate)) {
            $query->whereDate('created_at', '>=', $feedbackStartDate);
        }

        // if only $feedbackEndDate is not empty
        if (empty($feedbackStartDate) && !empty($feedbackEndDate)) {
            $query->whereDate('created_at', '<=', $feedbackEndDate);
        }

        // if both date range not empty
        if(!empty($feedbackStartDate) && !empty($feedbackEndDate)){
            $query->whereDate('created_at', [$feedbackStartDate, $feedbackEndDate]);
        }
        
        $feedbacks = $query->get();

        $array = [];

        // If $feedbacks returns empty array
        if($feedbacks->isEmpty()){
            $toExcel = array(
                "Message" => "No data found within the specified date range.",
            );

            array_push($array, $toExcel);
        } 
        // if not empty
        else {
            foreach($feedbacks as $feedback){
                $toExcel = array(
                    "Name" => $feedback->name == null ? "Anonymous" : $feedback->name,
                    "Feedback" => $feedback->feedback,
                    "Date Sent" => Carbon::parse($feedback->created_at)->format('Y-m-d H:i:s'),
                );
    
                array_push($array, $toExcel);
            }
        }

        return $array;
    }
    
    /**
     * getOccupiedDepartmentData
     *
     * @param  mixed $occupiedDepartment_id
     * @return void
     */
    public function getOccupiedDepartmentData($occupiedDepartment_id, $role = "")
    {
        // if empty
        if(empty($occupiedDepartment_id))
        {
            $occupiedDepartments = Accounts::whereHas('account_login', function($query){
                $query->where('status', 'Logged In');
            })->whereNotNull('department_id')->get();
        }

        // If not empty
        else {
            $occupiedDepartments = Accounts::whereHas('account_login', function($query){
                $query->where('status', 'Logged In');
            })
            ->whereHas('department', function($query) use ($occupiedDepartment_id) {
                $query->where('id', $occupiedDepartment_id);
            })
            ->get();
        }

        if($role == "Department Admin"){
            $total = Accounts::whereHas('account_login', function($query){
                $query->where('status', 'Logged In');
            })->where('department_id', $occupiedDepartment_id)
                ->whereNotNull('department_id')
                ->count();
        } else {
            $total = Accounts::whereHas('account_login', function($query){
                $query->where('status', 'Logged In');
            })->whereNotNull('department_id')
                ->count();
        }

        $array = [];

        $departments = [];
        
        foreach ($occupiedDepartments as $department) {
            $departmentName = $department->department->name;

            // Avoid duplication of department
            if (!in_array($departmentName, $departments)) {
                $departments[] = $departmentName;
                $toExcel = array(
                    "Department" => $departmentName,
                    "Occupants" => $occupiedDepartments->where('department_id', $department->department_id)->count(),
                );
                array_push($array, $toExcel);
            }
        }        

        $collectedArray = collect($array);

        $collectedArray->prepend([
            'Total Occupied Departments' => $total,
        ]);

        return $collectedArray;
    }
    
    /**
     * getStaffLeaderboardData
     *
     * @return void
     */
    public function getStaffLeaderboardData()
    {
        $staffs = Accounts::with('account_details')->with('department')->where('role_id', 3)->get();
        $completedCounts = [];

        foreach ($staffs as $staff) {
            $servedCount = QueueTicket::where(
                'status',
                'Complete'
            )
                ->where('login_id', $staff->id)
                ->count();
            $completedCounts[] = ['name' => $staff->account_details->name, 'department' => $staff->department->name, 'served_count' => $servedCount, 'profile_image' => $staff->account_details->profile_image];
        }

        // sort the staffs by most served tickets and exclude staff with the department of High School Library and College Library
        $completedCounts = array_filter($completedCounts, function ($a) {
            return !in_array($a['department'], ['High School Library', 'College Library']);
        });
        usort($completedCounts, function ($a, $b) {
            return $b['served_count'] - $a['served_count'];
        });

        // return the top 3 staff with the most served tickets
        $topThreeStaff = array_slice($completedCounts, 0, 3);

        $array = [];

        foreach ($topThreeStaff as $staff) {
            $toExcel = array(
                "Name" => $staff['name'],
                "Department" => $staff['department'],
                "Total Served" => $staff['served_count']
            );

            array_push($array, $toExcel);
        }

        return $array;
    }
    
    /**
     * getQueueCountsData
     *
     * @param  mixed $queueStartDate
     * @param  mixed $queueEndDate
     * @return void
     */
    public function getQueueCountsData($queueStartDate, $queueEndDate, $department_id = "")
    {
        $query = QueueTicket::query();

        // if empty, count all queue
        if(empty($queueStartDate) && empty($queueEndDate)){
            $query->get();

            $key = "Total Queues";
        }

        // department_id exists
        if(!empty($department_id)){
            $query->where('department_id', $department_id);
        }

        // if only $queueStartDate is not empty
        if (!empty($queueStartDate) && empty($queueEndDate)) {
            $query->where('date', '>=', $queueStartDate);

            $key = "Total Queues starting from $queueStartDate";
        }

        // if only $queueEndDate is not empty
        if (empty($queueStartDate) && !empty($queueEndDate)) {
            $query->where('date', '<=', $queueEndDate);

            $key = "Total Queues until $queueEndDate";
        }

        // if date not empty
        if(!empty($queueStartDate) && !empty($queueEndDate)){
            $query->whereBetween('date', [$queueStartDate, $queueEndDate]);

            $key = "Total Queues starting from $queueStartDate until $queueEndDate";
        }

        $queues = $query->get()->count();

        $array = [];

        // If $queues returns empty array
        if(empty($queues)){
            $toExcel = array(
                "Message" => "No data found within the specified date range.",
            );

            array_push($array, $toExcel);
        } 
        // if not empty
        else {
            $toExcel = array(
                $key => $queues,
            );
    
            array_push($array, $toExcel);
        }

        return $array;
    }
    
    /**
     * getTicketData
     *
     * @param  mixed $ticketStatus
     * @param  mixed $ticketStartDate
     * @param  mixed $ticketEndDate
     * @return void
     */
    public function getTicketData($ticketStatus, $ticketStartDate, $ticketEndDate, $department_id = "")
    {
        $query = QueueTicket::query();

        // if empty, fetch all tickets
        if(empty($ticketStatus) && empty($ticketStartDate) && empty($ticketEndDate)){
            $query->get();
        }

        // Added this since I used this method on DepartmentAdminController
        if(!empty($department_id)){
            $query->where('department_id', $department_id);
        }

        // if ticketStatus not empty
        if(!empty($ticketStatus)){
            $query->where('status', $ticketStatus)->get();
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

        $array = [];

        // If $tickets returns empty array
        if($tickets->isEmpty()){
            $toExcel = array(
                "Message" => "No data found within the specified date range.",
            );

            array_push($array, $toExcel);
        } 
        // if not empty
        else {
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
                $query->where('status', $staffStatus);
            });
        }

        // if empty department_id
        if (!empty($department_id)) {
            $query->where('department_id', $department_id);
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
