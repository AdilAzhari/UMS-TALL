<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam_result>
 */
class ExamResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exam_id' => \App\Models\Exam::inRandomOrder()->first()->id(),
            'student_id' => \App\Models\Student::inRandomOrder()->first()->id(),
            'score' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['pass', 'fail']),
            'note' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
