<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateExperience extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'position', 'start_date', 'end_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}
