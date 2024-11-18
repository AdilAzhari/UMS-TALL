<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseGrades>
 */
class CourseGradesFactory extends Factory
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
            'term_id' => Term::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            'grade' => $this->faker->randomFloat(2, 0, 100), // Grade between 0 and 100
            'credits' => $this->faker->numberBetween(1, 4),
        ];
    }
}
