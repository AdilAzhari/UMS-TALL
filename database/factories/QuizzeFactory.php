<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Quiz>
 */
class QuizzeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::inRandomOrder()->first()->id,
            'class_id' => Classes::inRandomOrder()->first()->id,
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'code' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['graded', 'ungraded']),
            'title' => $this->faker->sentence(),
            'instructions' => $this->faker->sentence(),
            'duration' => $this->faker->randomElement(['5', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55', '60']),
            'status' => $this->faker->randomElement(['draft', 'published', 'closed']),
            'start_date' => $this->faker->dateTimeThisYear(),
            'end_date' => $this->faker->dateTimeThisYear(),
            'passing_score' => $this->faker->randomNumber(),
        ];
    }
}
