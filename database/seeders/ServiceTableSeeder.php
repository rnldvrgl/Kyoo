<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registrar = Department::where('name', 'Registrar')->first();
        $cashier = Department::where('name', 'Cashier')->first();
        $college_lib = Department::where('name', 'College Library')->first();
        $hs_lib = Department::where('name', 'High School Library')->first();
        $registrar_service = ['Request Document', 'Claim Requested Document', 'Add Subject', 'Change Subject', 'Drop Subject', 'Drop Course', 'Subject Crediting', 'Clearance', 'Certification', 'Authentication', 'Verification', 'Transcript of Records', 'Transfer Credentials', 'Completion of Grades', 'Inquiry', 'Others'];
        $cashier_service = ['Payment', 'Permit'];

        // Registrar
        foreach ($registrar_service as $service_name) {
            Service::create([
                'department_id' => $registrar->id,
                'name' => $service_name,
                'status' => 'active'
            ]);
        }

        // Cashier
        foreach ($cashier_service as $service_name) {
            Service::create([
                'department_id' => $cashier->id,
                'name' => $service_name,
                'status' => 'active'
            ]);
        }

        // College Library
        Service::create([
            'department_id' => $college_lib->id,
            'name' => 'Clearance',
            'status' => 'active'
        ]);

        // College Library
        Service::create([
            'department_id' => $hs_lib->id,
            'name' => 'Clearance',
            'status' => 'active'
        ]);
    }
}
