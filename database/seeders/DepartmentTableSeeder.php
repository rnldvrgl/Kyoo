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
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus corrupti earum quas. Similique ducimus mollitia consectetur dicta eum vitae aspernatur facere aperiam! Totam, laborum distinctio.',
            'status' => 'active'
        ]);

        Department::create([
            'name' => 'Cashier',
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus corrupti earum quas. Similique ducimus mollitia consectetur dicta eum vitae aspernatur facere aperiam! Totam, laborum distinctio.',
            'status' => 'active'
        ]);

        Department::create([
            'name' => 'College Library',
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus corrupti earum quas. Similique ducimus mollitia consectetur dicta eum vitae aspernatur facere aperiam! Totam, laborum distinctio.',
            'status' => 'active'
        ]);

        Department::create([
            'name' => 'High School Library',
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Possimus corrupti earum quas. Similique ducimus mollitia consectetur dicta eum vitae aspernatur facere aperiam! Totam, laborum distinctio.',
            'status' => 'active'
        ]);
    }
}
