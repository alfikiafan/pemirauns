<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Experience;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Experience::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'description' => $this->faker->paragraph,
            'range' => $this->faker->date() . ' - ' . $this->faker->date(),
            'position' => $this->faker->jobTitle,
        ];
    }
}
