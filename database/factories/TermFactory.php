<?php

namespace Database\Factories;

use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Term>
 */
class TermFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'slug' => Str()->slug($this->faker->unique()->words(2, true)),
            'start_date' => now()->addMonths(2),
            'end_date' => now()->addMonths(4),
            'max_courses' => $this->faker->numberBetween(20, 40),
            'registration_start_date' => now()->addMonths(2),
            'registration_end_date' => now()->addMonths(3),
        ];
    }
}
