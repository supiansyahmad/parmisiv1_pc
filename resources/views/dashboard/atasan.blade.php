<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pejabat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Menunggu Persetujuan</div>
                    <div class="flex items-baseline">
                        <div class="text-3xl font-bold text-gray-800 mt-2">{{ $perluPersetujuan }}</div>
                        @if($perluPersetujuan > 0)
                            <span class="ml-2 text-xs text-red-500 font-bold animate-pulse">Butuh Respon!</span>
                        @endif
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Izin Saya (Bulan Ini)</div>
                    <div class="text-3xl font-bold text-gray-800 mt-2">{{ $totalIzinBulanIni }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Tanggal Hari Ini</div>
                    <div class="text-xl font-bold text-gray-800 mt-2">{{ date('d M Y') }}</div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-blue-800">Permohonan Izin Menunggu Persetujuan</h3>
                    
                    @if($izinBawahan->isEmpty())
                        <p class="text-gray-500 italic">Tidak ada permohonan izin baru dari bawahan.</p>
                    @else
                        <table class="min-w-full border-collapse block md:table">
                            <thead class="block md:table-header-group">
                                <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative">
                                    <th class="bg-gray-100 p-2 text-gray-900 font-bold text-left block md:table-cell">Nama Pegawai</th>
                                    <th class="bg-gray-100 p-2 text-gray-900 font-bold text-left block md:table-cell">Tanggal & Jam</th>
                                    <th class="bg-gray-100 p-2 text-gray-900 font-bold text-left block md:table-cell">Keperluan</th>
                                    <th class="bg-gray-100 p-2 text-gray-900 font-bold text-center block md:table-cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="block md:table-row-group">
                                @foreach($izinBawahan as $izin)
                                <tr class="bg-white border border-grey-500 md:border-none block md:table-row hover:bg-gray-50">
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell font-bold">
                                        {{ $izin->user->name }} <br>
                                        <span class="text-xs text-gray-500">NIP: {{ $izin->user->nip }}</span>
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        {{ $izin->tanggal }} <br>
                                        <span class="text-xs bg-gray-200 px-2 rounded">{{ substr($izin->jam_keluar, 0, 5) }} - {{ substr($izin->jam_kembali, 0, 5) }}</span>
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $izin->keperluan }}</td>
                                    <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">
                                        <div class="flex justify-center space-x-2">
        
                                            <form action="{{ route('izin.setuju', $izin->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded shadow transition transform hover:scale-105" 
                                                    onclick="event.preventDefault();
                                                            Swal.fire({
                                                                title: 'Setujui Izin?',
                                                                text: 'Pastikan data permohonan sudah benar.',
                                                                icon: 'question',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#10b981',
                                                                cancelButtonColor: '#6b7280',
                                                                confirmButtonText: 'Ya, Setujui!',
                                                                cancelButtonText: 'Batal'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    this.closest('form').submit();
                                                                }
                                                            });">
                                                    ✅
                                                </button>
                                            </form>

                                            <button type="button" onclick="tolakIzin({{ $izin->id }}, '{{ $izin->user->name }}')" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded shadow transition transform hover:scale-105">
                                                ❌
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                                
                                <form id="form-tolak-{{ $izin->id }}" action="{{ route('izin.tolak', $izin->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="alasan_tolak" id="input-alasan-{{ $izin->id }}">
                                </form>

                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Riwayat Izin Saya</h3>
                    
                    <div class="mb-6 text-center">
                        <a href="{{ route('izin.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-lg transition duration-200">
                            + Buat Izin Keluar
                        </a>
                    </div>
                    
                    <table class="min-w-full border-collapse block md:table">
                        <thead class="block md:table-header-group">
                            <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative">
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-left block md:table-cell">Tanggal</th>
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-left block md:table-cell">Jam</th>
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-left block md:table-cell">Keperluan</th>
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-center block md:table-cell">Status</th>
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-center block md:table-cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @forelse($izinSaya as $history)
                            <tr class="bg-white border border-grey-500 md:border-none block md:table-row hover:bg-gray-50">
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $history->tanggal }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    {{ substr($history->jam_keluar, 0, 5) }} - {{ substr($history->jam_kembali, 0, 5) }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $history->keperluan }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">
                                    @if($history->status == 0)
                                        <span class="text-yellow-500 font-bold">⏳ Menunggu</span>
                                    @elseif($history->status == 1)
                                        <span class="text-green-600 font-bold">✅ Disetujui</span>
                                    @else
                                        <span class="text-red-600 font-bold">❌ Ditolak</span>
                                        <div class="text-xs text-red-500">Ket: {{ $history->keterangan_tolak }}</div>
                                    @endif
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">
    
                                    @if($history->status == 1)
                                        <a href="{{ route('izin.cetak', $history->id) }}" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-xs mr-1 inline-block" target="_blank">
                                            🖨 PDF
                                        </a>
        
                                        @if($history->status_kembali == 0)
                                            <form action="{{ route('izin.kembali', $history->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs" onclick="event.preventDefault();
                                                    Swal.fire({
                                                        title: 'Konfirmasi',
                                                        text: 'Anda yakin sudah kembali ke kantor?',
                                                        icon: 'question',
                                                        showCancelButton: true,
                                                        confirmButtonText: 'Ya, Kembali',
                                                        cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) this.closest('form').submit();
                                                    });">
                                                    Kembali
                                                </button>
                                            </form>
                                        @else
                                            <span class="bg-gray-200 text-gray-600 px-2 py-1 rounded text-xs">Sudah Kembali</span>
                                        @endif

                                    @elseif($history->status == 0)
                                        <form action="{{ route('izin.destroy', $history->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
            
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow transition duration-200" onclick="event.preventDefault();
                                                Swal.fire({
                                                    title: 'Batalkan Permohonan?',
                                                    text: 'Data izin ini akan dihapus permanen.',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Ya, Batalkan!',
                                                    cancelButtonText: 'Tidak'
                                                }).then((result) => {
                                                    if (result.isConfirmed) this.closest('form').submit();
                                                });">
                                                🗑 Batalkan
                                            </button>
                                        </form>

                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500 italic">Belum ada riwayat izin.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($izinBawahan as $izin)
    <form id="form-tolak-{{ $izin->id }}" action="{{ route('izin.tolak', $izin->id) }}" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
        <input type="hidden" name="alasan_tolak" id="input-alasan-{{ $izin->id }}">
    </form>
    @endforeach

    <script>
        function tolakIzin(id, nama) {
            Swal.fire({
                title: 'Tolak Izin?',
                text: `Berikan alasan penolakan untuk pegawai: ${nama}`,
                icon: 'warning',
                input: 'textarea', // Memunculkan input area di dalam popup
                inputPlaceholder: 'Tulis alasan penolakan di sini...',
                inputAttributes: {
                    'aria-label': 'Tulis alasan penolakan'
                },
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Tolak Izin',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Anda wajib menuliskan alasannya!' // Validasi jika kosong
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Masukkan teks dari popup ke dalam form tersembunyi
                    document.getElementById('input-alasan-' + id).value = result.value;
                    // Submit form
                    document.getElementById('form-tolak-' + id).submit();
                }
            });
        }
    </script>
</x-app-layout>