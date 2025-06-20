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
        $full_name = fake('ru_RU')->unique()->name();
        $username = Str::lower(explode(' ', $full_name)[0]) . rand(0, 9) . rand(0, 9);
        while (strlen($username) < 6)
            $username .= rand(0, 9);

        return [
            'username' => $username,
            'password' => static::$password ??= Hash::make('password'),
            'full_name' => $full_name,
            'phone_number' => fake('ru_RU')->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
