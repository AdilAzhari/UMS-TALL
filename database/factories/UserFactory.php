<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'is_active' => fake()->boolean(),
            'Preferred_name' => fake()->name(),
            'avatar' => fake()->imageUrl(),
            'zip_code' => fake()->postcode(),
            'state' => fake()->state(),
            'city_of_residence' => fake()->city(),
            'phone_number' => fake()->phoneNumber(),
            'date_of_birth' => fake()->date(),
            'nationality' => fake()->country(),
            'country_of_residence' => fake()->country(),
            'marital_status' => fake()->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
            'gender' => fake()->randomElement(['male','female']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
