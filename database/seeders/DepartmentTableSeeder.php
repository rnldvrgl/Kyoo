<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentTableSeeder extends Seeder
{
    public function run()
    {
        Department::create([
            'name' => 'Registrar',
            'status' => 'active'
        ]);

        Department::create([
            'name' => 'Cashier',
            'status' => 'active'
        ]);

        Department::create([
            'name' => 'College Library',
            'status' => 'active'
        ]);

        Department::create([
            'name' => 'High School Library',
            'status' => 'active'
        ]);
    }
}
