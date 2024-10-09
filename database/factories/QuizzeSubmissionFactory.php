<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Quiz;
use App\Models\Quizze;
use App\Models\Student;
use App\Models\Teacher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizzeSubmission>
 */
class QuizzeSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quiz_id' => Quizze::inRandomOrder()->first()->id,
            'student_id' => Student::inRandomOrder()->first()->id,
            'score' => $this->faker->numberBetween(0, 100), // Assuming score is out of 100
            'status' => $this->faker->randomElement(['pending', 'submitted', 'graded']),
            'submitted_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'graded_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'graded_by' => Teacher::inRandomOrder()->first()->id,
            'feedback' => $this->faker->optional()->sentence(),
            'remarks' => $this->faker->optional()->paragraph(),
        ];
    }
}
