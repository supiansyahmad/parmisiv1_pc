<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    // Menampilkan daftar pegawai
    public function index()
    {
        // Ambil semua data user, urutkan berdasarkan nama
        $pegawais = User::orderBy('name', 'asc')->get();
        return view('admin.pegawai.index', compact('pegawais'));
    }

    // Menampilkan form tambah pegawai
    public function create()
    {
        // Kita butuh daftar atasan untuk dipilih di form
        $atasans = User::whereIn('role', ['atasan', 'admin'])->get();
        return view('admin.pegawai.create', compact('atasans'));
    }

    // Menyimpan pegawai baru
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:users',
            'name' => 'required',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email, // Opsional
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'atasan_id' => $request->atasan_id,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $atasans = User::whereIn('role', ['atasan', 'admin'])->get();
        return view('admin.pegawai.edit', compact('user', 'atasans'));
    }

    // Mengupdate data pegawai
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'nip' => 'required|unique:users,nip,'.$user->id, // Abaikan NIP sendiri saat cek unique
            'name' => 'required',
            'role' => 'required',
        ]);

        $data = [
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'atasan_id' => $request->atasan_id,
        ];

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai diperbarui');
    }

    // Menghapus pegawai
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Pegawai berhasil dihapus');
    }
}