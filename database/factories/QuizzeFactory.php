<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quizze>
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
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
            'class_id' => \App\Models\Classe::inRandomOrder()->first()->id,
            'teacher_id' => \App\Models\Teacher::inRandomOrder()->first()->id,
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