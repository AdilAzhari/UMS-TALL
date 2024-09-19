<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exams>
 */
class ExamFactory extends Factory
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
            'created_at' => $this->faker->dateTimeThisYear(),
            'exam_date' => $this->faker->dateTimeThisYear(),
            'exam_description' => $this->faker->sentence(),
            'exam_duration' => $this->faker->randomNumber(),
            'exam_rules' => $this->faker->sentence(),
            'passing_score' => $this->faker->randomNumber(),
            'exam_questions' => $this->faker->randomNumber(),
            'created_by' => \App\Models\User::inRandomOrder()->first()->id,
            'updated_by' => \App\Models\User::inRandomOrder()->first()->id,
            'exam_passing_score' => $this->faker->randomNumber(),
            'exam_answers' => $this->faker->randomNumber(),
        ];
    }
}
