<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'faculty',
        'description',
        'start_date',
        'end_date',
    ];

    public function candidates(){
        return $this->hasMany(Candidate::class);
    }

    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Candidate::class);
    }
}
