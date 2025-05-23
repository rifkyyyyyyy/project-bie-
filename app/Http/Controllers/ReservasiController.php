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

    $periode_keluar = Carbon::parse($request->periode_masuk)
        ->addDays((int) $request->lama_menginap)
        ->setTime(23, 59, 59);

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

    // 🔁 Recalculate kolom `terisi` untuk kamar tersebut
    $this->updateTerisiKamar($request->kamar_id);

    return redirect()->back()->with('success', 'Reservasi berhasil dikirim!');
}


    private function updateTerisiKamar($kamarId)
{
    $today = Carbon::today()->toDateString();

    // Ambil semua reservasi aktif hari ini untuk kamar tersebut
    $aktifHariIni = Reservasi::where('kamar_id', $kamarId)
        ->whereDate('periode_masuk', '<=', $today)
        ->whereDate('periode_keluar', '>=', $today)
        ->count();

    // Update kolom `terisi`
    $kamar = Kamar::find($kamarId);
    $kamar->terisi = $aktifHariIni;
    $kamar->save();
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

public function calendarView()
{
    $startDate = Carbon::today();
    $endDate = Carbon::today()->addDays(13);

    $reservasis = Reservasi::with('kamar')
        ->where(function($q) use ($startDate, $endDate) {
            $q->whereBetween('periode_masuk', [$startDate, $endDate])
              ->orWhereBetween('periode_keluar', [$startDate, $endDate]);
        })
        ->get();

    $kamarIdsTerisi = $reservasis->pluck('kamar_id')->unique();

    $kamars = Kamar::whereIn('id', $kamarIdsTerisi)
                   ->orderBy('tipe_kamar')
                   ->orderBy('nomor_kamar')
                   ->get()
                   ->groupBy('tipe_kamar');

    return view('calendar', compact('kamars', 'reservasis', 'startDate', 'endDate'));
}

public function table(Request $request)
{
    $filter = $request->get('filter');
    $status = $request->get('status');
    $today = Carbon::today();
    $query = Reservasi::with('kamar');

    // Filter tanggal
    if ($filter === 'today') {
        $query->whereDate('periode_masuk', $today);
    } elseif ($filter === 'last7days') {
        $query->whereBetween('periode_masuk', [$today->copy()->subDays(6), $today]);
    }

    // Filter status
    if ($status === 'masih_menginap') {
        $query->whereDate('periode_keluar', '>=', $today);
    } elseif ($status === 'sudah_keluar') {
        $query->whereDate('periode_keluar', '<', $today);
    }

    $reservasi = $query->get();

    return view('table', compact('reservasi', 'filter', 'status'));
}


}