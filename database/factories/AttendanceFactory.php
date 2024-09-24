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
            'reason' => $this->faker->randomElement(['sick', 'vacation', 'other']),
            'notes' => $this->faker->text(),
            'student_id' => \App\Models\Student::inRandomOrder()->first()->id,
            'enrollment_id' => \App\Models\Enrollment::inRandomOrder()->first()->id,
            'class_id' => \App\Models\Classe::inRandomOrder()->first()->id,
            'teacher_id' => \App\Models\Teacher::inRandomOrder()->first()->id,
        ];
    }
}
