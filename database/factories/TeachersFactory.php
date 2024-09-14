<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teachers>
 */
class TeachersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id(),
            'department_id' => \App\Models\Department::inRandomOrder()->first()->id(),
            'created_at' => $this->faker->dateTimeThisYear(),
            'qualification' => $this->faker->word(),
            'experience' => $this->faker->word(),
            'specialization' => $this->faker->word(),
            'designation' => $this->faker->word(),
            'hire_date' => $this->faker->dateTimeThisYear(),
        ];
    }
}
