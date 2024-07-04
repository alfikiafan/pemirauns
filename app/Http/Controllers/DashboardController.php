<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Election;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->hasRole('admin_univ')) {
            $totalUsers = User::count();
            $totalElections = Election::where('faculty', 'Universitas')->count();
            $totalCandidates = Candidate::whereHas('election', function ($query) {
                $query->where('faculty', 'Universitas');
            })->count();
            $approvedUsers = User::where('user_status', 'approved')->count();
            $notApprovedUsers = User::where('user_status', '!=', 'approved')->orWhereNull('user_status')->count();
            $elections = Election::with(['candidates.votes'])->where('faculty', 'Universitas')->orderBy('end_date', 'desc')->take(3)->get();
        } elseif ($user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;
            $totalUsers = User::where('faculty', $faculty)->count();
            $totalElections = Election::where('faculty', $faculty)->count();
            $totalCandidates = Candidate::whereHas('election', function ($query) use ($faculty) {
                $query->where('faculty', $faculty);
            })->count();
            $approvedUsers = User::where('faculty', $faculty)->where('user_status', 'approved')->count();
            $notApprovedUsers = User::where('faculty', $faculty)->where('user_status', '!=', 'approved')->orWhereNull('user_status')->count();
            $elections = Election::with(['candidates.votes'])->where('faculty', $faculty)->orderBy('end_date', 'desc')->take(3)->get();
        } elseif ($user->hasRole('superadmin')) {
            $totalUsers = User::count();
            $totalElections = Election::count();
            $totalCandidates = Candidate::count();
            $approvedUsers = User::where('user_status', 'approved')->count();
            $notApprovedUsers = User::where('user_status', '!=', 'approved')->orWhereNull('user_status')->count();
            $elections = Election::with(['candidates.votes'])->orderBy('end_date', 'desc')->get();
        } else {
            $faculty = $user->faculty;
            $elections = Election::with(['candidates.votes'])->where('faculty', $faculty)->orderBy('end_date', 'desc')->take(1)->get();
            // dd($elections);
            return view('user.dashboard', compact('elections'));
        }

        return view('admin.dashboard', compact('totalUsers', 'totalElections', 'totalCandidates', 'approvedUsers', 'notApprovedUsers', 'elections'));
    }
}
