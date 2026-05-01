<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique(); // NIP sebagai username login
            $table->string('name'); // Nama Pegawai
            $table->string('email')->nullable(); // Opsional, buat notifikasi saja
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            // Level user: 'admin', 'atasan', 'pegawai'
            $table->enum('role', ['admin', 'atasan', 'pegawai'])->default('pegawai');
            
            // Relasi ke tabel users sendiri untuk menyimpan siapa atasannya
            // Jika dia Admin atau Kepala Dinas tertinggi, atasan_id bisa kosong (nullable)
            $table->unsignedBigInteger('atasan_id')->nullable();
            
            $table->rememberToken();
            $table->timestamps();

            // Membuat relasi foreign key (optional tapi bagus untuk integritas data)
            $table->foreign('atasan_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};