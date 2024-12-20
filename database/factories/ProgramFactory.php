<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\ProgramStatuse;
use App\Models\ProgramType;
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
            ['name' => 'Software Engineering', 'code' => 'SE', 'description' => 'Study of software development, design, and maintenance.'],
            ['name' => 'Cyber Security', 'code' => 'CS', 'description' => 'Study of protecting computer systems and networks from attack.'],
            ['name' => 'Artificial Intelligence', 'code' => 'AI', 'description' => 'Study of creating intelligent machines that can perform tasks without explicit instructions.'],
            ['name' => 'Digital Marketing', 'code' => 'DM', 'description' => 'Study of marketing strategies and techniques in the digital age.'],
            ['name' => 'International Business', 'code' => 'IB', 'description' => 'Study of global business operations and international trade.'],
            ['name' => 'Environmental Science', 'code' => 'ES', 'description' => 'Study of the natural environment and its impact on human society.'],
            ['name' => 'Nursing', 'code' => 'N', 'description' => 'Study of the science and practice of caring for the sick and injured.'],
            ['name' => 'Pharmacy', 'code' => 'P', 'description' => 'Study of the science and practice of preparing and dispensing medications.'],
        ];

        $program = $this->faker->randomElement($programs);

        return [
            'program_name' => $program['name'],
            'program_code' => $program['code'],
            'description' => $program['description'],
            'duration_years' => $this->faker->randomElement([2, 3, 4, 5]),
            'program_status_id' => ProgramStatuse::inRandomOrder()->first()->id ?? ProgramStatuse::factory()->create()->id,
            'program_type_id' => ProgramType::inRandomOrder()->first()->id ?? ProgramType::factory()->create()->id,
            'department_id' => Department::inRandomOrder()->first()->id ?? Department::factory()->create()->id,
            'total_credits' => $this->faker->numberBetween(0, 120),
        ];
    }
}
