<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_date' => $this->faker->dateTimeThisYear(),
            'student_id' => \App\Models\Student::inRandomOrder()->first()->id(),
            'created_at' => $this->faker->dateTimeThisYear(),
            'class_id' => \App\Models\Classe::inRandomOrder()->first()->id(),
            'status' => $this->faker->randomElement(['enrolled', 'pending', 'completed']),
        ];
    }
}
