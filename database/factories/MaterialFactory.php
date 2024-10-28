<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\materials>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::inRandomOrder()->first()->id,
            'created_by' => \App\Models\teacher::inRandomOrder()->first()->id,
            'updated_by' => \App\Models\teacher::inRandomOrder()->first()->id,
            'type' => $this->faker->randomElement(['video', 'pdf', 'audio', 'image']),
            'thumbnail' => $this->faker->word(),
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'size' => $this->faker->randomNumber(),
            'path' => $this->faker->word(),
            'url' => $this->faker->url(),
            'filename' => $this->faker->word(),
            'disk' => $this->faker->word(),
            'week_id' => \App\Models\Week::inRandomOrder()->first()->id,
        ];
    }
}
