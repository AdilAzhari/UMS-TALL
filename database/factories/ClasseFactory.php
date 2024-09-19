<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClasseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'group_number' => $this->faker->numberBetween(1, 10),
            'schedule' => $this->faker->word(),
            'year' => $this->faker->numberBetween(1, 4),
            'max_students' => $this->faker->numberBetween(10, 30),
            'current_students' => $this->faker->numberBetween(10, 30),
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
            'teacher_id' => \App\Models\Teacher::inRandomOrder()->first()->id,
            'term_id' => \App\Models\Term::inRandomOrder()->first()->id,
        ];
    }
}
