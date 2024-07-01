<?php

namespace App\Http\Controllers;

use App\Models\PresidentCandidate;
use App\Models\User;
use Illuminate\Http\Request;

class PresidentCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.president_candidate.index',[
            'presidentCandidates' => PresidentCandidate::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $presidentCandidates = User::whereDoesntHave('PresidentCandidates')
        ->orderBy('name', 'asc')
        ->get();

        return view('admin.president_candidate.create', [
            'presidentCandidates' => $presidentCandidates

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
        return view('admin.president_candidate.edit',[
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
        if ($presidentCandidate->candidates()->exists()) {
            return redirect()->route('vice-president-candidate.index')->with('error', 'Candidate sedang Tergabung kedalam Pemilihan');
        }

        $presidentCandidate->delete();

        return redirect()->route('vice-president-candidate.index')->with('success', 'Vice President Candidate deleted successfully!');
    }
}
