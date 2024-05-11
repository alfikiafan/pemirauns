<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_candidate', 'year', 'title', 'type'
    ];

    public function candidate()
    {
        return $this->belongsTo(User::class, 'id_candidate');
    }
}
