<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Kamar;
use Carbon\Carbon;

class ReservasiController extends Controller
{
    public function create()
    {
        return view('reservasi');
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
        'lama_menginap' => 'required|integer',
        'tipe_kamar' => 'required|string',
        'kamar_id' => 'required|exists:kamars,id',
    ]);

    // Hitung periode_keluar otomatis
    $periode_keluar = Carbon::parse($request->periode_masuk)->addDays((int) $request->lama_menginap);
    
    $kamar = Kamar::findOrFail($request->kamar_id);

    Reservasi::create([
        'nama_lengkap' => $request->nama_lengkap,
        'jenis_kelamin' => $request->jenis_kelamin,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'asal_kota' => $request->asal_kota,
        'periode_masuk' => $request->periode_masuk,
        'periode_keluar' => $periode_keluar->toDateString(),
        'lama_menginap' => $request->lama_menginap,
        'tipe_kamar' => $request->tipe_kamar,
        'kamar_id' => $request->kamar_id
    ]);
    
    $kamar = Kamar::find($request->kamar_id);
    $kamar->increment('terisi');
        
    return redirect()->back()->with('success', 'Reservasi berhasil dikirim!');
    }

    public function getKamarTersedia(Request $request)
        {
            $tipe = $request->tipe_kamar;
            $gender = $request->jenis_kelamin;

            $kamars = Kamar::where('tipe_kamar', $tipe)
                ->where('jenis_kelamin', $gender)
                ->whereColumn('terisi', '<', 'kapasitas')
                ->get(['id', 'nomor_kamar']);

            return response()->json($kamars);
    }

    public function index()
{
    $reservasi = Reservasi::with('kamar')->get(); // ambil semua data + relasi kamar
    return view('data-customer', compact('reservasi'));
}

public function update(Request $request, $id)
{
    $reservasi = Reservasi::findOrFail($id);
    $reservasi->update($request->only(['nama_lengkap', 'email', 'no_hp', 'asal_kota']));
    return redirect()->back()->with('success', 'Reservasi berhasil diupdate!');
}

public function destroy($id)
{
    $reservasi = Reservasi::findOrFail($id);

    if ($reservasi->kamar) {
        $reservasi->kamar->decrement('terisi');
    }

    $reservasi->delete();

    return redirect()->back()->with('success', 'Reservasi berhasil dihapus!');
}



}