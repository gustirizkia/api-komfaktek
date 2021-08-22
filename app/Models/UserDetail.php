<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'image', 'alamat', 'profesi', 'tgl-lahir'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
