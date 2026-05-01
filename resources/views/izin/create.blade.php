<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Permohonan Izin') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('izin.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="tanggal" :value="__('Tanggal Izin')" />
                            <x-text-input id="tanggal" class="block mt-1 w-full bg-gray-100" type="text" name="tanggal" :value="date('Y-m-d')" readonly />
                            <p class="text-sm text-gray-500 mt-1">*Tanggal otomatis terisi hari ini</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="jam_keluar" :value="__('Jam Keluar')" />
                                <x-text-input id="jam_keluar" class="timepicker block mt-1 w-full" type="text" name="jam_keluar" required placeholder="Pilih jam..." />
                                <x-input-error :messages="$errors->get('jam_keluar')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="jam_kembali" :value="__('Rencana Jam Kembali')" />
                                <x-text-input id="jam_kembali" class="timepicker block mt-1 w-full" type="text" name="jam_kembali" required placeholder="Pilih jam..." />
                                <x-input-error :messages="$errors->get('jam_kembali')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="keperluan" :value="__('Keperluan')" />
                            <textarea id="keperluan" name="keperluan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required placeholder="Contoh: Mengantar berkas ke KPPN..."></textarea>
                            <x-input-error :messages="$errors->get('keperluan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-3">
                            <a href="{{ route('dashboard') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-200">
                                Batal
                            </a>
                            
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-200">
                                Ajukan Izin
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Cari semua input dengan class 'timepicker' dan ubah jadi jam 24 format
        flatpickr(".timepicker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i", // Format 24 Jam (Contoh: 14:30)
            time_24hr: true,   // Wajib true agar tidak ada AM/PM
            minuteIncrement: 5 // Menit kelipatan 5 biar rapi (opsional)
        });
    </script>

</x-app-layout>