<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\enrollment;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<enrollment>
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
            'course_id' => Course::inRandomOrder()->first()->id ?? Course::factory()->create()->id,
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory()->create()->id,
            'status' => $this->faker->randomElement(['enrolled', 'pending', 'completed', 'dropped']),
            'grade' => $this->faker->numberBetween(60, 100),
            'grade_points' => $this->faker->randomFloat(2, 0, 100),
            'term_id' => Term::inRandomOrder()->first()->id,
        ];
    }
}
