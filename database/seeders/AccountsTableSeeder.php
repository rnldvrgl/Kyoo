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
    }
}
