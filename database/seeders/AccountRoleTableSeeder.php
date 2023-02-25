<?php

namespace Database\Seeders;

use App\Models\AccountRole;
use Illuminate\Database\Seeder;

class AccountRoleTableSeeder extends Seeder
{
    public function run()
    {
        AccountRole::create([
            'name' => 'Main Admin',
        ]);

        AccountRole::create([
            'name' => 'Department Admin',
        ]);

        AccountRole::create([
            'name' => 'Staff',
        ]);

        AccountRole::create([
            'name' => 'Librarian',
        ]);
    }
}
