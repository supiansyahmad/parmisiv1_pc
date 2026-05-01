<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Izin Keluar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-4 text-gray-700 border-b pb-2">Filter Laporan</h3>

                <form action="{{ route('laporan.cetak') }}" method="POST" target="_blank">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Dari Tanggal</label>
                            <input type="date" name="tgl_awal" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Sampai Tanggal</label>
                            <input type="date" name="tgl_akhir" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-lg flex items-center">
                            <span class="mr-2">🖨</span> Cetak PDF
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>