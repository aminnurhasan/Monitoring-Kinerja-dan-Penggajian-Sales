<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    public $timestamps = false;
    protected $dates = ['tanggalAwal', 'tanggalAkhir'];
    protected $fillable = [
        'user_id',
        'tokoName',
        'salesName',
        'quantity',
        'totalPrice'
    ];

    public function foto(){
        return $this->hasOne(Foto::class);
    }
}
