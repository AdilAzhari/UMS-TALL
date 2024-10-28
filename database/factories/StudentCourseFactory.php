<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentCourse>
 */
class StudentCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['completed', 'in_progress', 'not_started', 'withdrawn']),
            'attempt' => $this->faker->numberBetween(1, 3),
            'grade' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'F']),
        ];
    }
}
