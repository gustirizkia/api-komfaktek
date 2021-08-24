<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'event_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function acara()
    {
        return $this->belongsTo('App\Models\Event');
    }
}
