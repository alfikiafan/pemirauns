<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresidentCandidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'biography'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function candidates(){
        return $this->hasMany(Candidate::class);
    }
}
