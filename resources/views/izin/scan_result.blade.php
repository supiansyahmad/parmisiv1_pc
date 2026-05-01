<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Izin - PA MISI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
        @if($izin->status == 1)
            <div class="mb-4">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                    <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-green-600 mb-2">IZIN VALID (DISETUJUI)</h2>
        @else
            <h2 class="text-2xl font-bold text-red-600 mb-2">IZIN TIDAK VALID</h2>
        @endif

        <div class="text-left mt-6 space-y-3 border-t pt-4">
            <p><span class="font-bold block text-gray-500 text-xs">Nama Pegawai:</span> {{ $izin->user->name }}</p>
            <p><span class="font-bold block text-gray-500 text-xs">NIP:</span> {{ $izin->user->nip }}</p>
            <p><span class="font-bold block text-gray-500 text-xs">Keperluan:</span> {{ $izin->keperluan }}</p>
            <p><span class="font-bold block text-gray-500 text-xs">Jam Izin:</span> {{ substr($izin->jam_keluar, 0, 5) }} - {{ substr($izin->jam_kembali, 0, 5) }}</p>
        </div>

        <div class="mt-8 text-xs text-gray-400">
            Terverifikasi oleh Sistem PA-MISI <br>
            Pengadilan Agama Barabai
        </div>
    </div>

</body>
</html>