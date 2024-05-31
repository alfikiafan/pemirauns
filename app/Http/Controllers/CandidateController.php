<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Election;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('presidentCandidate', 'vicePresidentCandidate', 'election')->get();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        // users = user that doesn't have role
        $users = User::whereDoesntHave('roles')->get();
        $elections = Election::all();
        return view('admin.candidates.create', compact('users', 'elections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'president_candidate_id' => 'required|exists:users,id',
            'vice_president_candidate_id' => 'required|exists:users,id',
            'election_id' => 'required|exists:elections,id',
            'video' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);
    
        Candidate::create($validated);
    
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate created successfully');
    }

    public function edit($id)
    {
        $candidate = Candidate::findOrFail($id);
        $users = User::all();
        $elections = Election::all();
        return view('admin.candidates.edit', compact('candidate', 'users', 'elections'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $validated = $request->validate([
            'president_candidate_id' => 'required|exists:users,id',
            'vice_president_candidate_id' => 'required|exists:users,id',
            'election_id' => 'required|exists:elections,id',
            'video' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);
    
        $candidate->update($validated);
    
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate updated successfully');
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate deleted successfully');
    }
}