<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel akun
        $dataAkun = User::all();

        // Mengirim data ke view dashboard
        return view('akun.index', compact('dataAkun'));
    }

    public function create()
    {
        return view('akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'level' => 'required|in:admin,marketing',
        ]);
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('Bieplus123'), // password default
            'level' => $request->level,
        ]);
        

        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $akun = User::findOrFail($id);
        return view('akun.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        $akun = User::findOrFail($id);

        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $akun->id,
            'level' => 'required|in:admin,marketing',
        ]);

        $akun->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'level' => $request->level,
        ]);

        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $akun = User::findOrFail($id);
        $akun->delete();

        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus!');
    }

    // ===== Form Ganti Password =====

    public function formGantiPassword($id)
    {
        $akun = User::findOrFail($id);
        return view('akun.ganti-password', compact('akun'));
    }

    public function gantiPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $akun = User::findOrFail($id);
        $akun->password = Hash::make($request->password);
        $akun->save();

        return redirect()->route('akun.index')->with('success', 'Password berhasil diubah!');
    }
}
