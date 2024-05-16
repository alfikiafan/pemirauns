<?php

namespace App\Models;
use App\Models\Report;
use App\Models\Information;
use App\Models\Vote;
use App\Models\CandidateProfile;
use App\Models\CandidateAchievement;
use App\Models\CandidateExperience;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'nim', 'faculty', 'vote_status', 'student_card', 'user_photo', 'user_status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function informations()
    {
        return $this->hasMany(Information::class, 'admin_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'voter_id');
    }

    public function candidateProfile()
    {
        return $this->hasOne(CandidateProfile::class, 'candidate_id');
    }

    public function candidateAchievements()
    {
        return $this->hasMany(CandidateAchievement::class, 'candidate_id');
    }

    public function candidateExperiences()
    {
        return $this->hasMany(CandidateExperience::class, 'candidate_id');
    }
}
