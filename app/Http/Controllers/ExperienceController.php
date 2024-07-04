<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {   $user = User::where('id', $id)->get();
        // dd($user[0]->name);
        return view ('admin.experience.create',[
            'user' => $user[0],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'position' => 'required',
            'range' => 'required',
            'description' => 'required',
        ]);


        Experience::create([
            'user_id' => $id,
            'position' => $request->position,
            'range' => $request->range,
            'description' => $request->description
        ]);

        if(!$user->vicePresidentCandidates()->exists()){
            $idCandidate = $user->presidentCandidates[0]->id;
            return redirect()->route('president-candidate.show', $idCandidate)
                ->with('success', 'Experience created successfully.');
        }
        elseif(!$user->presidentCandidates()->exists()){
            $idCandidate = $user->vicePresidentCandidates[0]->id;
            return redirect()->route('vice-president-candidate.show', $idCandidate)
            ->with('success', 'Experience created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Experience $experience)
    {
        $experience->delete();

            return redirect()->back()
                ->with('success', 'Experience deleted successfully.');
    }
}
