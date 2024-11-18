<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicAchievement>
 */
class AcademicAchievementFactory extends Factory
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
            'term_id' => Term::inRandomOrder()->first()->id,
            'gpa' => $this->faker->randomFloat(2, 0, 4),
            'credits_earned' => $this->faker->numberBetween(1, 20),
            'honors_awards' => $this->faker->sentence(),
        ];
    }
}
