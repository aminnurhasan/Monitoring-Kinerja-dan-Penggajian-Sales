<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    use HasFactory;

    protected $table = 'click';
    protected $fillable = [
        'toko_id',
        'klikAktif',
        'klikNonaktif',
        'bulan'
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
