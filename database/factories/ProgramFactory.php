<?php

namespace Database\Factories;

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
            'department_id' => \App\Models\Department::inRandomOrder()->first()->id(),
            'created_at' => $this->faker->dateTimeThisYear(),
            'program_code' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'duration_years' => $this->faker->numberBetween(1, 4),
            'program_status' => $this->inrandomOrder(['Graduated', 'Enrolled', 'Suspended', 'Expelled']),
            'program_type' => $this->inrandomOrder(['Undergraduate', 'Postgraduate', 'Diploma']),
            'student_iD' => \App\Models\Student::inRandomOrder()->first()->id(),
        ];
    }
}
