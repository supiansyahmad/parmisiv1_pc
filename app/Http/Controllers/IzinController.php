<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    // Menampilkan Form 
    public function create()
    {
        return view('izin.create');
    }

    // Menyimpan Data ke Database
    public function store(Request $request)
    {
        $request->validate([
            'jam_keluar' => 'required',
            // Jam kembali harus SETELAH jam keluar
            'jam_kembali' => 'required|after:jam_keluar', 
            // Tanggal tidak boleh masa lalu (opsional)
            'tanggal'     => 'required|date|after_or_equal:today', 
            'keperluan'  => 'required',
        ], [
            // Pesan Error Bahasa Indonesia
            'jam_kembali.after' => 'Jam kembali tidak boleh lebih awal dari jam keluar!',
            'tanggal.after_or_equal' => 'Tidak boleh mengajukan izin untuk tanggal yang sudah lewat.',
        ]);

        $user = Auth::user();
        
        // LOGIKA OTOMATIS SETUJU UNTUK KETUA
        // Jika user tidak punya atasan (atasan_id kosong), status langsung 1 (Disetujui)
        // Jika punya atasan, status 0 (Menunggu)
        $statusAwal = ($user->atasan_id == null) ? 1 : 0;

        Izin::create([
            'user_id' => Auth::id(),
            'tanggal' => now()->toDateString(), // Default tanggal hari ini 
            'jam_keluar' => $request->jam_keluar,
            'jam_kembali' => $request->jam_kembali,
            'keperluan' => $request->keperluan,
            'status' => $statusAwal, // <-- Menggunakan variabel logika di atas 
        ]);

        return redirect()->route('dashboard')->with('success', 'Izin berhasil diajukan!');
    }

    // Aksi Menyetujui Izin
    public function setuju($id)
    {
        // Cari data izin, pastikan yang dicari adalah izin bawahan yang login
        $izin = Izin::findOrFail($id);
        
        // Update status jadi 1 (Disetujui)
        $izin->update(['status' => 1]);

        return redirect()->back()->with('success', 'Izin berhasil disetujui.');
    }

    // Aksi Menolak Izin
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan_tolak' => 'required'
        ]);

        $izin = Izin::findOrFail($id);
        
        // Update status jadi 2 (Ditolak) dan simpan alasannya
        $izin->update([
            'status' => 2,
            'keterangan_tolak' => $request->alasan_tolak
        ]);

        return redirect()->back()->with('success', 'Izin telah ditolak.');
    }

    public function landing()
    {
        // Ambil data izin HARI INI
        // Syarat: Status BUKAN Ditolak (2) DAN Belum Kembali (0)
        // Jadi yang muncul: Pending (0) dan Disetujui (1) yang masih di luar.
        $sedangIzin = Izin::with('user')
            ->whereDate('tanggal', now())
            ->where('status', '!=', 2)   // Kecuali yang ditolak
            ->where('status_kembali', 0) // Kecuali yang sudah kembali
            ->orderBy('status', 'desc')  // Urutkan: Yang disetujui (1) diatas, yang pending (0) dibawah
            ->orderBy('jam_keluar', 'desc')
            ->get();

        return view('landing', compact('sedangIzin'));
    }

    // Import class PDF dan QrCode di bagian paling ATAS file controller ini nanti
    // Tapi kita pakai cara cepat dengan memanggil namespace lengkap di dalam fungsi

    public function cetak($id)
    {
        $izin = Izin::findOrFail($id);

        // Hanya boleh cetak jika status disetujui (1)
        if ($izin->status != 1) {
            return redirect()->back()->with('error', 'Izin belum disetujui!');
        }

        // Generate QR Code berisi URL Validasi
        // Kita gunakan format SVG base64 agar ringan di PDF
        $urlValidasi = route('izin.scan', $izin->id);
        $qrcode = base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(100)->generate($urlValidasi));

        // Load tampilan PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('izin.surat_pdf', compact('izin', 'qrcode'));
        
        // Download file
        return $pdf->download('Surat_Izin_'.$izin->user->nip.'.pdf');
    }

    public function scan($id)
    {
        // Halaman publik untuk cek keaslian surat
        $izin = Izin::with('user')->findOrFail($id);
        return view('izin.scan_result', compact('izin'));
    }
    
    public function kembali($id)
    {
        $izin = Izin::findOrFail($id);
        
        $izin->update([
            'status_kembali' => 1,
            'jam_kembali_realisasi' => now()->format('H:i:s'), // <-- TAMBAHAN INI
        ]);
        
        return redirect()->back()->with('success', 'Selamat datang kembali di kantor!');
    }
    
    // Membatalkan (Menghapus) Izin
    public function destroy($id)
    {
        $izin = Izin::findOrFail($id);

        // Validasi Keamanan: Hanya boleh hapus jika status masih Menunggu (0)
        // Dan pastikan yang menghapus adalah pemilik izin itu sendiri
        if ($izin->status == 0 && $izin->user_id == auth()->id()) {
            $izin->delete();
            return redirect()->back()->with('success', 'Permohonan izin berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Gagal membatalkan. Izin sudah diproses atau bukan milik Anda.');
    }
}