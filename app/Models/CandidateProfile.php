<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_candidate', 'biography', 'year', 'vision', 'mission'
    ];

    public function candidate()
    {
        return $this->belongsTo(User::class, 'id_candidate');
    }
}
