<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PresidentCandidate;
use App\Models\VicePresidentCandidate;
use App\Models\Achievement;
use App\Models\Experience;

class VicePresidentCandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $candidates = User::factory()->count(5)->create();
        foreach ($candidates as $candidate) {
            $vicePresidentCandidate = VicePresidentCandidate::create([
                'user_id' => $candidate->id,
                'biography' => 'Biography of Vice President Candidate ' . $candidate->name,
            ]);

            // Tambahkan pencapaian dan pengalaman
            Achievement::factory()->count(3)->create([
                'user_id' => $candidate->id,
            ]);
            Experience::factory()->count(3)->create([
                'user_id' => $candidate->id,
            ]);
        }
    }
}
