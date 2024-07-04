<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AchievementController extends Controller
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
    {
        $user = User::where('id', $id)->get();
        // dd($user[0]->name);
        return view ('admin.achievement.create',[
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
            'name' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);


        Achievement::create([
            'user_id' => $id,
            'name' => $request->name,
            'date' => $request->date,
            'description' => $request->description
        ]);

        if(!$user->vicePresidentCandidates()->exists()){
            $idCandidate = $user->presidentCandidates[0]->id;
            return redirect()->route('president-candidate.show', $idCandidate)
                ->with('success', 'Achievement created successfully.');
        }
        elseif(!$user->presidentCandidates()->exists()){
            $idCandidate = $user->vicePresidentCandidates[0]->id;
            return redirect()->route('vice-president-candidate.show', $idCandidate)
            ->with('success', 'Achievement created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Achievement $achievement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achievement $achievement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Achievement $achievement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Achievement $achievement)
    {
        $achievement->delete();

            return redirect()->back()
                ->with('success', 'Achievement deleted successfully.');
    }
}
