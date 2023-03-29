<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountLogin;
use App\Models\Accounts;
use App\Models\Department;
use App\Models\QueueTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    // * Main Admin
    // Count Total Staff
    public function countTotalStaff()
    {
        $totalStaff =
            Accounts::whereHas('account_role', function ($query) {
                $query->where('name', 'staff');
            })->count();

        return $totalStaff;
    }

    // Count Active Staff
    public function countActiveStaff()
    {
        $activeStaff = Accounts::whereHas('account_login', function ($query) {
            $query->where('status', 'Logged In');
        })->whereHas('account_role', function ($query) {
            $query->where('name', 'staff');
        })->count();

        return $activeStaff;
    }

    public function countOccupiedDepartment()
    {
        $occupiedDepartment = Department::whereHas('accounts', function ($query) {
            $query->whereHas('account_login', function ($query) {
                $query->where('status', '=', 'Logged In');
            });
        })->count();

        return $occupiedDepartment;
    }

    public function countCompletedTicketsByStaff()
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
            $completedCounts[] = ['name' => $staff->account_details->name, 'department' => $staff->department->name, 'served_count' => $servedCount];
        }

        // sort the staffs by most served ticketsz
        usort($completedCounts, function ($a, $b) {
            return $b['served_count'] - $a['served_count'];
        });

        return $completedCounts;
    }


    // * DEPARTMENT ADMIN
    // Count Total Staff
    public function countDepartmentTotalStaff()
    {
        $accountLogin = AccountLogin::where('email', Auth::user()->email)->first();
        $account = Accounts::where('login_id', $accountLogin->id)->first();
        $department_id = $account->department_id;

        $totalStaff =
            Accounts::whereHas('account_role', function ($query) {
                $query->where('name', 'staff');
            })->where('department_id', $department_id)->count();

        return $totalStaff;
    }

    // Count Active Staff
    public function countDepartmentActiveStaff()
    {
        $accountLogin = AccountLogin::where('email', Auth::user()->email)->first();
        $account = Accounts::where('login_id', $accountLogin->id)->first();
        $department_id = $account->department_id;

        $activeStaff = Accounts::whereHas('account_login', function ($query) {
            $query->where('status', 'Logged In');
        })->whereHas('account_role', function ($query) {
            $query->where('name', 'staff');
        })->where('department_id', $department_id)->count();

        return $activeStaff;
    }
}
