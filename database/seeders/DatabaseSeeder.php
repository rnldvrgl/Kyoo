<?php


use Illuminate\Database\Seeder;
use Database\Seeders\AccountDetailsTableSeeder;
use Database\Seeders\AccountLoginTableSeeder;
use Database\Seeders\AccountRoleTableSeeder;
use Database\Seeders\DepartmentTableSeeder;
use Database\Seeders\AccountsTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AccountDetailsTableSeeder::class,
            AccountLoginTableSeeder::class,
            AccountRoleTableSeeder::class,
            DepartmentTableSeeder::class,
            AccountsTableSeeder::class,
        ]);
    }
}
