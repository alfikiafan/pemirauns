<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['report', 'report_date', 'report_status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }
}
