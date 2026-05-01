<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'nip' => 'admin123',
            'name' => 'Administrator',
            'email' => 'admin@pabarabai.go.id',
            'password' => Hash::make('password'), // Passwordnya: password
            'role' => 'admin',
        ]);

        // 2. Buat Akun Atasan (Misal: Ketua Pengadilan)
        $atasan = User::create([
            'nip' => '19700101',
            'name' => 'Bapak Ketua',
            'email' => 'ketua@pabarabai.go.id',
            'password' => Hash::make('password'),
            'role' => 'atasan',
        ]);

        // 3. Buat Akun Pegawai (Bawahannya Pak Ketua)
        User::create([
            'nip' => '19900101',
            'name' => 'Pegawai Teladan',
            'email' => 'pegawai@pabarabai.go.id',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
            'atasan_id' => $atasan->id, // PENTING: Relasi ke ID atasan di atas
        ]);
    }
}