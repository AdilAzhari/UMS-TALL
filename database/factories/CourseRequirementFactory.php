<?php

namespace Database\Factories;

use App\Models\CourseCategory;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseRequirement
 */
class CourseRequirementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'program_id' => Program::inRandomOrder()->first()->id,
            'course_category_id' => CourseCategory::inRandomOrder()->first()->id,
            'required_courses' => $this->faker->numberBetween(1, 4),
        ];
    }
}
