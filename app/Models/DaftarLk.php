<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarLk extends Model
{
    use HasFactory;

    protected $fillable = [
        'rekening_id', 'user_id', 'nama', 'email', 'nomor_wa', 'nomor_mhs', 'prodi', 'alamat', 'tgl_lahir', 'jk', 'status', 'smstr', 'foto_diri', 'foto_ktm', 'foto_ktp', 'foto_bukti_byr'
    ];

    public function rekening()
    {
        return $this->belongsTo('App\Rekening');
    }
}
