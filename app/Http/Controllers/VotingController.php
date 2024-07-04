<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VotingController extends Controller
{
    public function index(){
        $activePemira = Election::where('start_date', '<=', now())
                                ->where('end_date', '>=', now())
                                ->first();
        if(!$activePemira){
            return redirect()->route('user.dashboard')->with('error', 'Tidak ada Pemira yang sedang berlangsung.');
        }
        
        $candidates = Candidate::where('election_id', $activePemira->id)->get();

        if(sizeof($candidates) < 1){
            return redirect()->route('user.dashboard')->with('error', 'Tidak ada Kandidat dalam Pemira ini.');
        }
        
        return view('user.vote.index', ['candidates' => $candidates]);
    }

    public function view($id){
        $candidate = Candidate::find($id);
        return view('user.vote.view', ['candidate' => $candidate]);
    }

    public function selfie($candidate_id){
        $candidate = Candidate::find($candidate_id);
        return view('user.vote.selfie', ['candidate' => $candidate]);
    }

    public function vote(Request $request){
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'user_photo_data' => 'required'
        ]);

        // Check if the user has already voted
        $existingVote = Vote::where('user_id', Auth::id())
                            ->whereHas('candidate', function ($query) {
                                $query->where('election_id', function ($subQuery) {
                                    $subQuery->select('id')
                                             ->from('elections')
                                             ->where('start_date', '<=', now())
                                             ->where('end_date', '>=', now())
                                             ->limit(1);
                                });
                            })
                            ->first();

        if ($existingVote) {
            return redirect()->route('user.vote')->with('error', 'You have already voted.');
        }
        
        $userPhotosPath = public_path('images/user_votes');

        if (!File::exists($userPhotosPath)) {
            File::makeDirectory($userPhotosPath, 0755, true);
        }
        $userPhotoData = $request->input('user_photo_data');
        $userPhoto = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $userPhotoData));
        $userPhotoFilename = uniqid() . '.jpg';
        $userPhotoFullPath = $userPhotosPath . '/' . $userPhotoFilename;
        File::put($userPhotoFullPath, $userPhoto);
        $userPhotoPath = 'images/user_votes/' . $userPhotoFilename;
        
        $vote = new Vote();
        $vote->user_id = Auth::id();
        $vote->candidate_id = $request->candidate_id;
        $vote->photo = $userPhotoPath;
        $vote->date = now();
        $vote->save();

        return redirect()->route('user.vote')->with('success', 'Your vote has been cast successfully.');
    }
}