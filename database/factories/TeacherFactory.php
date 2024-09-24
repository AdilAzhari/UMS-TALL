<?php

namespace Database\Factories;

use App\Models\department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teachers>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'qualification' => $this->faker->word(),
            'experience' => $this->faker->word(),
            'specialization' => $this->faker->word(),
            'designation' => $this->faker->word(),
            'hire_date' => $this->faker->dateTimeThisYear(),
            'phone_number' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'program_id' => \App\Models\program::inRandomOrder()->first()->id,
            'department_id' => department::inRandomOrder()->first()->id,
        ];
    }
}
