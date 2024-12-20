<?php

namespace Database\Factories;

use App\Models\department;
use App\Models\Program;
use App\Models\Students;
use App\Models\Term;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Students>
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
<<<<<<< HEAD
        $student_id .= $year.'-'.rand(1000, 9999);

        return [
            'enrollment_date' => $this->faker->dateTimeThisYear(),
            'program_id' => Program::inRandomOrder()->first()->id ?? Program::factory()->create()->id,
            'department_id' => department::inRandomOrder()->first()->id ?? department::factory()->create()->id,
            'term_id' => Term::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTimeThisYear(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'student_id' => 'STY'.$this->faker->unique()->randomNumber(5),
=======

        return [
            'enrollment_date' => $this->faker->dateTimeThisYear(),
            'created_at' => $this->faker->dateTimeThisYear(),
            'program_id' => Program::inRandomOrder()->first()?->id ?? Program::factory()->create()->id,
            'department_id' => Department::inRandomOrder()->first()?->id ?? \App\Models\Department::factory()->create()->id,
            'term_id' => Term::inRandomOrder()->first()?->id ?? Term::factory()->create()->id,
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
            'student_id' => 'STY' . $this->faker->unique()->randomNumber(5),
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date(),
        ];
    }
}
