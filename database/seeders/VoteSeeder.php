<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vote;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Election;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Dapatkan semua pemira Univ
        $univElections = Election::where('faculty', 'all')->get();
        
        // Dapatkan semua pengguna yang bukan admin
        $voters = User::whereDoesntHave('roles')->get();
        
        foreach ($voters as $voter) {
            // Pemira fakultas
            $facultyElections = Election::where('faculty', $voter->faculty)->get();
            $elections = $univElections->merge($facultyElections);
            
            foreach ($elections as $election) {
                // Ambil kandidat dari pemira terkait
                $candidate = Candidate::where('election_id', $election->id)->inRandomOrder()->first();
                
                if ($candidate) {
                    Vote::create([
                        'user_id' => $voter->id,
                        'candidate_id' => $candidate->id,
                        'date' => now(),
                        'photo' => 'photo.jpg',
                    ]);
                }
            }
        }
    }
}
