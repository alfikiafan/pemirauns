<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_admin', 'title', 'content', 'publish_date'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
