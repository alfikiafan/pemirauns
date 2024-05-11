<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemira extends Model
{
    use HasFactory;

    protected $fillable = [
        'facculty', 'year', 'information', 'start_date', 'end_date'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class, 'id_pemira');
    }
}
