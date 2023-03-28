<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentServiceController extends Controller
{
    public function show(HomeController $homeController)
    {

        $accountId = Auth::user()->id;
        $account = Accounts::find($accountId);
        $departmentId = $account->department_id;

        $department = Department::findOrFail($departmentId);
        // Get services of the selected department
        $services = $department->services;

        return view('dashboard.department_admin.manage.services.view', [
            'all_data' => $homeController->getDepartmentAllData(),
            'user_data' => $homeController->getUserData(),
            'department' => $department,
            'services' => $services
        ]);
    }
}
