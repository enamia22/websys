<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_and_time',
        'teacher',
        'subject',
        'info',
        'link',
        'type',
        ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
