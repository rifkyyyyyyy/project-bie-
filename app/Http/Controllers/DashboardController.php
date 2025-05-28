<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Kamar;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
{
    $kamars = Kamar::orderBy('nomor_kamar')->get();
    $today = Carbon::today();

    $reservasiAktif = Reservasi::whereDate('periode_keluar', '>=', $today)
        ->get()
        ->groupBy('kamar_id');

    foreach ($kamars as $kamar) {
        $reservasiKamar = $reservasiAktif->get($kamar->id, collect());

        $jumlahPenghuni = 0;

        foreach ($reservasiKamar as $reservasi) {
            $masuk = Carbon::parse($reservasi->periode_masuk);
            $keluar = Carbon::parse($reservasi->periode_keluar);

            if ($keluar->gte($today)) {
                $jumlahPenghuni++;
            }
        }

        $kamar->jumlah_penghuni = $jumlahPenghuni;
    }

    // Jumlah kamar terisi per tipe kamar (jumlah kamar dengan penghuni > 0)
    $vvipCount = $kamars->filter(function ($kamar) {
        return str_starts_with($kamar->nomor_kamar, 'A') &&
            intval(substr($kamar->nomor_kamar, 2)) >= 19 &&
            intval(substr($kamar->nomor_kamar, 2)) <= 28 &&
            $kamar->jumlah_penghuni > 0;
    })->count();

    $vipCount = $kamars->filter(function ($kamar) {
        $nomor = $kamar->nomor_kamar;
        $angka = intval(substr($nomor, 2));
        return (
            (str_starts_with($nomor, 'A') && (($angka >= 1 && $angka <= 18) || ($angka >= 29 && $angka <= 46))) ||
            (str_starts_with($nomor, 'B') && $angka >= 1 && $angka <= 50) ||
            (str_starts_with($nomor, 'C') && $angka >= 1 && $angka <= 50)
        ) && $kamar->jumlah_penghuni > 0;
    })->count();

    $barackCount = $kamars->filter(function ($kamar) {
        return in_array($kamar->nomor_kamar, ['C-51', 'C-52']) && $kamar->jumlah_penghuni > 0;
    })->count();


    // Total penghuni per tipe kamar (jumlah total orang)
    $vvipPenghuni = $kamars->filter(function ($kamar) {
        return str_starts_with($kamar->nomor_kamar, 'A') &&
            intval(substr($kamar->nomor_kamar, 2)) >= 19 &&
            intval(substr($kamar->nomor_kamar, 2)) <= 28;
    })->sum('jumlah_penghuni');

    $vipPenghuni = $kamars->filter(function ($kamar) {
        $nomor = $kamar->nomor_kamar;
        $angka = intval(substr($nomor, 2));
        return (
            (str_starts_with($nomor, 'A') && (($angka >= 1 && $angka <= 18) || ($angka >= 29 && $angka <= 46))) ||
            (str_starts_with($nomor, 'B') && $angka >= 1 && $angka <= 50) ||
            (str_starts_with($nomor, 'C') && $angka >= 1 && $angka <= 50)
        );
    })->sum('jumlah_penghuni');

    $barackPenghuni = $kamars->filter(function ($kamar) {
        return in_array($kamar->nomor_kamar, ['C-51', 'C-52']);
    })->sum('jumlah_penghuni');


    // Kirim juga ke view supaya bisa ditampilkan
    return view('dashboard', compact(
        'vvipCount', 'vipCount', 'barackCount',
        'vvipPenghuni', 'vipPenghuni', 'barackPenghuni',
        'kamars'
    ));
}
}