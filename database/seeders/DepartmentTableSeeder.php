<?php

namespace Database\Seeders;

use App\Models\Department;
use Database\Factories\DepartmentFactory;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    public function run()
    {
        $department = DepartmentFactory::factory()->create();
    }
}
