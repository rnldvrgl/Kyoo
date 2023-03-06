<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\QueueTicket;
use App\Models\QueueTicketService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            // Get department ID from request and store in session
            $department_id = $request->input('department_id');
            $department = Department::findOrFail($department_id);
            Session::put(['department_id' => $department_id, 'department_name' => $department->name]);
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

        // determine the next ticket number for the department
        $next_ticket_number = QueueTicket::where('department_id', $department_id)->count() + 1;
        $ticket_number = sprintf('%03d', $next_ticket_number); // format ticket number as 3-digit string

        // create queue ticket
        $ticket = new QueueTicket();
        $ticket->student_name = $name;
        $ticket->student_department = $student_department;
        $ticket->student_course = $course;
        $ticket->department_id = $department_id;
        $ticket->ticket_number = $department_code . $ticket_number;
        $ticket->status = 'Pending';
        $ticket->save();


        // save selected services to queue_ticket_service table
        foreach ($selected_services as $service) {
            $serviceModel = Service::where('id', $service)->firstOrFail();
            $ticket->services()->attach($serviceModel->id);
        }


        // clear session data
        Session::forget('department_name');
        Session::forget('department_id');
        Session::forget('selected_services');

        // return the created ticket to the client
        // return view('ticket', ['ticket' => $ticket]);
        dd($ticket);
    }
}
