<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
            'week_id' => \App\Models\Week::inRandomOrder()->first()->id,
            'message' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'title' => $this->faker->word(),
        ];
    }
}
