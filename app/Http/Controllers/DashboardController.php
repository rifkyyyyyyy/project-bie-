<?php

namespace App\Http\Controllers;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Menghitung jumlah kamar berdasarkan tipe
        $vvipCount = Reservasi::where('tipe_kamar', 'VVIP')->count();
        $vipCount = Reservasi::where('tipe_kamar', 'VIP')->count();
        $barackCount = Reservasi::where('tipe_kamar', 'Barack')->count();

        // Mengirim data ke view dashboard
        return view('dashboard', compact('vvipCount', 'vipCount', 'barackCount'));
    }
}
