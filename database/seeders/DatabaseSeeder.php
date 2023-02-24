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

        $main_admin = AccountRole::create([
            'name' => 'Main Admin',
        ]);

        $registrar = AccountRole::create([
            'name' => 'Registrar',
        ]);

        $cashier = AccountRole::create([
            'name' => 'Cashier',
        ]);

        $librarian = AccountRole::create([
            'name' => 'Librarian',
        ]);

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

        Accounts::create([
            'details_id' => $account_details->id,
            'login_id' => $account_login->id,
            'role_id' => $main_admin->id,
            'dept_id' => $office->id,
        ]);

        $account_details = AccountDetails::create([
            'name' => 'Ronald Vergel Dela Cruz',
            'address' => 'Mabalacat City, Pampanga',
            'phone' => '09876543210',
            'about' => 'Hakdog',
        ]);

        $account_login = AccountLogin::create([
            'email' => 'ronald@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        Accounts::create([
            'details_id' => $account_details->id,
            'login_id' => $account_login->id,
            'role_id' => $main_admin->id,
            'dept_id' => $office->id,
        ]);
    }
}
