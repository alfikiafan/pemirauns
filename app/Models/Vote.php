<?php

namespace App\Models;
use App\Models\User;
use App\Models\Pemira;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['vote_date', 'selfie_picture'];

    public function user()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function pemira()
    {
        return $this->belongsTo(Pemira::class, 'pemira_id');
    }
}
