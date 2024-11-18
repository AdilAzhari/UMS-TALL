<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Term>
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
        $name = $this->faker->monthName() . ' ' . $this->faker->year();

        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'start_date' => now()->addMonths(1),
            'end_date' => now()->addMonths(3),
            'max_courses' => 5,
            'registration_start_date' => now()->addMonths(1),
            'registration_end_date' => now()->addMonths(2),
        ];
    }
}
