<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangBaik extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fund_id', 'current_amout',
        'payment_method',  'payment_name', 'pay_code', 'reference', 'status_pembayaran', 'snap_url', 'cara_bayar',
        'metadata',
    ];

    protected $hidden = [
        'metadata',
    ];

    public function fund()
    {
        return $this->belongsTo('App\Models\Fund');
    }
}
