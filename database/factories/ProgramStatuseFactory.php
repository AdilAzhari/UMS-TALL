<?php

namespace Database\Factories;

use App\Models\program_statuse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<program_statuse>
 */
class ProgramStatuseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement([
                'Enrolled',
                'Suspended',
                'Expelled',
                'Dropped',
                'Withdrawn',
                'Completed',
            ]),
        ];
    }
}
