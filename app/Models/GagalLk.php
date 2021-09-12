<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GagalLk extends Model
{
    use HasFactory;

    protected $fillable = [
        'daftar_lk_id', 'pesan'
    ];

    public function daftarLk()
    {
        return $this->belongsTo('App\Models\DaftarLk');
    }
}
