<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_id' => Classes::inRandomOrder()->first()->id ?? classes::factory()->create()->id,
            'course_id' => Course::inRandomOrder()->first()->id ?? course::factory()->create()->id,
            'teacher_id' => Teacher::inRandomOrder()->first()->id ?? teacher::factory()->create()->id,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'deadline' => $this->faker->dateTimeThisYear(),
            'total_marks' => $this->faker->randomNumber(),
            'status' => $this->faker->randomElement(['pending', 'completed', 'overdue']),
            'file' => $this->faker->word(),
            'created_by' => Teacher::inRandomOrder()->first()->id ?? teacher::factory()->create()->id,
            'updated_by' => Teacher::inRandomOrder()->first()->id ?? teacher::factory()->create()->id,
        ];
    }
}
