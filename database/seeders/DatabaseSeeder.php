<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AccountDetailsTableSeeder::class);
        $this->call(AccountLoginTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(AccountRoleTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(ServiceTableSeeder::class);

        // For Queue Ticket Demo
        // $this->call(QueueTicketSeeder::class);

        // Frequent Questions
        $this->call(FaqsSeeder::class);

        // Promotional Text
        $this->call(PromotionalTextSeeder::class);
    }
}
