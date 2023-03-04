<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Service;
use Illuminate\Http\Request;

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

        return view('kiosk.select-department', ['kiosk_data' => $this->getKioskData()]);
    }

    public function selectOtherDept()
    {

        return view('kiosk.other-department', ['kiosk_data' => $this->getKioskData()]);
    }

    public function selectTransaction($department_id)
    {
        // use $department_id to get the transactions offered by the department chosen
        return view('kiosk.select-transaction', [
            'kiosk_data' => $this->getKioskData(),
            'department_id' => $department_id,
        ]);
    }

    public function inputInformation()
    {
        // 
    }


    public function addToQueue(Request $request)
    {
        // add the client to the queue
    }
}
