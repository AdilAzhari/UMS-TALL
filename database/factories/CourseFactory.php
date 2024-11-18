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
            'name' => $this->faker->sentence(3),
            'code' => strtoupper($this->faker->bothify('??###')),
            'credit_hours' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->text(200),
            'syllabus' => $this->faker->word(),
            'image' => $this->faker->url(),
            'status' => $this->faker->boolean(),
            'requier_proctor' => $this->faker->boolean(),
            'paid' => $this->faker->randomElement(['paid', 'unpaid', 'future_payment']),
            'cost' => $this->faker->randomFloat(2, 0, 150),
            'program_id' => \App\Models\Program::inRandomOrder()->first()->id,
            'course_category_id' => \App\Models\CourseCategory::inRandomOrder()->first()->id,
            'prerequisite_course_id' => \App\Models\Course::inRandomOrder()->first()->id ?? null,
        ];
    }
}
