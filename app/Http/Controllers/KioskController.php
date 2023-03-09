<?php

namespace App\Http\Controllers;

use App\Models\DailyCounter;
use App\Models\Department;
use App\Models\QueueTicket;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class KioskController extends Controller
{
    public function __construct()
    {
        // Constructor
    }

    // Get data required for kiosk operation
    public function getKioskData()
    {
        return [
            'departments' => Department::all(),
            'services' => Service::all(),
        ];
    }

    // Cancel queue
    public function cancel()
    {
        // Remove session data related to the queue
        Session::forget('department_id');
        Session::forget('selected_services');
        Session::forget('queue_number');

        // Redirect to kiosk with a message
        return redirect()->route('kiosk')->with('message', 'Queue has been canceled.');
    }

    // Index page
    public function index()
    {
        return view('kiosk.index');
    }

    // Select department page
    public function selectDepartment()
    {
        // Get all departments
        $departments = Department::all();
        // Return view with departments data
        return view('kiosk.select-department', compact('departments'));
    }

    // Other department selection page
    public function selectOtherDept()
    {
        // Get all departments
        $departments = Department::all();
        // Return view with departments data
        return view('kiosk.other-department', compact('departments'));
    }

    // Select transaction page
    public function selectTransaction(Request $request)
    {
        // Check if department ID is already in the session
        if (Session::has('department_id')) {
            // Retrieve the selected services from the session
            $selected_services = Session::get('selected_services', []);
            $department_id = Session::get('department_id');
            $department = Department::findOrFail($department_id);
        } else {
            // Get department ID from request
            $department_id = $request->input('department_id');
            $department = Department::findOrFail($department_id);
            $selected_services = [];
        }

        // Get services of the selected department
        $services = $department->services;

        // Check if the selected services are already in the session
        foreach ($services as $service) {
            $service['is_selected'] = false;
            foreach ($selected_services as $selected_service) {
                if ($service->id === $selected_service['service_id']) {
                    $service['is_selected'] = true;
                    break;
                }
            }
        }

        // Return view with department, services and selected services data
        return view('kiosk.select-transaction', compact('department', 'services', 'selected_services'));
    }

    // Add selected service to queue
    public function addToQueue(Request $request)
    {
        try {
            // Get the selected service ID from request
            $service_id = $request->input('service_id');
            $service = Service::findOrFail($request->input('service_id'));
            // Get department ID from request
            $department_id = $request->input('department_id');
            $department = Department::findOrFail($department_id);

            // Save department to the session
            Session::put(['department_id' => $department_id, 'department_name' => $department->name]);

            // Retrieve the existing selected services from the session or create an empty array if not exists
            $selected_services = Session::get('selected_services', []);

            // Check if the selected service is already in the array
            $existing_service = collect($selected_services)->firstWhere('service_id', $service_id);
            if ($existing_service) {
                // If the selected service already exists in the array, don't add it again
                return redirect()->route('transaction-summary');
            } else {
                // Add the new selected service to the array
                $selected_services[] = ['service_id' => $service_id, 'service_name' => $service->name];

                // Save the updated selected services array to the session
                Session::put(['selected_services' => $selected_services]);

                return redirect()->route('transaction-summary');
            }
        } catch (\Exception $e) {
            // Handle the error
            return redirect()->route('error')->with('message', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function summary(Request $request)
    {
        // Retrieve the selected services from the session
        $selected_services = Session::get('selected_services', []);
        $department_id = Session::get('department_id');
        $department_name = Session::get('department_name');

        // Pass the selected services to the view
        return view('kiosk.summary', [
            'selected_services' => $selected_services,
            'department_id' => $department_id,
            'department_name' => $department_name,
        ]);
    }

    public function inputInformation()
    {
        return view('kiosk.input-information');
    }

    public function printQueueTicket(Request $request)
    {
        $name = $request->get('fullname');
        $student_department = $request->get('department');
        $course = $request->get('course');
        $department_id = Session::get('department_id');
        $selected_services = Session::get('selected_services', []);

        // retrieve department code
        $department_code = '';
        $department = Department::where('id', $department_id)->first();
        if ($department) {
            $department_code = $department->code;
        } else {
            // handle unknown department
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
        $ticket = new QueueTicket();
        $ticket->student_name = $name;
        $ticket->student_department = $student_department;
        $ticket->student_course = $course;
        $ticket->department_id = $department_id;
        $ticket->ticket_number = $ticket_number;
        $ticket->status = 'Pending';
        $ticket->date = $today;
        $ticket->save();

        // save selected services to queue_ticket_service table
        foreach ($selected_services as $service) {
            $serviceModel = Service::where('id', $service)->firstOrFail();
            $ticket->services()->attach($serviceModel->id);
        }


        // print ticket
        try {
            // Connect to the printer
            $connector = new WindowsPrintConnector("XP-58", "USB003");
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
            foreach ($selected_services as $service) {
                $serviceModel = Service::where('id', $service)->firstOrFail();
                $printer->text("- " . $serviceModel->name . "\n");
            }
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


        // clear session data
        Session::forget('department_name');
        Session::forget('department_id');
        Session::forget('selected_services');

        // return the created ticket number and message to the client
        return view('kiosk.index', ['message' => 'Queue Number ' . $daily_counter_ticket_number . ' Queued Successfully!']);
    }
}
