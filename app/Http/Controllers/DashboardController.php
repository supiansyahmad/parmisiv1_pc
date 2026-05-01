<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Izin;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // --- LOGIKA UMUM (SEMUA USER) ---
        // Hitung total izin saya bulan ini
        $totalIzinBulanIni = Izin::where('user_id', $user->id)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->where('status', 1) // Hanya yang disetujui
            ->count();

        $izinSaya = Izin::where('user_id', $user->id)->orderBy('tanggal', 'desc')->get();

        // --- LOGIKA KHUSUS ADMIN ---
        if ($user->role === 'admin') {
            $pegawais = User::where('role', '!=', 'admin')->get();
            // Hitung total pegawai
            $totalPegawai = User::where('role', '!=', 'admin')->count();
            // Hitung izin hari ini (seluruh kantor)
            $izinHariIni = Izin::whereDate('tanggal', now())->count();

            return view('dashboard.admin', compact('pegawais', 'totalPegawai', 'izinHariIni'));
        }

        // --- LOGIKA KHUSUS ATASAN ---
        if ($user->role === 'atasan') {
            $izinBawahan = Izin::whereHas('user', function($q) use ($user) {
                $q->where('atasan_id', $user->id);
            })->where('status', 0)->get();

            // Hitung jumlah yang PERLU DISETUJUI (Penting untuk Notifikasi)
            $perluPersetujuan = $izinBawahan->count();

            return view('dashboard.atasan', compact('izinSaya', 'izinBawahan', 'totalIzinBulanIni', 'perluPersetujuan'));
        }

        // --- LOGIKA PEGAWAI BIASA ---
        return view('dashboard.pegawai', compact('izinSaya', 'totalIzinBulanIni'));
    }
}