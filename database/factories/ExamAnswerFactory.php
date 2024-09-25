<?php

namespace Database\Factories;

use App\Models\ExamAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamAnswer>
 */
class ExamAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exam_id' => \App\Models\Exam::inRandomOrder()->first()->id,
            'Exam_question_id' => \App\Models\ExamQuestion::inRandomOrder()->first()->id,
            'created_by' => \App\Models\Teacher::inRandomOrder()->first()->id,
            'updated_by' => \App\Models\Teacher::inRandomOrder()->first()->id,
            'answer_text' => $this->faker->word(),
            'is_correct' => $this->faker->boolean(),
        ];
    }
}
