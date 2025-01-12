<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\ClassGroup;
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
            'user_id' => User::query()->inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'course_id' => Course::query()->inRandomOrder()->first()->id ?? Course::factory()->create()->id,
            'week_id' => Week::query()->inRandomOrder()->first()->id ?? Week::factory()->create()->id,
            'message' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'title' => $this->faker->word(),
            'audience' => $this->faker->randomElement(['global', 'week', 'course']),
            'type' => $this->faker->randomElement(['announcement', 'assignment', 'quiz']),
            'created_by' => Teacher::query()->inRandomOrder()->first()->id,
            'class_group_id' => ClassGroup::query()->inRandomOrder()->first()->id,
        ];
    }
}
