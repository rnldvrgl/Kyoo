<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountDetails;

class AccountDetailsTableSeeder extends Seeder
{
    public function run()
    {
        $accountDetails1 = AccountDetails::create([
            'name' => 'Main Admin',
            'address' => 'Bahay',
            'phone' => '09123456789',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);

        $accountDetails2 = AccountDetails::create([
            'name' => 'Department Admin',
            'address' => 'Labas',
            'phone' => '09987654321',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);

        $accountDetails3 = AccountDetails::create([
            'name' => 'Staff',
            'address' => 'Loob',
            'phone' => '09123459876',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);

        $accountDetails4 = AccountDetails::create([
            'name' => 'Librarian',
            'address' => 'Kasmor',
            'phone' => '09987612345',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);
    }
}
