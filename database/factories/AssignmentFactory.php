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
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'deadline' => $this->faker->dateTimeThisYear(),
            'file' => $this->faker->word(),
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id(),
            'created_at' => $this->faker->dateTimeThisYear(),
            'class_id' => \App\Models\Classe::inRandomOrder()->first()->id(),
            'teacher_id' => \App\Models\Teacher::inRandomOrder()->first()->id(),
            'enrollment_id' => \App\Models\Enrollment::inRandomOrder()->first()->id(),
        ];
    }
}
