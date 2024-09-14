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
            'course_name' => $this->faker->word(),
            'course_code' => $this->faker->word(),
            'course_credit' => $this->faker->randomFloat(2, 0, 1000),
            'course_teacher' => $this->faker->word(),
            'course_description' => $this->faker->sentence(),
            'course_syllabus' => $this->faker->word(),
            'course_image' => $this->faker->word(),
            'course_status' => $this->faker->word(),
            'requires_proctor' => $this->faker->boolean(),
            'is_paid' => $this->faker->boolean(),
            'cost' => $this->faker->randomFloat(2, 0, 1000),
            'program_id' => \App\Models\Program::inRandomOrder()->first()->id(),
            'teacher_id' => \App\Models\Teacher::inRandomOrder()->first()->id(),
        ];
    }
}
