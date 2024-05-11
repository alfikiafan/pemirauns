<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CandidateProfile;
use App\Models\CandidateAchievement;
use App\Models\CandidateExperience;

class CandidateInfoController extends Controller
{
    public function show($id)
    {
        $candidate = User::findOrFail($id);
        $profile = CandidateProfile::where('id_candidate', $id)->first();
        $achievements = CandidateAchievement::where('id_candidate', $id)->get();
        $experiences = CandidateExperience::where('id_candidate', $id)->get();

        return view('candidates.info', compact('candidate', 'profile', 'achievements', 'experiences'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'biography' => 'required',
            'year' => 'required|integer',
            'vision' => 'required',
            'mission' => 'required',
        ]);

        $profile = CandidateProfile::updateOrCreate(
            ['id_candidate' => $id],
            [
                'biography' => $request->biography,
                'year' => $request->year,
                'vision' => $request->vision,
                'mission' => $request->mission,
            ]
        );

        return redirect()->route('candidates.info', $id)->with('success', 'Candidate profile updated successfully.');
    }

    public function storeAchievement(Request $request, $id)
    {
        $request->validate([
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'type' => 'required|in:competition,organizational,volunteer',
        ]);

        CandidateAchievement::create([
            'id_candidate' => $id,
            'year' => $request->year,
            'title' => $request->title,
            'type' => $request->type,
        ]);

        return redirect()->route('candidates.info', $id)->with('success', 'Achievement added successfully.');
    }

    public function updateAchievement(Request $request, $achievement_id)
    {
        $achievement = CandidateAchievement::findOrFail($achievement_id);

        $request->validate([
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'type' => 'required|in:competition,organizational,volunteer',
        ]);

        $achievement->update([
            'year' => $request->year,
            'title' => $request->title,
            'type' => $request->type,
        ]);

        return redirect()->route('candidates.info', $achievement->id_candidate)->with('success', 'Achievement updated successfully.');
    }

    public function destroyAchievement($achievement_id)
    {
        $achievement = CandidateAchievement::findOrFail($achievement_id);
        $candidate_id = $achievement->id_candidate;
        $achievement->delete();

        return redirect()->route('candidates.info', $candidate_id)->with('success', 'Achievement deleted successfully.');
    }

    public function storeExperience(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        CandidateExperience::create([
            'id_candidate' => $id,
            'description' => $request->description,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('candidates.info', $id)->with('success', 'Experience added successfully.');
    }

    public function updateExperience(Request $request, $experience_id)
    {
        $experience = CandidateExperience::findOrFail($experience_id);

        $request->validate([
            'description' => 'required',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $experience->update([
            'description' => $request->description,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('candidates.info', $experience->id_candidate)->with('success', 'Experience updated successfully.');
    }

    public function destroyExperience($experience_id)
    {
        $experience = CandidateExperience::findOrFail($experience_id);
        $candidate_id = $experience->id_candidate;
        $experience->delete();

        return redirect()->route('candidates.info', $candidate_id)->with('success', 'Experience deleted successfully.');
    }
}
