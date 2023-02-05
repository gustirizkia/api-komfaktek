<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tulisan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'judul', 'image', 'teks', 'kategori_tulisan_id'
    ];
    
    protected $casts = [
        'created_at' => 'datetime:d M Y',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->hasOne(KategoriTulisan::class, 'id', 'kategori_tulisan_id');
    }
}
