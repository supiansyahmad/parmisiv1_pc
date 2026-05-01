<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // 1. Tampilkan Halaman Filter
    public function index()
    {
        return view('admin.laporan.index');
    }

    // 2. Proses Cetak PDF
    public function cetak(Request $request)
    {
        $tglAwal = $request->tgl_awal;
        $tglAkhir = $request->tgl_akhir;

        // 1. Ambil data user yang sedang login (Admin/Operator)
        $admin = auth()->user(); 

        // 2. Ambil data izin
        $izins = Izin::with('user')
                    ->whereBetween('tanggal', [$tglAwal, $tglAkhir])
                    ->where('status', 1)
                    ->orderBy('tanggal', 'asc')
                    ->get();

        // 3. Kirim variabel '$admin' ke view bersama data lainnya
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('izins', 'tglAwal', 'tglAkhir', 'admin'));
        
        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan_Izin.pdf');
    }
}