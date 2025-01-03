<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuizQuestion>
 */
class QuizQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quiz_id' => Quiz::inRandomOrder()->first()->id,
            'question' => $this->faker->sentence(),
            'created_by' => Teacher::inRandomOrder()->first()->id,
            'updated_by' => Teacher::inRandomOrder()->first()->id,
        ];
    }
}