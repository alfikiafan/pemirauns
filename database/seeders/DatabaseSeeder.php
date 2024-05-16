<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Report;
use App\Models\Information;
use App\Models\Vote;
use App\Models\Pemira;
use App\Models\CandidateProfile;
use App\Models\CandidateAchievement;
use App\Models\CandidateExperience;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create 5 admin users with IDs 1-5
        User::factory()->count(5)->state(['role' => 'admin'])->create();

        // Create 10 candidate users with IDs 6-15
        User::factory()->count(10)->state(['role' => 'candidate'])->create();

        // Create 20 voter users
        User::factory()->count(20)->state(['role' => 'voter'])->create();

        // Create Pemira
        $pemira = Pemira::factory()->create();

        // Create Candidate Profiles, Achievements, and Experiences
        $candidates = User::where('role', 'candidate')->get();
        foreach ($candidates as $candidate) {
            CandidateProfile::factory()->create(['candidate_id' => $candidate->id]);
            CandidateAchievement::factory()->count(3)->create(['candidate_id' => $candidate->id]);
            CandidateExperience::factory()->count(2)->create(['candidate_id' => $candidate->id]);
        }

        // Create Reports for approved voters
        $voters = User::where('role', 'voter')->where('user_status', 'approved')->get();
        foreach ($voters as $voter) {
            Report::factory()->create(['voter_id' => $voter->id]);
        }

        // Create Information by admin users
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Information::factory()->create(['admin_id' => $admin->id]);
        }

        // Create Votes by voters
        foreach ($voters as $voter) {
            $candidate = $candidates->random();
            Vote::factory()->create(['voter_id' => $voter->id, 'candidate_id' => $candidate->id, 'pemira_id' => $pemira->id]);
        }
    }
}
