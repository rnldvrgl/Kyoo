<?php

namespace Database\Seeders;

use App\Models\PromotionalText;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionalTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PromotionalText::factory(1)->create();
    }
}
