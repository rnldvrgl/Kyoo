<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountLogin;
use App\Models\Accounts;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
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
