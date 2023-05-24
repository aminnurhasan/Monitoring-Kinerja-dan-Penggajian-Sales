<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'tokoName',
        'salesName',
        'quantity',
        'totalPrice'
    ];

    public function foto(){
        return $this->hasOne(Foto::class);
    }

    public function gaji(){
        return $this->belongsToMany(Gaji::class);
    }
}
