<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CandidateProfile;
use App\Models\CandidateAchievement;
use App\Models\CandidateExperience;
use App\Models\Pemira;
use App\Models\Vote;
use Auth;

class UserController extends Controller
{
    public function showPemiras()
    {
        // Menampilkan semua pemira
        $pemira = Pemira::all();
        return view('pemira.index', compact('pemira'));
    }

    public function showCandidates($pemira_id)
    {
        $pemira = Pemira::findOrFail($pemira_id);

        // Hanya kandidat dari pemira yang ditampilkan
        $candidates = User::where('role', 'candidate')
                          ->whereHas('votes', function($query) use ($pemira_id) {
                              $query->where('id_pemira', $pemira_id);
                          })
                          ->get();

        return view('candidates.index', compact('candidates', 'pemira'));
    }

    public function showCandidateProfile($id)
    {
        $candidate = User::findOrFail($id);
        $profile = CandidateProfile::where('id_candidate', $id)->first();
        $achievements = CandidateAchievement::where('id_candidate', $id)->get();
        $experiences = CandidateExperience::where('id_candidate', $id)->get();
        return view('candidates.profile', compact('candidate', 'profile', 'achievements', 'experiences'));
    }

    public function vote(Request $request)
    {
        $user = auth()->user();
        if ($user->vote_status == 'voted') {
            return redirect()->back()->with('error', 'Anda sudah melakukan pemilihan.');
        }

        $request->validate([
            'id_candidate' => 'required|exists:users,id',
            'id_pemira' => 'required|exists:pemira,id',
            'selfie_picture' => 'required|image|max:2048'
        ]);

        $pemira = Pemira::findOrFail($request->id_pemira);

        if ($user->facculty !== $pemira->facculty) {
            return redirect()->back()->with('error', 'Anda hanya bisa memilih di fakultas Anda.');
        }

        $selfiePath = $request->file('selfie_picture')->store('selfie_pictures', 'public');

        $vote = new Vote([
            'id_user' => $user->id,
            'id_candidate' => $request->id_candidate,
            'id_pemira' => $request->id_pemira,
            'vote_date' => now(),
            'selfie_picture' => $selfiePath
        ]);
        $vote->save();

        $user->vote_status = 'voted';
        $user->save();

        return redirect()->route('candidates.index', $pemira->id)->with('success', 'Pemilihan berhasil dilakukan.');
    }
}
