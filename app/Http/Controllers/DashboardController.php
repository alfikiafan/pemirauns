<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Information;
use App\Models\Pemira;
use App\Models\Report;
use App\Models\CandidateProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $all_pemira = Pemira::all();
        $informations = Information::all();

        if ($user->role === 'admin') {
            $reports = Report::all();
            $candidates = User::where('role', 'candidate')->get();
            $voters = User::where('role', 'voter')->get();
            return view('admin.dashboard', compact('all_pemira', 'informations', 'reports', 'candidates', 'voters'));
        } elseif ($user->role === 'candidate') {
            $profile = CandidateProfile::where('candidate_id', $user->id)->first();
            return view('candidate.dashboard', compact('profile', 'all_pemira', 'informations'));
        } else {
            return view('user.dashboard', compact('all_pemira', 'informations'));
        }
    }
}
