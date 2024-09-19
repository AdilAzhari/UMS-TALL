<?php

namespace Database\Factories;

use App\Models\department;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'program_name' => $this->faker->word(),
            'created_at' => $this->faker->dateTimeThisYear(),
            'program_code' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'duration_years' => $this->faker->numberBetween(1, 4),
            'program_status' => $this->faker->randomElement(['Graduated', 'Enrolled', 'Suspended', 'Expelled']),
            'program_type' => $this->faker->randomElement(['Undergraduate', 'Postgraduate', 'Diploma']),
            'student_id' => Student::inRandomOrder()->first()->id,
            'department_id' => department::inRandomOrder()->first()->id,
        ];
    }
}
