<?php

namespace Database\Factories;

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
            'quiz_question_id' => $this->faker->numberBetween(1, 10),
            'option' => $this->faker->sentence(2),
            'is_correct' => $this->faker->boolean(),
            'created_by' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory()->create()->id,
            'updated_by' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory()->create()->id,
        ];
    }
}
