<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Course;
use App\Models\Program;
use App\Models\Term;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicProgress>
 */
class AcademicProgressFactory extends Factory
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
            'gpa' => $this->faker->randomFloat(2, 0, 4),
            'program_id' => Program::inRandomOrder()->first()->id,
            'term_id' => Term::inRandomOrder()->first()->id,
            'academic_standing' => 'good',
            'major_courses_total' => 40, // Assuming 40 courses for each major
            'major_courses_completed' => $this->faker->numberBetween(0, 20),
            'general_courses_total' => $this->faker->numberBetween(0, 10),
            'general_courses_completed' => $this->faker->numberBetween(0, 5),
            'elective_courses_total' => $this->faker->numberBetween(0, 6),
            'elective_courses_completed' => $this->faker->numberBetween(0, 10),
        ];
    }
}
