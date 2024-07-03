<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VicePresidentCandidate;
use App\Models\User;

class VicePresidentCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $vicePresidentCandidates = VicePresidentCandidate::query();
    
        if ($user && $user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;
    
            $vicePresidentCandidates->whereHas('user', function ($query) use ($faculty) {
                $query->whereHas('roles', function ($query) use ($faculty) {
                    $query->where('faculty', $faculty);
                });
            });
    
            $search = request('search');
            if ($search) {
                $vicePresidentCandidates->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%')
                            ->orWhere('nim', 'like', '%' . $search . '%');
                    })
                        ->orWhere('biography', 'like', '%' . $search . '%');
                });
            }
        }
    
        $vicePresidentCandidates = $vicePresidentCandidates->paginate(10);
        View::share('showSearchBox', true);
    
        return view('admin.vice_president_candidate.index', [
            'vicePresidentCandidates' => $vicePresidentCandidates,
        ]);
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user && $user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;
    
            $vicePresidentCandidates = User::whereDoesntHave('vicePresidentCandidates')
                ->whereHas('roles', function ($query) use ($faculty) {
                    $query->where('faculty', $faculty);
                })
                ->where('id', '!=', $user->id)
                ->whereDoesntHave('presidentCandidates')
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $vicePresidentCandidates = User::whereDoesntHave('vicePresidentCandidates')
                ->orderBy('name', 'asc')
                ->get();
        }
    
        return view('admin.vice_president_candidate.create', [
            'vicePresidentCandidates' => $vicePresidentCandidates,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vice_president_candidate_id' => 'required',
            'biography' => 'required',

        ]);

        VicePresidentCandidate::create([
            'user_id' => $request->vice_president_candidate_id,
            'biography' => $request->biography,
        ]);

        return redirect()->route('vice-president-candidate.index')->with('success', 'Vice President Candidate berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VicePresidentCandidate $vicePresidentCandidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VicePresidentCandidate $vicePresidentCandidate)
    {
        $user = Auth::user();
        if ($user && $user->hasRole('admin_fakultas')) {
            if ($vicePresidentCandidate->user->faculty != $user->faculty && !$user->hasRole('superadmin')) {
                return redirect()->route('vice-president-candidate.index')->withErrors('Anda tidak memiliki akses untuk mengedit kandidat ini.');
            }
        }
    
        return view('admin.vice_president_candidate.edit', [
            'vicePresidentCandidate' => $vicePresidentCandidate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VicePresidentCandidate $vicePresidentCandidate)
    {
        $validatedData = $request->validate([
            'biography' => 'required',

        ]);

        $vicePresidentCandidate->update($validatedData);

        return redirect()->route('vice-president-candidate.index')
                    ->with('success', 'Vice President Candidate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VicePresidentCandidate $vicePresidentCandidate)
    {
        $user = Auth::user();
        if ($user && $user->hasRole('admin_fakultas')) {
            if ($vicePresidentCandidate->user->faculty != $user->faculty) {
                return redirect()->route('vice-president-candidate.index')->withErrors('Anda tidak memiliki akses untuk menghapus kandidat ini.');
            }
        }
    
        if ($vicePresidentCandidate->candidates()->exists()) {
            return redirect()->route('vice-president-candidate.index')->with('error', 'Kandidat vice presiden sedang tergabung ke dalam pemilihan');
        }
    
        $vicePresidentCandidate->delete();
    
        return redirect()->route('vice-president-candidate.index')->with('success', 'Vice President Candidate deleted successfully!');
    }
}
