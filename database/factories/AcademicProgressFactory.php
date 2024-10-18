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
            'enrollment_id' => enrollment::inRandomOrder()->first()->id,
        ];
    }
}
