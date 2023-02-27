<?php

namespace Database\Factories;

use App\Models\AccountDetails;
use App\Models\AccountLogin;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AccountsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
        //     'details_id' => AccountDetails::factory()->id(),
        //     'login_id' => AccountLogin::factory()->id(),
        //     'dept_id' => Department::factory()->id(),
        // ];
    }
}
