<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formulirPendaftaranController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'jenis_kelamin'    => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'no_hp'            => 'required|string|min:10|max:15',
            'asalkota'         => 'required|string|max:100',
            'periode_masuk'    => 'required|date',
            'periode_keluar'    => 'required|date',
            'lama_menginap'    => 'required|string',
            'lama_menginap'    => 'required|string',
            'tipe_kamar'    => 'required|string', 
            'agreement'        => 'accepted',
        ]);

        // Simpan data ke database atau proses lainnya
        // Contoh:
        // Pendaftaran::create($validated);

        return back()->with('success', 'Pendaftaran berhasil dikirim!');
    }
}
