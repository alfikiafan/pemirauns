<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vote;
use App\Models\Candidate;
use App\Models\User;

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
    protected $model = Vote::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'candidate_id' => Candidate::factory(),
            'date' => $this->faker->dateTime,
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
