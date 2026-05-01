<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi secara massal
    protected $guarded = [];

    // Relasi: Satu data Izin "milik" satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}