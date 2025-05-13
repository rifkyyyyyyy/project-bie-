<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::with('kamar')->get();
        return view('table', compact('reservasi'));
    }
}