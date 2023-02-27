<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentTableSeeder extends Seeder
{
    public function run()
    {
        Department::factory(4)->create();
    }
}
