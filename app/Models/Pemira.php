<?php

namespace App\Models;
use App\Models\Vote;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemira extends Model
{
    use HasFactory;

    protected $table = 'pemira';

    protected $fillable = ['faculty', 'type', 'information', 'start_datetime', 'end_datetime'];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
