<?php

namespace Database\Seeders;

use App\Models\Faq;
use Database\Factories\FaqsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::factory(20)->create();
    }
}
