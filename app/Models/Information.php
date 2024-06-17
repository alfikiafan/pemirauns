<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'publish_date',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'publish_date' => 'datetime'
    ];
}
