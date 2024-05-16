<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateAchievement extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'title', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}
