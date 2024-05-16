<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\CandidateProfile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CandidateProfile>
 */
class CandidateProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'candidate_id' => User::factory(),
            'biography' => $this->faker->paragraph(),
            'year' => $this->faker->year(),
            'vision' => $this->faker->sentence(),
            'mission' => $this->faker->sentence(),
        ];
    }
}
