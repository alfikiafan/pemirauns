<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Election;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function dashboard() {
        $user = Auth::user();
    
        if ($user->hasRole('admin_univ')) {
            $totalUsers = User::count();
            $totalElections = Election::where('faculty', 'Universitas')->count();
            $totalCandidates = Candidate::whereHas('election', function($query) {
                $query->where('faculty', 'Universitas');
            })->count();
            $approvedUsers = User::where('user_status', 'approved')->count();
            $notApprovedUsers = User::where('user_status', '!=', 'approved')->orWhereNull('user_status')->count();
            $Vote = Vote::all(); // Add this line
            $candidates = Candidate::whereHas('election', function($query) {
                $query->where('faculty', 'Universitas');
            })->get(); // Add this line if candidates are needed
        } elseif ($user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;
    
            $totalUsers = User::where('faculty', $faculty)->count();
            $totalElections = Election::where('faculty', $faculty)->count();
            $totalCandidates = Candidate::whereHas('election', function($query) use ($faculty) {
                $query->where('faculty', $faculty);
            })->count();
            $Vote = Vote::all(); // Add this line
            $candidates = Candidate::whereHas('election', function($query) use ($faculty) {
                $query->where('faculty', $faculty);
            })->get();
            $approvedUsers = User::where('faculty', $faculty)->where('user_status', 'approved')->count();
            $notApprovedUsers = User::where('faculty', $faculty)->where('user_status', '!=', 'approved')->orWhereNull('user_status')->count();
        } else {
            $totalUsers = User::count();
            $totalElections = Election::count();
            $totalCandidates = Candidate::count();
            $Vote = Vote::all(); // Add this line
            $candidates = Candidate::all(); // Add this line if candidates are needed
            $approvedUsers = User::where('user_status', 'approved')->count();
            $notApprovedUsers = User::where('user_status', '!=', 'approved')->orWhereNull('user_status')->count();
        }
    
        return view('admin.dashboard', compact('totalUsers', 'totalElections', 'totalCandidates', 'approvedUsers', 'notApprovedUsers', 'Vote', 'candidates'));
    }
    
    
}