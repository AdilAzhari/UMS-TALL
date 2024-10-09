<?php

namespace Database\Factories;

use App\Models\department;
use App\Models\Program;
use App\Models\Term;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Students>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student_id = 'STU';
        $year = date('Y');
        $student_id .= $year.'-'. rand(1000,9999);
        return [
            'enrollment_date' => $this->faker->dateTimeThisYear(),
            'program_id' => Program::inRandomOrder()->first()->id,
            'department_id' => department::inRandomOrder()->first()->id,
            'term_id' => Term::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTimeThisYear(),
            'user_id' => User::inRandomOrder()->first()->id,
            'student_id' => 'STY' . $this->faker->unique()->randomNumber(5),
        ];
    }
}
