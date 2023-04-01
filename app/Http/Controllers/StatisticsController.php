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

    // Count On Break Staff
    public function countOnBreakStaff()
    {
        $onBreakStaff = Accounts::whereHas('account_login', function ($query) {
            $query->where('status', 'On Break');
        })->whereHas('account_role', function ($query) {
            $query->where('name', 'staff');
        })->count();

        return $onBreakStaff;
    }

    // Count Active 
    public function countActiveStaff()
    {
        $activeStaff = Accounts::whereHas('account_login', function ($query) {
            $query->where('status', 'Logged In');
        })->whereHas('account_role', function ($query) {
            $query->where('name', 'staff');
        })->count();

        return $activeStaff;
    }

    // Count Inactive Staff
    public function countInactiveStaff()
    {
        $inactiveStaff = Accounts::whereHas('account_login', function ($query) {
            $query->where('status', 'Logged Out');
        })->whereHas('account_role', function ($query) {
            $query->where('name', 'staff');
        })->count();

        return $inactiveStaff;
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

    public function getTopThreeStaffByTicketsServed()
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

        return $topThreeStaff;
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
