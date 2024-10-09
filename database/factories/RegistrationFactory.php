<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Course;
use App\Models\Proctor;
use App\Models\Term;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
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
            'course_id' => Course::inRandomOrder()->first()->id,
            'proctor_id' => Proctor::inRandomOrder()->first()->id,
            'term_id' => Term::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['registered', 'in_progress', 'completed', 'withdrawn']),
            'start_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'proctor_status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'payment_status' => $this->faker->boolean(),
        ];
    }
}
