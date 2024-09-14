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
        return [
            'enrollment_date' => $this->faker->dateTimeThisYear(),
            'current_year' => $this->faker->numberBetween(1, 4),
            'user_id' => User::inRandomOrder()->first()->id(),
            'program_id' => Program::inRandomOrder()->first()->id(),
            'department_id' => department::inRandomOrder()->first()->id(),
            'current_term_id' => Term::inRandomOrder()->first()->id(),
            'created_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
