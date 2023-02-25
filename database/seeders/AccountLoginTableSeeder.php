<?php

namespace Database\Seeders;

use App\Models\AccountLogin;
use Illuminate\Database\Seeder;

class AccountLoginTableSeeder extends Seeder
{
    public function run()
    {
        AccountLogin::create([
            'email' => 'main_admin@example.com',
            'password' => bcrypt('madmin123')
        ]);


        AccountLogin::create([
            'email' => 'department_admin@example.com',
            'password' => bcrypt('dadmin123')
        ]);

        AccountLogin::create([
            'email' => 'staff@example.com',
            'password' => bcrypt('staff123')
        ]);

        AccountLogin::create([
            'email' => 'librarian@example.com',
            'password' => bcrypt('librarian123')
        ]);
    }
}
