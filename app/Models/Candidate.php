<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'president_candidate_id',
        'vice_president_candidate_id',
        'election_id',
        'video',
        'vision',
        'mission'
    ];

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function presidentCandidate(){
        return $this->belongsTo(PresidentCandidate::class);
    }
    public function vicePresidentCandidate(){
        return $this->belongsTo(VicePresidentCandidate::class);
    }

    public function election(){
        return $this->belongsTo(Election::class);
    }
}
