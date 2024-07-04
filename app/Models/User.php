<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'nim', 'faculty', 'status', 'student_card', 'user_photo', 'batch'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function vicePresidentCandidates()
    {
        return $this->hasMany(VicePresidentCandidate::class);
    }

    public function presidentCandidates()
    {
        return $this->hasMany(PresidentCandidate::class);
    }

    public function information()
    {
        return $this->hasMany(Information::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function achievement()
    {
        return $this->hasMany(Achievement::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }


}
