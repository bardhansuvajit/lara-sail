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
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'country_code' => fake()->randomElement(['IN', 'US']),
            'primary_phone_no' => fake()->unique()->phoneNumber(),
            'gender_id' => fake()->numberBetween(1, 2),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'alt_phone_no' => fake()->optional()->phoneNumber(),
            'date_of_birth' => fake()->optional()->date(),
            'profile_picture' => fake()->optional()->imageUrl(),
            'remember_token' => Str::random(10),
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
