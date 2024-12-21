<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Term;
use App\Models\Week;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Week>
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
            'course_id' => Course::inRandomOrder()->first()->id ?? Course::factory()->create()->id,
            'week_number' => $this->faker->numberBetween(1, 9),
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'assignment_id' => Assignment::inRandomOrder()->first()->id ?? Assignment::factory()->create()->id,
            'start_date' => $this->faker->dateTimeThisYear(),
            'end_date' => $this->faker->dateTimeThisYear(),
            'quiz_id' => Quiz::inRandomOrder()->first()->id ?? Quiz::factory()->create()->id,
            'term_id' => Term::inRandomOrder()->first()->id ?? Term::factory()->create()->id,
        ];
    }
}
