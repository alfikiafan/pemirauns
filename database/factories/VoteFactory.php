<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Pemira;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'voter_id' => User::factory(),
            'candidate_id' => User::factory(),
            'pemira_id' => Pemira::factory(),
            'vote_date' => $this->faker->date(),
            'selfie_picture' => $this->faker->imageUrl(),
        ];
    }
}
