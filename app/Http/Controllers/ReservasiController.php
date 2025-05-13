// app/Http/Controllers/ReservasiController.php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    public function create()
    {
        return view('reservasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|string',
            'asal_kota' => 'required|string',
            'periode_masuk' => 'required|date',
            'periode_keluar' => 'required|date|after_or_equal:periode_masuk',
            'lama_menginap' => 'required|integer',
            'tipe_kamar' => 'required|string',
            'nomor_kamar' => 'required|string'
        ]);

        Reservasi::create([
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'asal_kota' => $request->asal_kota,
            'periode_masuk' => $request->periode_masuk,
            'periode_keluar' => $request->periode_keluar,
            'lama_menginap' => $request->lama_menginap,
            'tipe_kamar' => $request->tipe_kamar,
            'nomor_kamar' => $request->nomor_kamar,
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim!');
    }
}
