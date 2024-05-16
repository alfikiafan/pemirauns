<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pemira;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemira>
 */
class PemiraFactory extends Factory
{
    protected $model = Pemira::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'faculty' => $this->faker->randomElement(['FMIPA', 'FATISDA', 'FEB', 'FISIP', 'FT', 'FSRB', 'FK', 'FH', 'FKIP']),
            'information' => $this->faker->paragraph(),
            'start_datetime' => $this->faker->dateTime(),
            'end_datetime' => $this->faker->dateTime(),
        ];
    }
}
