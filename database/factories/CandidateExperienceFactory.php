<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\CandidateExperience;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CandidateExperience>
 */
class CandidateExperienceFactory extends Factory
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
            'description' => $this->faker->paragraph(),
            'position' => $this->faker->jobTitle(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }
}
