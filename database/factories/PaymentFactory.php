<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments>
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
            'date' => $this->faker->dateTimeThisYear(),
            'student_id' => \App\Models\Student::inRandomOrder()->first()->id(),
            'created_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}