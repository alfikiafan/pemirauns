<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Election;
use App\Models\PresidentCandidate;
use App\Models\VicePresidentCandidate;
use App\Models\Vote;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('presidentCandidate', 'vicePresidentCandidate', 'election')->get();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        $users = User::whereDoesntHave('roles')
            ->whereDoesntHave('presidentCandidates')
            ->whereDoesntHave('vicePresidentCandidates')
            ->orderBy('name', 'asc')
            ->get();

        $elections = Election::all();

        return view('admin.candidates.create', compact('users', 'elections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'president_candidate_id' => 'required|exists:users,id',
            'vice_president_candidate_id' => 'required|exists:users,id',
            'election_id' => 'required|exists:elections,id',
            'video' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        $presidentCandidateExists = PresidentCandidate::where('user_id', $request->input('president_candidate_id'))->exists();
        $vicePresidentCandidateExists = VicePresidentCandidate::where('user_id', $request->input('vice_president_candidate_id'))->exists();
        
        if ($presidentCandidateExists || $vicePresidentCandidateExists) {
            return redirect()->back()->withErrors('Pengguna sudah terdaftar sebagai kandidat.');
        }

        $presidentCandidate = PresidentCandidate::create([
            'user_id' => $request->input('president_candidate_id'),
            'biography' => '',
        ]);

        $vicePresidentCandidate = VicePresidentCandidate::create([
            'user_id' => $request->input('vice_president_candidate_id'),
            'biography' => '',
        ]);

        Candidate::create([
            'president_candidate_id' => $presidentCandidate->id,
            'vice_president_candidate_id' => $vicePresidentCandidate->id,
            'election_id' => $request->input('election_id'),
            'video' => $request->input('video'),
            'vision' => $request->input('vision'),
            'mission' => $request->input('mission'),
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $candidate = Candidate::with(['presidentCandidate.user', 'vicePresidentCandidate.user'])->findOrFail($id);

        $users = User::whereDoesntHave('roles')
            ->whereDoesntHave('presidentCandidates')
            ->whereDoesntHave('vicePresidentCandidates')
            ->orWhere('id', $candidate->presidentCandidate->user_id)
            ->orWhere('id', $candidate->vicePresidentCandidate->user_id)
            ->orderBy('name', 'asc')
            ->get();

        $elections = Election::orderBy('name', 'asc')->get();

        return view('admin.candidates.edit', compact('candidate', 'users', 'elections'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'president_candidate_id' => 'required|exists:users,id',
            'vice_president_candidate_id' => 'required|exists:users,id',
            'election_id' => 'required|exists:elections,id',
            'video' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        $candidate = Candidate::findOrFail($id);

        $isPresidentChanged = $candidate->presidentCandidate->user_id != $request->input('president_candidate_id');
        $isVicePresidentChanged = $candidate->vicePresidentCandidate->user_id != $request->input('vice_president_candidate_id');
        
        $candidate->presidentCandidate->update([
            'user_id' => $request->input('president_candidate_id'),
            'biography' => $isPresidentChanged ? '' : $candidate->presidentCandidate->biography,
        ]);

        $candidate->vicePresidentCandidate->update([
            'user_id' => $request->input('vice_president_candidate_id'),
            'biography' => $isVicePresidentChanged ? '' : $candidate->vicePresidentCandidate->biography,
        ]);

        $candidate->update([
            'election_id' => $request->input('election_id'),
            'video' => $request->input('video'),
            'vision' => $request->input('vision'),
            'mission' => $request->input('mission'),
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate berhasil diperbarui.');
    }

    public function destroy(Candidate $candidate)
    {
        $presidentId = $candidate->president_candidate_id;
        $vicePresidentId = $candidate->vice_president_candidate_id;

        $hasVotes = Vote::where('candidate_id', $candidate->id)->exists();

        if ($hasVotes) {
            return redirect()->route('admin.candidates.index')->withErrors('Kandidat sudah mengikuti pemilihan. Tidak bisa dihapus');
        }

        $candidate->delete();

        PresidentCandidate::where('id', $presidentId)->delete();
        VicePresidentCandidate::where('id', $vicePresidentId)->delete();

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate deleted successfully');
    }
}