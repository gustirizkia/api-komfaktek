<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemateri extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'nama', 'image', 'title', 'email', 'alamat'
    ];

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }
}
