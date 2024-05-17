<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index(){
        // dd($candidate);
        $candidates = DB::table('users')
        ->where('role', '=', 'candidate')
        ->select('users.id as id')
        ->get();
        return view ('landing-page.landing', [
            'candidates' => $candidates,
        ]);
    }

    public function showCandidate(User $user){
        $candidates = DB::table('users')
        ->where('role', '=', 'candidate')
        ->get();
        $selectedCandidate = DB::table('users')
        ->join('candidate_profiles', 'users.id', 'candidate_profiles.candidate_id')
        ->where('users.id', '=', $user->id)
        ->select('users.name as name',
                'candidate_profiles.biography as biography',
                'candidate_profiles.vision as vision',
                'candidate_profiles.mission as mission',)
        ->get();
        // dd($selectedCandidate);
        return view ('candidate-page.index', [
            'candidates' => $candidates,
            'selectedCandidate' => $selectedCandidate[0],
        ]);
    }
}
