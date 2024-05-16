<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\CandidateAchievement;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CandidateAchievement>
 */
class CandidateAchievementFactory extends Factory
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
            'year' => $this->faker->year(),
            'title' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(['competition', 'organizational', 'volunteer']),
        ];
    }
}
