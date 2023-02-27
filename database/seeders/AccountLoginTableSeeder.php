<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountLogin;

class AccountLoginTableSeeder extends Seeder
{
    public function run()
    {
        AccountLogin::factory(4)->create();
    }
}
