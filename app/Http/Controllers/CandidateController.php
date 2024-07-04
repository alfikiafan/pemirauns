<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\PresidentCandidate;
use App\Models\VicePresidentCandidate;
use App\Models\Vote;

class CandidateController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;

            $candidatesQuery = Candidate::whereHas('election', function ($query) use ($faculty) {
                $query->where('faculty', $faculty);
            });
        } elseif ($user && $user->hasRole('admin_univ')) {
            $candidatesQuery = Candidate::whereHas('election', function ($query) {
                $query->where('faculty', 'Universitas');
            });
        } else {
            $candidatesQuery = Candidate::query();
        }

        $search = request()->query('search');

        if ($search) {
            $candidatesQuery->where(function ($query) use ($search) {
                $query->whereHas('presidentCandidate.user', function($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('vicePresidentCandidate.user', function($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('election', function($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('faculty', 'LIKE', '%' . $search . '%');
                    });
            });
        }

        $candidates = $candidatesQuery->with(['presidentCandidate.user', 'vicePresidentCandidate.user', 'election'])
                                    ->paginate(10);

        $candidates->appends(['search' => $search]);
        View::share('showSearchBox', true);

        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        $user = Auth::user();
    
        if ($user && $user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;
    
            $presidentCandidates = PresidentCandidate::with('user')
                ->whereHas('user', function ($query) use ($faculty) {
                    $query->where('faculty', $faculty);
                })
                ->whereDoesntHave('candidates')
                ->orderBy('created_at', 'desc')
                ->get();
    
            $vicePresidentCandidates = VicePresidentCandidate::with('user')
                ->whereHas('user', function ($query) use ($faculty) {
                    $query->where('faculty', $faculty);
                })
                ->whereDoesntHave('candidates')
                ->orderBy('created_at', 'desc')
                ->get();
    
            $elections = Election::where('faculty', $faculty)->get();
        } elseif($user && $user->hasRole('admin_univ')) {
            $presidentCandidates = PresidentCandidate::with('user')
                ->whereDoesntHave('candidates')
                ->orderBy('created_at', 'desc')
                ->get();
    
            $vicePresidentCandidates = VicePresidentCandidate::with('user')
                ->whereDoesntHave('candidates')
                ->orderBy('created_at', 'desc')
                ->get();
    
            $elections = Election::where('faculty', 'Universitas')->get();
        } else {
            $presidentCandidates = PresidentCandidate::with('user')
                ->whereDoesntHave('candidates')
                ->orderBy('created_at', 'desc')
                ->get();
    
            $vicePresidentCandidates = VicePresidentCandidate::with('user')
                ->whereDoesntHave('candidates')
                ->orderBy('created_at', 'desc')
                ->get();
    
            $elections = Election::all();
        }
    
        return view('admin.candidates.create', compact('elections', 'vicePresidentCandidates', 'presidentCandidates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'president_candidate_id' => 'required|exists:president_candidates,id',
            'vice_president_candidate_id' => 'required|exists:vice_president_candidates,id',
            'election_id' => 'required|exists:elections,id',
            'video' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);
    
        $presidentCandidateExists = Candidate::where('president_candidate_id', $request->input('president_candidate_id'))->exists();
        $vicePresidentCandidateExists = Candidate::where('vice_president_candidate_id', $request->input('vice_president_candidate_id'))->exists();
    
        if ($presidentCandidateExists || $vicePresidentCandidateExists) {
            return redirect()->route('admin.candidates.create')->withErrors('One of the candidates is already participating in another election.');
        }
    
        Candidate::create([
            'president_candidate_id' => $request->input('president_candidate_id'),
            'vice_president_candidate_id' => $request->input('vice_president_candidate_id'),
            'election_id' => $request->input('election_id'),
            'video' => $request->input('video'),
            'vision' => $request->input('vision'),
            'mission' => $request->input('mission'),
        ]);
    
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate successfully added.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $candidate = Candidate::with(['presidentCandidate.user', 'vicePresidentCandidate.user'])->findOrFail($id);
    
        if ($user && $user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;
    
            if ($candidate->election->faculty !== $faculty) {
                return redirect()->route('admin.candidates.index')->withErrors('Anda tidak memiliki akses untuk mengedit kandidat ini.');
            }
    
            $presidentCandidates = PresidentCandidate::with('user')
                ->whereHas('user', function ($query) use ($faculty) {
                    $query->where('faculty', $faculty);
                })
                ->where(function ($query) use ($id) {
                    $query->whereDoesntHave('candidates')
                          ->orWhereHas('candidates', function ($query) use ($id) {
                              $query->where('id', $id);
                          });
                })
                ->orderBy('created_at', 'desc')
                ->get();
    
            $vicePresidentCandidates = VicePresidentCandidate::with('user')
                ->whereHas('user', function ($query) use ($faculty) {
                    $query->where('faculty', $faculty);
                })
                ->where(function ($query) use ($id) {
                    $query->whereDoesntHave('candidates')
                          ->orWhereHas('candidates', function ($query) use ($id) {
                              $query->where('id', $id);
                          });
                })
                ->orderBy('created_at', 'desc')
                ->get();
    
            $elections = Election::where('faculty', $faculty)->orderBy('name', 'asc')->get();
        } elseif($user && $user->hasRole('admin_univ')) {
            $presidentCandidates = PresidentCandidate::with('user')
                ->where(function ($query) use ($id) {
                    $query->whereDoesntHave('candidates')
                          ->orWhereHas('candidates', function ($query) use ($id) {
                              $query->where('id', $id);
                          });
                })
                ->orderBy('created_at', 'desc')
                ->get();
    
            $vicePresidentCandidates = VicePresidentCandidate::with('user')
                ->where(function ($query) use ($id) {
                    $query->whereDoesntHave('candidates')
                          ->orWhereHas('candidates', function ($query) use ($id) {
                              $query->where('id', $id);
                          });
                })
                ->orderBy('created_at', 'desc')
                ->get();
    
            $elections = Election::where('faculty', 'Universitas')->orderBy('name', 'asc')->get();
        } else {
            $presidentCandidates = PresidentCandidate::with('user')
                ->where(function ($query) use ($id) {
                    $query->whereDoesntHave('candidates')
                          ->orWhereHas('candidates', function ($query) use ($id) {
                              $query->where('id', $id);
                          });
                })
                ->orderBy('created_at', 'desc')
                ->get();
    
            $vicePresidentCandidates = VicePresidentCandidate::with('user')
                ->where(function ($query) use ($id) {
                    $query->whereDoesntHave('candidates')
                          ->orWhereHas('candidates', function ($query) use ($id) {
                              $query->where('id', $id);
                          });
                })
                ->orderBy('created_at', 'desc')
                ->get();
    
            $elections = Election::orderBy('name', 'asc')->get();
        }
    
        return view('admin.candidates.edit', compact('candidate', 'presidentCandidates', 'vicePresidentCandidates', 'elections'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'president_candidate_id' => 'required|exists:president_candidates,id',
            'vice_president_candidate_id' => 'required|exists:vice_president_candidates,id',
            'election_id' => 'required|exists:elections,id',
            'video' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);
    
        $candidate = Candidate::findOrFail($id);
    
        $presidentCandidateExists = Candidate::where('president_candidate_id', $request->input('president_candidate_id'))
            ->where('id', '!=', $id)
            ->exists();
    
        $vicePresidentCandidateExists = Candidate::where('vice_president_candidate_id', $request->input('vice_president_candidate_id'))
            ->where('id', '!=', $id)
            ->exists();
    
        if ($presidentCandidateExists || $vicePresidentCandidateExists) {
            return redirect()->route('admin.candidates.edit', $id)->withErrors('One of the candidates is already participating in another election.');
        }
    
        $candidate->update([
            'president_candidate_id' => $request->input('president_candidate_id'),
            'vice_president_candidate_id' => $request->input('vice_president_candidate_id'),
            'election_id' => $request->input('election_id'),
            'video' => $request->input('video'),
            'vision' => $request->input('vision'),
            'mission' => $request->input('mission'),
        ]);
    
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate successfully updated.');
    }

    public function destroy(Candidate $candidate)
    {
        $hasVotes = Vote::where('candidate_id', $candidate->id)->exists();
        $user = Auth::user();
    
        if ($user && $user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;
    
            if ($candidate->election->faculty !== $faculty) {
                return redirect()->route('admin.candidates.index')->withErrors('Anda tidak memiliki akses untuk menghapus kandidat ini.');
            }
        }
    
        if ($hasVotes) {
            return redirect()->route('admin.candidates.index')->withErrors('Kandidat sudah mengikuti pemilihan. Tidak bisa dihapus');
        }
    
        $candidate->delete();
    
        return redirect()->route('admin.candidates.index')->with('success', 'Candidate berhasil dihapus.');
    }
}
