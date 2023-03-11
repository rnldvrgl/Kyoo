<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QueueTicket>
 */
class QueueTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // Department ID
            'ticket_number' => $this->faker->randomNumber(3),
            'student_name' => $this->faker->unique()->name(),
            'student_department' => $this->faker->randomElement(['Graduate School', 'College', 'Senior High School', 'Junior High School']),
            'student_course' => $this->faker->randomElement(['Master', 'Bachelor of Science in Information Technology', 'General Academic Strand', 'Junior High School']),
            'status' => $this->faker->randomElement(['Pending', 'Serving', 'Served', 'Cancelled', 'Hold']),
            'date' => $this->faker->date(),
        ];
    }
}
