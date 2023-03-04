<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AccountDetailsTableSeeder::class);
        $this->call(AccountLoginTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(AccountRoleTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
    }
}
