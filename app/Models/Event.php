<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'image', 'mulai', 'deskripsi', 'harga', 'kategori_id'
    ];

    public function pemateri()
    {
        return $this->hasMany('App\Models\Pemateri');
    }

    public function moderator()
    {
        return $this->hasMany('App\Models\Moderator');
    }

    public function joinEvent()
    {
        return $this->hasMany('App\Models\JoinEvent');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
