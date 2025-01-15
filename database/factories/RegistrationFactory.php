<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Proctor;
use App\Models\Registration;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Registration>
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
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory()->create()->id,
            'course_id' => Course::inRandomOrder()->first()->id ?? Course::factory()->create()->id,
            'proctor_id' => Proctor::inRandomOrder()->first()->id ?? Proctor::factory()->create()->id,
            'term_id' => Term::inRandomOrder()->first()->id ?? Term::factory()->create()->id,
            'registration_status' => $this->faker->randomElement(['registered', 'in_progress', 'completed', 'withdrawn']),
            'proctor_approval_status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'proctored' => $this->faker->boolean(),
            'payment_status' => $this->faker->randomElement(['unpaid', 'pending', 'paid', 'future']),
            'completion_date' => $this->faker->date(),
        ];
    }
}
