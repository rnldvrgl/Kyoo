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
        $department_id = $request->input('department_id');
        $department = Department::findOrFail($department_id);
        $services = $department->services;

        return view('kiosk.select-transaction', compact('department', 'services'));
    }

    public function inputInformation()
    {
        return view('kiosk.input-information');
    }

    public function addToQueue(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'year_level' => 'required',
            'course' => 'required',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id'
        ]);

        $department_id = $request->input('department_id');
        $services = $request->input('services');
        $name = $request->input('name');
        $year_level = $request->input('year_level');
        $course = $request->input('course');

        // Save data to session
        Session::put('department_id', $department_id);
        Session::put('services', $services);
        Session::put('name', $name);
        Session::put('year_level', $year_level);
        Session::put('course', $course);

        return redirect()->route('kiosk.summary');
    }

    public function summary()
    {
        $department = Department::findOrFail(Session::get('department_id'));
        $services = Service::whereIn('id', Session::get('services'))->get();
        $name = Session::get('name');
        $year_level = Session::get('year_level');
        $course = Session::get('course');

        return view('kiosk.summary', compact('department', 'services', 'name', 'year_level', 'course'));
    }

    public function addServices()
    {
        return redirect()->route('kiosk.select-transaction', ['department_id' => Session::get('department_id')]);
    }

    public function printQueueTicket()
    {
        $department = Department::findOrFail(Session::get('department_id'));
        $services = Service::whereIn('id', Session::get('services'))->get();
        $name = Session::get('name');
        $year_level = Session::get('year_level');
        $course = Session::get('course');
        $queue_number = // generate queue number based on department and current queue status

            // create queue ticket
            // ...

            // clear session data
            Session::forget(['department_id', 'services', 'name', 'year_level', 'course']);

        return view('kiosk.queue-ticket', compact('queue_ticket'));
    }
}
