<?php


namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KioskController extends Controller
{
    public function __construct()
    {
        // 
    }

    public function getKioskData()
    {
        return [
            'departments' => Department::all(),
            'services' => Service::all(),
        ];
    }

    public function cancel()
    {
        Session::forget('department_id');
        Session::forget('selected_services');
        Session::forget('queue_number');

        return redirect()->route('kiosk')->with('message', 'Queue has been canceled.');
    }

    public function index()
    {
        return view('kiosk.index');
    }

    public function selectDepartment()
    {
        $departments = Department::all();
        return view('kiosk.select-department', compact('departments'));
    }

    public function selectOtherDept()
    {
        $departments = Department::all();
        return view('kiosk.other-department', compact('departments'));
    }

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

        $services = $department->services;

        return view('kiosk.select-transaction', compact('department', 'services', 'selected_services'));
    }

    public function addToQueue(Request $request)
    {
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

    // public function printQueueTicket()
    // {
    //     $department = Department::findOrFail(Session::get('department_id'));
    //     $services = Service::whereIn('id', Session::get('services'))->get();
    //     $queue_number = 2;

    //     // create queue ticket
    //     // ...

    //     // clear session data
}
