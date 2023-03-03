<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Accounts;
use App\Models\AccountDetails;
use App\Models\AccountLogin;
use App\Models\AccountRole;
use App\Models\Department;

class AccountsTableSeeder extends Seeder
{
    public function run()
    {
        $accountDetails = AccountDetails::all();
        $accountLogin = AccountLogin::all();
        $department = Department::all();
        $main_admin = AccountRole::where('name', 'Main Admin')->first();
        $department_admin = AccountRole::where('name', 'Department Admin')->first();
        $staff = AccountRole::where('name', 'Staff')->first();
        $registrar = Department::where('name', 'Registrar')->first();
        $cashier = Department::where('name', 'Cashier')->first();
        $college_lib = Department::where('name', 'College Library')->first();
        $hs_lib = Department::where('name', 'High School Library')->first();

        // Main Admin
        Accounts::create([
            'details_id' => $accountDetails[0]->id,
            'login_id' => $accountLogin[0]->id,
            'role_id' => $main_admin->id,
            'dept_id' => $department->random()->id,
        ]);

        // Registrar
        // Dept.Admin
        Accounts::create([
            'details_id' => $accountDetails[1]->id,
            'login_id' => $accountLogin[1]->id,
            'role_id' => $department_admin->id,
            'dept_id' => $registrar->id,
        ]);

        // Staff
        Accounts::create([
            'details_id' => $accountDetails[2]->id,
            'login_id' => $accountLogin[2]->id,
            'role_id' => $staff->id,
            'dept_id' => $registrar->id,
        ]);

        // Cashier
        // Dept.Admin
        Accounts::create([
            'details_id' => $accountDetails[3]->id,
            'login_id' => $accountLogin[3]->id,
            'role_id' => $department_admin->id,
            'dept_id' => $cashier->id,
        ]);

        // Staff
        Accounts::create([
            'details_id' => $accountDetails[4]->id,
            'login_id' => $accountLogin[4]->id,
            'role_id' => $staff->id,
            'dept_id' => $cashier->id,
        ]);

        // College Library
        Accounts::create([
            'details_id' => $accountDetails[5]->id,
            'login_id' => $accountLogin[5]->id,
            'role_id' => $staff->id,
            'dept_id' => $college_lib->id,
        ]);

        // High School Library
        Accounts::create([
            'details_id' => $accountDetails[6]->id,
            'login_id' => $accountLogin[6]->id,
            'role_id' => $staff->id,
            'dept_id' => $hs_lib->id,
        ]);
    }
}
