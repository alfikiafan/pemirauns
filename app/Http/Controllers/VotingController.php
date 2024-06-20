<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Candidate;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    //
    public function index(){

        //show candidate at current election day 
        $activePemira = Election::where('start_date', '<=', now())->where('end_date', '>=', now())->first();
        $candidates = Candidate::where('election_id', $activePemira->id)->get();
        
        return view('user.vote.index', ['candidates' => $candidates]);
    }

    public function view($id){
        $candidate = Candidate::find($id);
        return view('user.vote.view', ['candidate' => $candidate]);
    }
}
