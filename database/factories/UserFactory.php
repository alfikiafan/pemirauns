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
            'role' => 'voter',  // Default role, will be overridden as needed
            'nim' => $this->faker->unique()->numerify('########'),
            'faculty' => $this->faker->randomElement(['FMIPA', 'FATISDA', 'FEB', 'FISIP', 'FT', 'FSRB', 'FK', 'FH', 'FKIP']),
            'vote_status' => 'available',
            'student_card' => $this->faker->imageUrl(),
            'user_photo' => $this->faker->imageUrl(),
            'user_status' => 'approved',  // Default status, can be changed in the seeder
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
