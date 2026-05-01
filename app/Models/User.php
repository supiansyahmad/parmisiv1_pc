<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // (Bisa di-uncomment jika butuh verifikasi email)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',          // <-- PENTING: Tambahkan ini
        'name',
        'email',
        'password',
        'role',         // <-- Tambahkan ini
        'atasan_id',    // <-- Tambahkan ini
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi: Seorang pegawai "milik" satu atasan
    public function atasan()
    {
        return $this->belongsTo(User::class, 'atasan_id');
    }

    // Relasi: Seorang atasan "punya" banyak bawahan
    public function bawahan()
    {
        return $this->hasMany(User::class, 'atasan_id');
    }
    
    // Relasi: User punya banyak Izin
    public function izins()
    {
        return $this->hasMany(Izin::class);
    }
}