<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizzeQuestion>
 */
class QuizzeQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quiz_id' => \App\Models\Quizze::inRandomOrder()->first()->id,
            'question' => $this->faker->sentence(),
            'created_by' => \App\Models\User::inRandomOrder()->first()->id,
            'updated_by' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
