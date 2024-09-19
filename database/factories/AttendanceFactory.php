<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeThisYear(),
            'status' => $this->faker->randomElement(['present', 'absent']),
            'student_id' => \App\Models\Student::inRandomOrder()->first()->id,
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTimeThisYear(),
            'enrollment_id' => \App\Models\Enrollment::inRandomOrder()->first()->id,
            'reason' => $this->faker->sentence(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
