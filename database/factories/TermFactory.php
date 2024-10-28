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
        $name = ['Fall 2024', 'Spring 2025', 'Summer 2025', 'Winter 2025'];

        return [
            'name' => $name[array_rand($name)],
            'slug' => str($name[array_rand($name)]),
            'start_date' => now()->addMonths(1),
            'end_date' => now()->addMonths(3),
            'max_courses' => 5,
            'registration_start_date' => now()->addMonths(1),
            'registration_end_date' => now()->addMonths(2),
        ];
    }
}
