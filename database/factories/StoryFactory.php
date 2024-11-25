<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Story>
 */
class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'image' => $this->faker->imageUrl(),
            'student_id' => \App\Models\Student::factory(),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
