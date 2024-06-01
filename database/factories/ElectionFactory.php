<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Election;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Election>
 */
class ElectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Election::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'faculty' => $this->faker->randomElement(['FMIPA', 'FATISDA', 'FEB', 'FISIP', 'FT', 'FSRD', 'FK', 'FH', 'FKIP', 'FIB', 'FP', 'Psikologi', 'FKO']),
            'description' => $this->faker->sentence,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }
}
