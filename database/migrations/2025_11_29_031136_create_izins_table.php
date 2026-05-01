<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke pegawai yg izin
            
            $table->date('tanggal'); // Tanggal izin
            $table->time('jam_keluar'); // Rencana jam keluar
            $table->time('jam_kembali'); // Rencana jam kembali
            $table->string('keperluan'); // Alasan izin
            
            // Status: 0=Menunggu, 1=Disetujui, 2=Ditolak
            $table->tinyInteger('status')->default(0); 
            
            // Keterangan jika ditolak atasan
            $table->text('keterangan_tolak')->nullable();
            
            // Cek apakah sudah kembali ke kantor? 0=Belum, 1=Sudah
            $table->boolean('status_kembali')->default(0);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('izins');
    }
};