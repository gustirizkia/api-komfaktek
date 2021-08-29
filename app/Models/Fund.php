<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'judul', 'goal_amount', 'deskripsi', 'status', 'thumbnail', 'current_amout', 'provinsi', 'alamat', 'kota', 'pos_kode'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function Donatur()
    {
        return $this->hasMany('App\Models\OrangBaik');
    }
}
