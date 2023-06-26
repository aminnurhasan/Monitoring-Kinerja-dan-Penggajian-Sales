<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gaji';
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'gajiPokok',
        'intensifKunjungan',
        'bonusPenjualan',
        'gajiTotal',
        'bulan',
        'tahun'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
