<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Exam_result;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Exam_result>
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
            'exam_id' => Exam::inRandomOrder()->first()->id ?? Exam::factory()->create()->id,
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory()->create()->id,
            'score' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['passed', 'failed', 'absent']),
            'notes' => $this->faker->sentence(),
        ];
    }
}
