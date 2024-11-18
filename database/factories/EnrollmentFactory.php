<?php

namespace Database\Factories;

use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_date' => $this->faker->dateTimeThisYear(),
            'completion_date' => $this->faker->dateTimeThisYear(),
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
            'student_id' => \App\Models\Student::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['enrolled', 'pending', 'completed', 'dropped']),
            'grade' => $this->faker->numberBetween(60,100),
            'grade_points' => $this->faker->randomFloat(2, 0, 100),
            'term_id' => Term::inRandomOrder()->first()->id
        ];
    }
}
