<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_candidate', 'description', 'position', 'start_date', 'end_date'
    ];

    public function candidate()
    {
        return $this->belongsTo(User::class, 'id_candidate');
    }
}
