<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    public function run()
    {
        Department::create([
            'name' => 'Cashier',
            'description' => 'This is Cashier',
            'status' => 'Active',
        ]);

        Department::create([
            'name' => 'Registrar',
            'description' => 'This is Registrar',
            'status' => 'Active',
        ]);

        Department::create([
            'name' => 'Library',
            'description' => 'This is Library',
            'status' => 'Active',
        ]);
    }
}
