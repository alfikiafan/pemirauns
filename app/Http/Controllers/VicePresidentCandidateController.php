<?php

namespace App\Http\Controllers;

use App\Models\VicePresidentCandidate;
use Illuminate\Http\Request;

class VicePresidentCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.vice_president_candidate.index',[
            'vicePresidentCandidates' => VicePresidentCandidate::all(),
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
    public function show(VicePresidentCandidate $vicePresidentCandidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VicePresidentCandidate $vicePresidentCandidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VicePresidentCandidate $vicePresidentCandidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VicePresidentCandidate $vicePresidentCandidate)
    {
        //
    }
}
