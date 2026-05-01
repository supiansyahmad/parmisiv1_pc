<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Pegawai</h2></x-slot>

    <div class="py-12"><div class="max-w-xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-6 shadow-sm rounded-lg">
        <form action="{{ route('pegawai.update', $user->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block font-bold mb-1">NIP</label>
                <input type="text" name="nip" value="{{ $user->nip }}" class="w-full border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1">Password Baru</label>
                <input type="text" name="password" class="w-full border-gray-300 rounded">
                <small class="text-gray-500">*Kosongkan jika tidak ingin mengubah password</small>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1">Role</label>
                <select name="role" class="w-full border-gray-300 rounded">
                    <option value="pegawai" {{ $user->role == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                    <option value="atasan" {{ $user->role == 'atasan' ? 'selected' : '' }}>Atasan</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1">Atasan Langsung</label>
                <select name="atasan_id" class="w-full border-gray-300 rounded">
                    <option value="">-- Pilih Atasan --</option>
                    @foreach($atasans as $atasan)
                        <option value="{{ $atasan->id }}" {{ $user->atasan_id == $atasan->id ? 'selected' : '' }}>{{ $atasan->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Data</button>
        </form>
    </div></div></div>
</x-app-layout>