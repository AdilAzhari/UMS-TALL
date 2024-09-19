<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment_submission>
 */
class AssignmentSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_at' => $this->faker->dateTimeThisYear,
            'obtained_marks' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['submitted', 'graded']),
            'remarks' => $this->faker->sentence(),
            'submitted_at' => $this->faker->dateTimeThisYear(),
            'graded_at' => $this->faker->dateTimeThisYear(),
            'graded_by' => \App\Models\Teacher::inRandomOrder()->first()->id,
            'feedback' => $this->faker->sentence(),
            'assignment_id' => \App\Models\Assignment::inRandomOrder()->first()->id,
            'student_id' => \App\Models\Student::inRandomOrder()->first()->id,
        ];
    }
}
