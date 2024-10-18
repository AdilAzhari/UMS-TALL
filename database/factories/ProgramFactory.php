<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    public function definition(): array
    {
        $programs = [
            ['name' => 'Computer Science', 'code' => 'CS', 'description' => 'A comprehensive study of computing concepts and technologies.'],
            ['name' => 'Business Administration', 'code' => 'BA', 'description' => 'Develop skills in management, finance, and organizational leadership.'],
            ['name' => 'Mechanical Engineering', 'code' => 'ME', 'description' => 'Study of design, manufacturing, and maintenance of mechanical systems.'],
            ['name' => 'Data Science', 'code' => 'DS', 'description' => 'Advanced study of data analysis, machine learning, and statistical methods.'],
            ['name' => 'Graphic Design', 'code' => 'GD', 'description' => 'Creative program focusing on visual communication and digital art.'],
        ];

        $program = $this->faker->randomElement($programs);

        return [
            'program_name' => $program['name'],
            'program_code' => $program['code'],
            'description' => $program['description'],
            'duration_years' => $this->faker->randomElement([2, 3, 4, 5]),
            'program_status' => $this->faker->randomElement(['Graduated', 'Enrolled', 'Suspended', 'Expelled']),
            'program_type' => $this->faker->randomElement(['Undergraduate', 'Postgraduate', 'Diploma']),
            'department_id' => Department::inRandomOrder()->first()->id,
        ];
    }
}
