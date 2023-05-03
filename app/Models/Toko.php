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
        'users_id',
        'title',
        'alamat',
        'latitude',
        'longitude',
        'snippet',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}