<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountDetails;

class AccountDetailsTableSeeder extends Seeder
{
    public function run()
    {
        AccountDetails::factory(7)->create();
    }
}
