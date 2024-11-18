<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Course;
use App\Models\enrollment;
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
        return[
            'student_id' => Student::inRandomOrder()->first()->id,
            'gpa' => $this->faker->randomFloat(2, 0, 4),
            'program_id' => Program::inRandomOrder()->first()->id,
            'academic_standing' => $this->faker->randomElement(['good', 'warning', 'probation', 'suspension']),
            'cgpa' => $this->faker->randomFloat(2, 0, 4),
            'total_credits' => $this->faker->numberBetween(0, 100),
            'total_courses' => $this->faker->numberBetween(0, 100),
            'total_courses_completed' => $this->faker->numberBetween(0, 100),
            'total_courses_failed' => $this->faker->numberBetween(0, 100),
            'total_courses_withdrawn' => $this->faker->numberBetween(0, 100),
            'progress_percentage' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['On Track', 'Probation', 'At Risk']),
        ];
    }
}
