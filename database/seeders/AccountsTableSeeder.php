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
        $librarian = AccountRole::where('name', 'Librarian')->first();

        Accounts::create([
            'details_id' => $accountDetails[0]->id,
            'login_id' => $accountLogin[0]->id,
            'role_id' => $main_admin->id,
            'dept_id' => $department->random()->id,
        ]);

        Accounts::create([
            'details_id' => $accountDetails[1]->id,
            'login_id' => $accountLogin[1]->id,
            'role_id' => $department_admin->id,
            'dept_id' => $department->random()->id,
        ]);

        Accounts::create([
            'details_id' => $accountDetails[2]->id,
            'login_id' => $accountLogin[2]->id,
            'role_id' => $staff->id,
            'dept_id' => $department->random()->id,
        ]);

        Accounts::create([
            'details_id' => $accountDetails[3]->id,
            'login_id' => $accountLogin[3]->id,
            'role_id' => $librarian->id,
            'dept_id' => $department->random()->id,
        ]);
    }
}
