<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gaji';
    public $timestamps = false;
    protected $casts = [
        'tglAwal' => 'date',
        'tglAkhir' => 'date',
    ];
    
    protected $fillable = [
        'user_id',
        'transaksi_id',
        'tglAwal',
        'tglAkhir',
        'totalPenjualan',
        'gaji'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
