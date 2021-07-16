<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTulisan extends Model
{
    use HasFactory;

    public function tulisan()
    {
        return $this->hasOne(Tulisan::class);
    }
}
