<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\QueueTicket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class QueueTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departmentIds = Department::pluck('id')->toArray();

        QueueTicket::factory(50)->create([
            'department_id' => function () use ($departmentIds) {
                return Arr::random($departmentIds);
            }
        ]);
    }
}
