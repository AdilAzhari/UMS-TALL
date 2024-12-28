<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Classes>
 */
class ClassesFactory extends Factory
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
            'semester' => $this->faker->word(),
            'year' => $this->faker->numberBetween(1, 4),
            'max_students' => $this->faker->numberBetween(10, 30),
            'current_students' => $this->faker->numberBetween(10, 30),
            'course_id' => Course::inRandomOrder()->first()->id ?? Course::factory()->create()->id,
            'teacher_id' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory()->create()->id,
            'term_id' => Term::inRandomOrder()->first()->id ?? Term::factory()->create()->id,
        ];
    }
}
