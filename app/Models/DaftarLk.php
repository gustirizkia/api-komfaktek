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

    protected $appends = [
        'dateLk'
    ];

    public function getDateLkAttribute()
    {
        $a = $this->created_at->format('Y-m-d H:i:s');

        return $a;
    }

    public function rekening()
    {
        return $this->belongsTo('App\Rekening');
    }

    public function gagalLk()
    {
        return $this->hasOne('App\Models\GagalLk');
    }
}
