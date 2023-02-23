<?php

namespace Database\Seeders;

use App\Models\AccountDetails;
use App\Models\AccountLogin;
use App\Models\AccountRole;
use App\Models\Accounts;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $account_details = AccountDetails::create([
            'name' => 'Mark Lewence L. Endrano',
            'address' => 'Mabalacat City, Pampanga',
            'phone' => '09123456789',
            'about' => 'A full-stack web developer with a passion and drive to
            engage in the IT industry. Knowledgeable in developing
            websites, and eager to learn new abilities and improve
            my skills to contribute to a team and an organization.
            '
        ]);

        $account_login = AccountLogin::create([
            'email' => 'lewence@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        $account_role = AccountRole::create([
            'name' => 'Main Admin',
        ]);

        $office = Department::create([
            'name' => 'Office',
            'description' => 'The Office is where the Vice President is working',
            'status' => 'Active',
        ]);

        $registrar = Department::create([
            'name' => 'Registrar',
            'description' => 'The Registrar is where the Registrar Admin and Staffs are working',
            'status' => 'Active',
        ]);

        $cashier = Department::create([
            'name' => 'Cashier',
            'description' => 'The Cashier is where the Cashier Admin and Staffs are working',
            'status' => 'Active',
        ]);

        $library = Department::create([
            'name' => 'Library',
            'description' => 'The Library is where the Librarian is working',
            'status' => 'Active',
        ]);

        Accounts::create([
            'details_id' => '1',
            'login_id' => '1',
            'role_id' => '1',
            'dept_id' => '1',
        ]);
    }
}
