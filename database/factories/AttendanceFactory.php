<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
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
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory()->create()->id,
            'enrollment_id' => Enrollment::inRandomOrder()->first()->id ?? Enrollment::factory()->create()->id,
            'class_id' => Classes::inRandomOrder()->first()->id ?? Classes::factory()->create()->id,
            'teacher_id' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory()->create()->id,
        ];
    }
}
