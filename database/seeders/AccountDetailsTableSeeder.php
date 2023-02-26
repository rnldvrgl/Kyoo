<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\AccountDetailsFactory;

class AccountDetailsTableSeeder extends Seeder
{
    public function run()
    {
        $accountDetails = AccountDetailsFactory::factory()->create();
    }
}
