<?php

namespace Database\Factories;

use App\Models\Quizze;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Week>
 */
class WeekFactory extends Factory
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
            'week_number' => $this->faker->numberBetween(1, 9),
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'assignment_id' => \App\Models\Assignment::inRandomOrder()->first()->id,
            'start_date' => $this->faker->dateTimeThisYear(),
            'end_date' => $this->faker->dateTimeThisYear(),
            'quizz_id' => Quizze::inRandomOrder()->first()->id,
        ];
    }
}
