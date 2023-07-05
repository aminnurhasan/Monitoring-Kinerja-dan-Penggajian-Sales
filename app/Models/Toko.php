<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    protected $table = 'toko';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'title',
        'alamat',
        'latitude',
        'longitude',
        'snippet',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function click()
    {
        return $this->hasOne(Click::class);
    }
}
