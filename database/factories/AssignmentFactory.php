<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_id' => \App\Models\Classe::inRandomOrder()->first()->id,
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
            'teacher_id' => \App\Models\Teacher::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'deadline' => $this->faker->dateTimeThisYear(),
            'total_marks' => $this->faker->randomNumber(),
            'status' => $this->faker->randomElement(['pending', 'completed', 'overdue']),
            'file' => $this->faker->word(),
            'created_by' => \App\Models\Teacher::inRandomOrder()->first()->id,
            'updated_by' => \App\Models\Teacher::inRandomOrder()->first()->id,
        ];
    }
}
