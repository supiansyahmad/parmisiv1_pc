<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Hakim/Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Izin Bulan Ini</div>
                    <div class="text-3xl font-bold text-gray-800 mt-2">{{ $totalIzinBulanIni }} <span class="text-sm font-normal text-gray-400">kali</span></div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Status Akun</div>
                    <div class="text-lg font-bold text-green-600 mt-2">Aktif</div>
                </div>
            </div>
            
            <div class="mb-6 text-center">
                <a href="{{ route('izin.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg">
                    + Buat Izin Keluar
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Riwayat Izin Saya</h3>
                    
                    <table class="min-w-full border-collapse block md:table">
                        <thead class="block md:table-header-group">
                            <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-left block md:table-cell">Tanggal</th>
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-left block md:table-cell">Jam</th>
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-left block md:table-cell">Keperluan</th>
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-center block md:table-cell">Status</th>
                                <th class="bg-gray-100 p-2 text-gray-900 font-bold md:border md:border-grey-500 text-center block md:table-cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @forelse($izinSaya as $izin)
                            <tr class="bg-white border border-grey-500 md:border-none block md:table-row hover:bg-gray-50">
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $izin->tanggal }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                    {{ substr($izin->jam_keluar, 0, 5) }} - {{ substr($izin->jam_kembali, 0, 5) }}
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">{{ $izin->keperluan }}</td>
                                <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">
                                    @if($izin->status == 0)
                                        <span class="text-yellow-500 font-bold" title="Menunggu">⏳ Menunggu</span>
                                    @elseif($izin->status == 1)
                                        <span class="text-green-600 font-bold" title="Disetujui">✅ Disetujui</span>
                                    @else
                                        <span class="text-red-600 font-bold" title="Ditolak">❌ Ditolak</span>
                                        <div class="text-xs text-red-500">Ket: {{ $izin->keterangan_tolak }}</div>
                                    @endif
                                </td>
                                <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">
    
                                    @if($izin->status == 1)
                                        <a href="{{ route('izin.cetak', $izin->id) }}" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-xs mr-1 inline-block" target="_blank">
                                            🖨 PDF
                                        </a>
        
                                        @if($izin->status_kembali == 0)
                                            <form action="{{ route('izin.kembali', $izin->id) }}" method="POST" class="inline-block">
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

                                    @elseif($izin->status == 0)
                                        <form action="{{ route('izin.destroy', $izin->id) }}" method="POST" class="inline-block">
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
                                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data izin.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>