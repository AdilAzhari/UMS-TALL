<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'payment_date' => $this->faker->dateTime(),
            'student_id' => Student::inRandomOrder()->first()->id ?? student::factory()->create()->id,
            'course_id' => Course::inRandomOrder()->first()->id ?? course::factory()->create()->id,
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Failed', 'Refunded', 'Cancelled']),
            'transaction_type' => $this->faker->randomElement(['Exam/Course Processing Fee', 'Transferring Credit Fee', 'application Fee']),
            'method' => $this->faker->randomElement(['Strip', 'Paypal']),
            'failure_reason' => $this->faker->sentence(),
            'payment_intent' => $this->faker->uuid(),
            'refund_id' => $this->faker->uuid(),
            'created_at' => $this->faker->dateTimeThisYear(),
            'updated_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
