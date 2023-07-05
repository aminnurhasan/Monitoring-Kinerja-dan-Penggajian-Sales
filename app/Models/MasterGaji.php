<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGaji extends Model
{
    use HasFactory;

    protected $table = 'master_gaji';
    public $timestamps = false;

    protected $fillable = [
        'gapok',
        'insentifKunjungan',
        'bonusPenjualan',
        'denda',
    ];
}
