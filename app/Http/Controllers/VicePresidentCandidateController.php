<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\VicePresidentCandidate;
use App\Models\User;

class VicePresidentCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        View::share('showSearchBox', true);
        return view('admin.vice_president_candidate.index',[
            'vicePresidentCandidates' => VicePresidentCandidate::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vicePresidentCandidates = User::whereDoesntHave('vicePresidentCandidates')
        ->orderBy('name', 'asc')
        ->get();

        return view('admin.vice_president_candidate.create', [
            'vicePresidentCandidates' => $vicePresidentCandidates

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
        return view('admin.vice_president_candidate.edit',[
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
    if ($vicePresidentCandidate->candidates()->exists()) {
        return redirect()->route('vice-president-candidate.index')->with('error', 'Candidate sedang Tergabung kedalam Pemilihan');
    }

    $vicePresidentCandidate->delete();

    return redirect()->route('vice-president-candidate.index')->with('success', 'Vice President Candidate deleted successfully!');
}
}
