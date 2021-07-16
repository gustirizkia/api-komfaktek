<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarLk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'status_pembayaran', 'nama', 'image_pribadi', 'image_ktm', 'semester', 'alamat', 'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
