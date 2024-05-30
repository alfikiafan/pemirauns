<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            InformationSeeder::class,
            VicePresidentCandidateSeeder::class,
            PresidentCandidateSeeder::class,
            ExperienceSeeder::class,
            AchievementSeeder::class,
            ElectionSeeder::class,
            CandidateSeeder::class,
            VoteSeeder::class,
        ]);
    }
}