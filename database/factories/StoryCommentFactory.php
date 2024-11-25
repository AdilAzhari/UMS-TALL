<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoryComment>
 */
class StoryCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraphs(3, true),
            'story_id' => \App\Models\Story::factory(),
            'student_id' => \App\Models\Student::factory(),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'parent_id' => null,
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
