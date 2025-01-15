<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Material;
use App\Models\Teacher;
use App\Models\Week;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Material>
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
            'course_id' => Course::inRandomOrder()->first()->id ?? course::factory()->create()->id,
            'created_by' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory()->create()->id,
            'updated_by' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory()->create()->id,
            'type' => $this->faker->randomElement(['Video', 'PDF', 'ZIP', 'PPT', 'DOC']),
            'thumbnail' => $this->faker->word(),
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'size' => $this->faker->randomNumber(),
            'path' => $this->faker->word(),
            'url' => $this->faker->url(),
            'filename' => $this->faker->word(),
            'disk' => $this->faker->word(),
            'week_id' => Week::inRandomOrder()->first()->id ?? Week::factory()->create()->id,
        ];
    }
}
