<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuizQuestionOption>
 */
class QuizQuestionOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'quiz_question_id' => QuizQuestion::inRandomOrder()->first()->id ?? QuizQuestion::factory()->create()->id,
            'option' => $this->faker->sentence(6),
            'is_correct' => $this->faker->boolean(25), // 25% chance of being correct
            'created_by' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory()->create()->id,
            'updated_by' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory()->create()->id,
        ];

    }
}
