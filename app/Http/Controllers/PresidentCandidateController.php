<?php

namespace App\Http\Controllers;

use App\Models\PresidentCandidate;
use Illuminate\Http\Request;

class PresidentCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.president_candidate.index',[
            'presidentCandidates' => PresidentCandidate::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PresidentCandidate $presidentCandidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PresidentCandidate $presidentCandidate)
    {
        //
    }
}
