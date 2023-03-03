<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountRole;

class AccountRoleTableSeeder extends Seeder
{
    public function run()
    {
        AccountRole::create([
            'name' => 'Main Admin'
        ]);

        AccountRole::create([
            'name' => 'Department Admin'
        ]);

        AccountRole::create([
            'name' => 'Staff'
        ]);
    }
}
