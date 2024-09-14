<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grading_scale>
 */
class GradingScaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grade' => $this->faker->word(),
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id(),
            'created_at' => $this->faker->dateTimeThisYear(),
            'min_score' => $this->faker->randomFloat(2, 0, 100),
            'max_score' => $this->faker->randomFloat(2, 0, 100),
            'gpa_point' => $this->faker->randomFloat(2, 0, 4),
        ];
    }
}
