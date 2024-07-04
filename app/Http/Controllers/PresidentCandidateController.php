<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PresidentCandidate;
use App\Models\User;

class PresidentCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $presidentCandidates = PresidentCandidate::query();
    
        if ($user && $user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;
    
            $presidentCandidates->whereHas('user', function ($query) use ($faculty) {
                $query->whereHas('roles', function ($query) use ($faculty) {
                    $query->where('faculty', $faculty);
                });
            });
        }

        $search = request('search');
        if ($search) {
            $presidentCandidates->where(function ($query) use ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('nim', 'like', '%' . $search . '%');
                })
                ->orWhere('biography', 'like', '%' . $search . '%');
            });
        }
    
        $presidentCandidates = $presidentCandidates->paginate(10);
        $presidentCandidates->appends(['search' => $search]);
        View::share('showSearchBox', true);
    
        return view('admin.president_candidate.index', [
            'presidentCandidates' => $presidentCandidates,
        ]);
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $presidentCandidates = User::whereDoesntHave('presidentCandidates');
    
        if ($user && $user->hasRole('admin_fakultas')) {
            $faculty = $user->faculty;
    
            $presidentCandidates->whereHas('roles', function ($query) use ($faculty) {
                $query->where('faculty', $faculty);
            })
            ->where('id', '!=', $user->id)
            ->whereDoesntHave('vicePresidentCandidates')
            ->orderBy('name', 'asc');
        }
    
        $presidentCandidates = $presidentCandidates->get();
    
        return view('admin.president_candidate.create', [
            'presidentCandidates' => $presidentCandidates,
        ]);
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'president_candidate_id' => 'required',
            'biography' => 'required',

        ]);

        PresidentCandidate::create([
            'user_id' => $request->president_candidate_id,
            'biography' => $request->biography,
        ]);

        return redirect()->route('president-candidate.index')->with('success', 'President Candidate berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PresidentCandidate $presidentCandidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PresidentCandidate $presidentCandidate)
    {
        $user = Auth::user();
        if ($user && $user->hasRole('admin_fakultas')) {
            if ($presidentCandidate->user->faculty != $user->faculty && !$user->hasRole('superadmin')) {
                return redirect()->route('president-candidate.index')->withErrors('Anda tidak memiliki akses untuk mengedit kandidat ini.');
            }
        }
    
        return view('admin.president_candidate.edit', [
            'presidentCandidate' => $presidentCandidate,
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PresidentCandidate $presidentCandidate)
    {
        $validatedData = $request->validate([
            'biography' => 'required',

        ]);

        $presidentCandidate->update($validatedData);

        return redirect()->route('president-candidate.index')
                    ->with('success', 'President Candidate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PresidentCandidate $presidentCandidate)
    {
        $user = Auth::user();
        if ($user && $user->hasRole('admin_fakultas')) {
            if ($presidentCandidate->user->faculty != $user->faculty) {
                return redirect()->route('president-candidate.index')->withErrors('Anda tidak memiliki akses untuk menghapus kandidat ini.');
            }
        }
    
        if ($presidentCandidate->candidates()->exists()) {
            return redirect()->route('president-candidate.index')->with('error', 'Kandidat presiden sedang tergabung ke dalam pemilihan');
        }
    
        $presidentCandidate->delete();
    
        return redirect()->route('president-candidate.index')->with('success', 'President Candidate deleted successfully!');
    }    
}
