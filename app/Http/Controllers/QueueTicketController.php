<?php

namespace App\Http\Controllers;

use App\Events\LiveQueueEvent;
use App\Http\Controllers\Controller;
use App\Models\DailyCounter;
use App\Models\Department;
use App\Models\QueueTicket;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class QueueTicketController extends Controller
{
    // * FOR MAIN ADMIN DASHBOARD * //
    // Declare a property
    public $queue_ticket_data;

    // Fetch all queue tickets data
    public function getQueueTickets()
    {
        $dateToday = Carbon::now()->format('Y-m-d');

        $queueTickets = QueueTicket::where('date', $dateToday)->get();

        $this->queue_ticket_data = [
            'queueTickets' => $queueTickets,
        ];

        return $this->queue_ticket_data;
    }

    // Count Pending tickets
    public function countPendingTickets()
    {
        $pendingCount = 0;

        $tickets = $this->queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {

            if ($ticket->status == 'Pending') {
                $pendingCount++;
            }
        }
        return $pendingCount;
    }

    // Count Serving tickets
    public function countServingTickets()
    {
        $servingCount = 0;

        $tickets = $this->queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {

            if ($ticket->status == 'Serving') {
                $servingCount++;
            }
        }
        return $servingCount;
    }

    // Count Served tickets
    public function countServedTickets()
    {
        $servedCount = 0;

        $tickets = $this->queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {

            if ($ticket->status == 'Served') {
                $servedCount++;
            }
        }
        return $servedCount;
    }

    // Count Cancelled tickets
    public function countCancelledTickets()
    {
        $cancelledCount = 0;

        $tickets = $this->queue_ticket_data['queueTickets'];

        foreach ($tickets as $ticket) {

            if ($ticket->status == 'Cancelled') {
                $cancelledCount++;
            }
        }
        return $cancelledCount;
    }

    // Fetch year to display on the dropdown
    public function getYear()
    {
        $years = QueueTicket::distinct()
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

    // Fetch data based on the year selected from the dropdown
    public function getDataForYear($year)
    {
        $data = QueueTicket::select(DB::raw('MONTH(date) as month'), DB::raw('COUNT(*) as queue_count'))
            ->whereYear('date', $year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy(DB::raw('MONTH(date)'))
            ->get();

        return response()->json($data);
    }


    // * FOR STAFF SERVING TICKET * //
    public function show($id)
    {
        $ticket = QueueTicket::findOrFail($id);

        return response()->json($ticket);
    }

    public function updateStatus(Request $request, $status)
    {
        $ticketId = $request->ticketId;

        // Retrieve the ticket by ID
        $ticket = QueueTicket::find($ticketId);

        if ($ticket) {

            if ($request->notes) {
                $ticket->notes = $request->notes;
            }

            // Only update the clearance status if it's provided in the request
            if ($request->has('clearance_status')) {
                $clearanceStatus = $request->clearance_status;
                $ticket->clearance_status = $clearanceStatus;
            }

            // Check the actual clearance status of the ticket
            // $actualClearanceStatus = $ticket->clearance_status;

            // Only update the clearance status in the session if it's different from the actual clearance status
            // if ($clearanceStatus !== $actualClearanceStatus) {
            //     session(['clearance_status' => $actualClearanceStatus]);
            // }

            // Update the ticket status
            $ticket->status = $status;

            if ($status === 'Calling') {
                // Add timestamp to called_at column
                if (!$ticket->called_at && !$ticket->waiting_time) {
                    $ticket->called_at = now();
                    $ticket->waiting_time = $ticket->called_at->diffInSeconds($ticket->created_at);
                }
            } elseif ($status === 'Serving') {
                // Add timestamp to served_at column
                if (!$ticket->served_at) {
                    $ticket->served_at = now();
                }
            } elseif ($status === 'On Hold') {
                $department = Department::where('name', 'Cashier')->first();
                $service = Service::where('name', 'Payment')->first(); // If error, check if Payment service exists in the Service table
                $name = $request->student_name;
                $student_department = $request->student_department;
                $course = $request->student_course;
                $department_id = $department->id;
                $service_id = $service->id;

                // retrieve department code
                $department_code = '';
                if ($department) {
                    $department_code = $department->code;
                }

                // determine next ticket number for the department and date
                $today = Carbon::now()->format('Y-m-d');
                $daily_counter = DailyCounter::where('department_id', $department_id)
                    ->where('date', $today)
                    ->first();
                if (!$daily_counter) {
                    // if daily counter does not exist, create it
                    $daily_counter = new DailyCounter();
                    $daily_counter->department_id = $department_id;
                    $daily_counter->date = $today;
                    $daily_counter->ticket_number = 1;
                    $daily_counter->save();
                }
                $next_ticket_number = $daily_counter->ticket_number;
                $daily_counter_ticket_number = $department_code . sprintf('%03d', $next_ticket_number);

                // update daily counter
                $daily_counter->ticket_number = $next_ticket_number + 1;
                $daily_counter->save();

                $ticket_number = $department_code . sprintf('%03d', $next_ticket_number);

                // create queue ticket
                $new_ticket = new QueueTicket();
                $new_ticket->student_name = $name;
                $new_ticket->student_department = $student_department;
                $new_ticket->student_course = $course;
                $new_ticket->department_id = $department_id;
                $new_ticket->ticket_number = $ticket_number;
                $new_ticket->status = 'Pending';
                $new_ticket->date = $today;
                $new_ticket->save();

                // save selected services to queue_ticket_service table
                $serviceModel = Service::where('id', $service_id)->first();
                $new_ticket->services()->attach($serviceModel->id);

                // print ticket
                // Get current date and time
                $date = date("M-d-y h:i:s A");
                try {
                    // Connect to the printer
                    $connector = new WindowsPrintConnector("XP-58", "USB002");
                    $printer = new Printer($connector);
                    // Set print mode to bold and double height
                    $printer->setJustification(Printer::JUSTIFY_CENTER);
                    $printer->setEmphasis(true);
                    $printer->setTextSize(2, 2);
                    // Print header
                    $printer->text("QUEUE TICKET\n");
                    // Reset print mode to normal
                    $printer->setEmphasis(false);
                    $printer->setTextSize(1, 1);
                    $printer->text("===============================\n");

                    // Print ticket number and department name
                    $printer->setEmphasis(true);
                    $printer->text("TICKET NUMBER:\n");
                    $printer->setEmphasis(true);
                    $printer->setTextSize(2, 2);
                    $printer->text("$ticket_number\n");
                    $printer->setEmphasis(false);
                    $printer->setTextSize(1, 1);
                    $printer->text("$department->name\n\n");

                    // Print date and time
                    $printer->setEmphasis(true);
                    $printer->text("DATE/TIME:\n");
                    $printer->setEmphasis(false);
                    $printer->text("$date\n\n");

                    // Print student information
                    $printer->setJustification(Printer::JUSTIFY_LEFT);
                    $printer->setEmphasis(true);
                    $printer->text("STUDENT INFORMATION\n");
                    $printer->setEmphasis(false);
                    $printer->text("NAME: " . $name . "\n");
                    $printer->text("DEPARTMENT: " . $student_department . "\n");
                    $printer->text("COURSE: " . $course . "\n\n");
                    // Print selected services
                    $printer->setEmphasis(true);
                    $printer->text("SELECTED SERVICES\n");
                    $printer->setEmphasis(false);

                    $serviceModel = Service::where('id', $service_id)->first();
                    $printer->text("- " . $serviceModel->name . "\n");

                    // Print footer
                    $printer->setJustification(Printer::JUSTIFY_CENTER);
                    $printer->setEmphasis(false);
                    $printer->text("===============================\n");
                    $printer->text("Kindly wait for your ticket\n");
                    $printer->text("number to be called!\n");
                    $printer->text("THANK YOU FOR USING KYOO!\n");
                    $printer->text("CREATED BY: OPTIMUS BYTES\n");
                    $printer->text("\n\n\n");
                    // Cut the paper
                    $printer->cut();
                    // Close the printer
                    $printer->close();
                    Log::info('Printing completed successfully.');
                } catch (\Exception $e) {
                    // Handle printer error
                    Log::error('Printing failed: ' . $e->getMessage());
                }
            } elseif ($status === 'Complete') {
                // Add timestamp to completed_at column
                if (!$ticket->completed_at && !$ticket->service_time && $ticket->served_at) {
                    $ticket->completed_at = now();
                    $ticket->service_time = $ticket->completed_at->diffInSeconds($ticket->served_at);
                }
            }

            $ticket->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ticket not found']);
        }
    }


    public function updateClearanceStatus(Request $request)
    {
        $ticketId = $request->ticketId;

        // Retrieve the ticket by ID
        $ticket = QueueTicket::find($ticketId);

        if ($ticket) {

            if ($request->clearance_status) {
                // Set the clearance status in the session
                session(['clearance_status' => $request->clearance_status]);
                $ticket->clearance_status = $request->clearance_status;
            } else {
                // Get the clearance status from the session
                $ticket->clearance_status = session('clearance_status');
            }

            $ticket->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ticket not found']);
        }
    }


    public function signClearance(Request $request, $status)
    {
        $ticketId = $request->ticketId;

        // Retrieve the ticket by ID
        $ticket = QueueTicket::find($ticketId);

        if ($ticket) {


            // Update the ticket status
            $ticket->clearance_status = $status;

            $ticket->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ticket not found']);
        }
    }
}
