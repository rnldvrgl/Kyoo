<?php

namespace Database\Seeders;

use Database\Factories\AccountLoginFactory;
use Illuminate\Database\Seeder;

class AccountLoginTableSeeder extends Seeder
{
    public function run()
    {
        $accountLogin = AccountLoginFactory::factory()->create();
    }
}
