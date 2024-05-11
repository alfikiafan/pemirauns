<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'id_candidate', 'id_pemira', 'vote_date', 'selfie_picture'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'id_candidate');
    }

    public function pemira()
    {
        return $this->belongsTo(Pemira::class, 'id_pemira');
    }
}
