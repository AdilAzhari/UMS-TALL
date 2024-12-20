<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Week;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Announcement>
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
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'course_id' => Course::inRandomOrder()->first()->id ?? Course::factory()->create()->id,
            'week_id' => Week::inRandomOrder()->first()->id ?? Week::factory()->create()->id,
            'message' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'title' => $this->faker->word(),
            'audience' => $this->faker->randomElement(['global', 'week', 'course']),
            'type' => $this->faker->randomElement(['announcement', 'assignment', 'quiz']),
            'created_by' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory()->create()->id,
        ];
    }
}
