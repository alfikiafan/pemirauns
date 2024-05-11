<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role', 'name', 'nim', 'faculty','email', 'password', 'vote_status', 'student_card', 'user_photo', 'user_status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class, 'id_user');
    }

    public function informations()
    {
        return $this->hasMany(Information::class, 'id_admin');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'id_user');
    }

    public function candidateProfile()
    {
        return $this->hasOne(CandidateProfile::class, 'id_candidate');
    }

    public function candidateAchievements()
    {
        return $this->hasMany(CandidateAchievement::class, 'id_candidate');
    }

    public function candidateExperiences()
    {
        return $this->hasMany(CandidateExperience::class, 'id_candidate');
    }
}
