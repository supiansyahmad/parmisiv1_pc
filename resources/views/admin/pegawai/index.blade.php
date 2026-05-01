<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Manajemen Data Pegawai</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 text-right">
                <a href="{{ route('pegawai.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow">+ Tambah Pegawai Baru</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr class="bg-gray-100 block md:table-row">
                            <th class="p-2 text-left block md:table-cell">NIP</th>
                            <th class="p-2 text-left block md:table-cell">Nama</th>
                            <th class="p-2 text-left block md:table-cell">Jabatan (Role)</th>
                            <th class="p-2 text-left block md:table-cell">Atasan Langsung</th>
                            <th class="p-2 text-center block md:table-cell">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group">
                        @foreach($pegawais as $p)
                        <tr class="border-b block md:table-row hover:bg-gray-50">
                            <td class="p-2 block md:table-cell">{{ $p->nip }}</td>
                            <td class="p-2 block md:table-cell font-bold">{{ $p->name }}</td>
                            <td class="p-2 block md:table-cell uppercase text-xs">
                                <span class="bg-gray-200 px-2 py-1 rounded">{{ $p->role }}</span>
                            </td>
                            <td class="p-2 block md:table-cell">{{ $p->atasan ? $p->atasan->name : '-' }}</td>
                            <td class="p-2 block md:table-cell text-center">
                                <a href="{{ route('pegawai.edit', $p->id) }}" class="text-yellow-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST" class="inline">
                                    @csrf 
                                    @method('DELETE')
    
                                    <button type="button" class="text-red-600 hover:text-red-800 font-bold" onclick="
                                        Swal.fire({
                                            title: 'Hapus Data Pegawai?',
                                            text: 'Data yang dihapus tidak dapat dikembalikan!',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Ya, Hapus!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                this.closest('form').submit();
                                            }
                                        });
                                    ">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>