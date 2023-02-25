<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountDetails;
use App\Models\AccountLogin;
use App\Models\AccountRole;
use App\Models\Accounts;
use App\Models\Department;
use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account1 = Accounts::create([
            'details_id' => 1,
            'login_id' => 1,
            'role_id' => 1,
            'dept_id' => 2,
        ]);

        $account2 = Accounts::create([
            'details_id' => 2,
            'login_id' => 2,
            'role_id' => 2,
            'dept_id' => 1,
        ]);

        $account3 = Accounts::create([
            'details_id' => 3,
            'login_id' => 3,
            'role_id' => 3,
            'dept_id' => 1,
        ]);

        $account4 = Accounts::create([
            'details_id' => 4,
            'login_id' => 4,
            'role_id' => 4,
            'dept_id' => 3,
        ]);
    }
}
