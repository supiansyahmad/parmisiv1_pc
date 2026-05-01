<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <h3 class="text-lg font-bold mb-4">Selamat Datang, Administrator!</h3>
                <p class="mb-6">Silakan kelola data pegawai atau cetak laporan melalui menu di bawah ini.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('pegawai.index') }}" class="block p-6 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                        <h4 class="font-bold text-blue-800 text-xl mb-2">👥 Data Pegawai</h4>
                        <p class="text-gray-600">Tambah, Edit, dan Hapus akun pegawai serta atur hierarki atasan.</p>
                    </a>

                    <a href="{{ route('laporan.index') }}" class="block p-6 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition">
                        <h4 class="font-bold text-green-800 text-xl mb-2">📊 Laporan Izin</h4>
                        <p class="text-gray-600">Rekapitulasi izin harian dan bulanan.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>