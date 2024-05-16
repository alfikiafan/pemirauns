<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Report;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
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
            'report' => $this->faker->paragraph(),
            'report_date' => $this->faker->date(),
            'report_status' => $this->faker->randomElement(['send', 'solved']),
        ];
    }
}
