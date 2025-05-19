<?php

namespace App\Http\Controllers;
use App\Models\Reservasi;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Carbon\Carbon; 
class DashboardController extends Controller
{
    public function dashboard()
    {
    
        $kamars = Kamar::orderBy('nomor_kamar')->get();
        $today = Carbon::today()->toDateString();

        $vvipCount = Reservasi::where('tipe_kamar', 'VVIP')
            ->whereDate('periode_masuk', '<=', $today)
            ->whereDate('periode_keluar', '>=', $today)
            ->count();

        $vipCount = Reservasi::where('tipe_kamar', 'VIP')
            ->whereDate('periode_masuk', '<=', $today)
            ->whereDate('periode_keluar', '>=', $today)
            ->count();

        $barackCount = Reservasi::where('tipe_kamar', 'Barack')
            ->whereDate('periode_masuk', '<=', $today)
            ->whereDate('periode_keluar', '>=', $today)
            ->count();
    
        // Ambil semua reservasi yang aktif hari ini
        $reservasiAktif = Reservasi::whereDate('periode_masuk', '<=', $today)
            ->whereDate('periode_keluar', '>=', $today)
            ->get()
            ->groupBy('kamar_id');
    
            foreach ($kamars as $kamar) {
                $reservasiKamar = $reservasiAktif->get($kamar->id, collect());
            
                $penghuniAktif = $reservasiKamar->filter(function ($r) use ($today) {
                    $masuk = Carbon::parse($r->periode_masuk)->toDateString();
                    $keluar = Carbon::parse($r->periode_keluar)->toDateString();
                    return $masuk <= $today && $keluar >= $today;
                });
            
                $jumlahAktif = $penghuniAktif->count();
                $kapasitas = $kamar->kapasitas ?? 1;
            
                // Update kolom `terisi` langsung di database
                $kamar->terisi = $jumlahAktif;
                $kamar->save();
            
                // Warna status kamar
                if ($jumlahAktif === 0) {
                    $kamar->status_warna = 'gray'; // kosong
                } elseif ($jumlahAktif < $kapasitas) {
                    $kamar->status_warna = 'yellow'; // sebagian
                } else {
                    $kamar->status_warna = 'green'; // penuh
                }
            }
            
    
        return view('dashboard', compact('vvipCount', 'vipCount', 'barackCount', 'kamars'));
    }
}