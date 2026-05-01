<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tambah Pegawai</h2></x-slot>

    <div class="py-12"><div class="max-w-xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 shadow-sm rounded-lg">
        <form action="{{ route('pegawai.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-bold mb-1">NIP (Username)</label>
                <input type="text" name="nip" class="w-full border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1">Password</label>
                <input type="text" name="password" class="w-full border-gray-300 rounded" required value="123456">
                <small class="text-gray-500">Default: 123456</small>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1">Role / Jabatan</label>
                <select name="role" class="w-full border-gray-300 rounded">
                    <option value="pegawai">Pegawai Biasa</option>
                    <option value="atasan">Atasan (Pejabat)</option>
                    <option value="admin">Admin / Operator</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1">Atasan Langsung</label>
                <select name="atasan_id" class="w-full border-gray-300 rounded">
                    <option value="">-- Pilih Atasan --</option>
                    @foreach($atasans as $atasan)
                        <option value="{{ $atasan->id }}">{{ $atasan->name }}</option>
                    @endforeach
                </select>
                <small class="text-gray-500">*Kosongkan jika dia adalah Admin atau Kepala Tertinggi</small>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Pegawai</button>
        </form>
    </div></div></div>
</x-app-layout>