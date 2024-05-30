<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\PresidentCandidate;
use App\Models\VicePresidentCandidate;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Candidate::class;

    public function definition()
    {
        return [
            'president_candidate_id' => PresidentCandidate::factory(),
            'vice_president_candidate_id' => VicePresidentCandidate::factory(),
            'election_id' => Election::factory(),
            'video' => $this->faker->url,
            'vision' => $this->faker->sentence,
            'mission' => $this->faker->paragraph,
        ];
    }
}
