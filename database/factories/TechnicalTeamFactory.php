<?php

namespace Database\Factories;

use App\Models\TechnicalTeam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TechnicalTeam>
 */
class TechnicalTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'role' => $this->faker->randomElement(['support', 'system_admin']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
