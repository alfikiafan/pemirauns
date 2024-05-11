<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'report', 'report_date', 'report_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
