<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courses>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->word(),
            'credit' => $this->faker->randomFloat(2, 0, 1000),
            'description' => $this->faker->sentence(),
            'syllabus' => $this->faker->word(),
            'image' => $this->faker->url(),
            'status' => $this->faker->boolean(),
            'requier_proctor' => $this->faker->boolean(),
            'is_paid' => $this->faker->boolean(),
            'cost' => $this->faker->randomFloat(2, 0, 1000),
            'program_id' => \App\Models\Program::inRandomOrder()->first()->id,
        ];
    }
}
