<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\QueueTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

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
        $servedTickets = $this->getServedTickets();
        $c_cancelled_tickets = $queueTicketController->countStaffCancelledTickets();
        $c_completed_tickets = $queueTicketController->countStaffCompletedTickets();
        $avg_serving_time = $queueTicketController->getAverageServiceTime();
        $avg_wait_time = $queueTicketController->getAverageWaitingTime();

        return view(
            'dashboard.staff.regular-dashboard',
            [
                'avg_wait_time' => $avg_wait_time,
                'avg_serving_time' => $avg_serving_time,
                'c_cancelled_tickets' => $c_cancelled_tickets,
                'c_completed_tickets' => $c_completed_tickets,
                'pendingTickets' => $pendingTickets,
                'user_data' => $user_data,
                'servingTicket' => $servingTicket,
                'holdingTickets' => $holdingTickets,
                'servedTickets' => $servedTickets,
            ]
        );
    }

    public function fetchFilteredRegularStaffData(Request $request)
    {
        // dd($request);

        $loginID = $request->loginID;

        // Process
        $staffData = $this->getStaffData($loginID);

        // dd($staffData);

        if(empty($staffData)){
            return response()->json(['code' => 400, 'msg' => "Unfortunately, you still don't have any record for today."]);
        }

        // Export the tickets to a xlsx file
        $fileName = "my-report.xlsx";
        (new FastExcel($staffData))->export(storage_path('app/public/' . $fileName));

        // Get the URL to the exported file
        $url = Storage::url($fileName);
        
        // Return response
        return response()->json(['code' => 200, 'msg' => 'Export Successful', 'url' => $url, 'fileName' => $fileName]);
    }
    
    /**
     * getStaffData
     *
     * @param  mixed $loginID
     * @return array
     */
    public function getStaffData($loginID)
    {
        $query = QueueTicket::query();

        $today = Carbon::now()->format('Y-m-d');

        $query->where('login_id', $loginID)->where('date', $today);

        $staffData = $query->get();

        $array = [];

        foreach($staffData as $data){
            $toExcel = array(
                "Ticket Number" => $data->ticket_number,
                "Name" => $data->student_name,
                "Department" => $data->student_department,
                "Course" => $data->student_course,
                "Status" => $data->status,
                "Date Created" => Carbon::parse($data->created_at)->format('Y-m-d H:i:s'),
                "Number of Services" => $data->services->count(),
            );

            array_push($array, $toExcel);
        }

        return $array;
    }

    public function getPendingTickets()
    {
        $accountId = Auth::user()->id;
        $account = Accounts::find($accountId);
        $departmentId = $account->department_id;

        $pendingTickets = QueueTicket::with('services')
            ->where(function ($query) use ($departmentId) {
                $query->where(function ($query) {
                    $query->whereNull('login_id')
                        ->orWhere('login_id', session('account_id'));
                });
                $query->where('department_id', $departmentId)
                    ->whereIn('status', ['Pending', 'Calling'])
                    ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
                    ->whereNull('completed_at');
            })
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
                    ->where('login_id', session('account_id'))
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
            ->where('login_id', session('account_id'))
            ->where('department_id', $departmentId)
            ->where('status', 'On Hold')
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->whereNull('completed_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return $HoldTickets;
    }

    public function getServedTickets()
    {
        $accountId = Auth::user()->id;
        $account = Accounts::find($accountId);
        $departmentId = $account->department_id;

        // Get the staff member's department id
        $servedTickets = QueueTicket::with('services')
            ->where('login_id', session('account_id'))
            ->where('department_id', $departmentId)
            ->whereIn('status', ['Complete', 'Cancelled'])
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->orderBy('created_at', 'asc')
            ->get();

        return $servedTickets;
    }
}
