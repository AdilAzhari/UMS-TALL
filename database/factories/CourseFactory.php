<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Courses;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Courses>
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
            'name' => $this->faker->sentence(3),
            'code' => strtoupper($this->faker->bothify('??###')),
            'credit_hours' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->text(200),
            'syllabus' => $this->faker->word(),
            'image' => $this->faker->url(),
            'status' => $this->faker->boolean(),
            'require_proctor' => $this->faker->boolean(),
            'paid' => $this->faker->randomElement(['paid', 'unpaid', 'future_payment']),
            'cost' => $this->faker->randomFloat(2, 0, 150),
            'program_id' => Program::inRandomOrder()->first()->id ?? Program::factory()->create()->id,
            'course_category_id' => CourseCategory::inRandomOrder()->first()->id ?? CourseCategory::factory()->create()->id,
            'prerequisite_course_id' => Course::inRandomOrder()->first()->id ?? Course::factory()->create()->id,
        ];
    }
}
