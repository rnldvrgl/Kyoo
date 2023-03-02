<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AccountDetails;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountDetails>
 */
class AccountDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'about' => $this->faker->paragraph(),
            'profile_picture' => $this->faker->image('public/assets/images/profiles', 200, 200, null, false),
        ];
    }
}
