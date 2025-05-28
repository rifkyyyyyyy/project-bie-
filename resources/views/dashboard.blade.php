@extends('layout.sidebar')

@php
function filter_kamar($kamars, $prefix, $start, $end) {
    return $kamars->filter(function($kamar) use ($prefix, $start, $end) {
        return str_starts_with($kamar->nomor_kamar, $prefix) &&
               intval(substr($kamar->nomor_kamar, 2)) >= $start &&
               intval(substr($kamar->nomor_kamar, 2)) <= $end;
    });
}
@endphp
@php
function warna_kamar($kamar) {
    $jumlah = $kamar->jumlah_penghuni ?? 0;
    $nomor = $kamar->nomor_kamar;

    // VVIP
    if (str_starts_with($nomor, 'A') && intval(substr($nomor, 2)) >= 19 && intval(substr($nomor, 2)) <= 28) {
        if ($jumlah == 0) return '#22c55e'; // hijau
        if ($jumlah == 1) return '#facc15'; // kuning
        return '#ef4444'; // merah
    }

    // VIP
    if (
        (str_starts_with($nomor, 'A') && (intval(substr($nomor, 2)) >= 1 && intval(substr($nomor, 2)) <= 18)) ||
        (str_starts_with($nomor, 'A') && (intval(substr($nomor, 2)) >= 29 && intval(substr($nomor, 2)) <= 46)) ||
        (str_starts_with($nomor, 'B') && intval(substr($nomor, 2)) >= 1 && intval(substr($nomor, 2)) <= 50) ||
        (str_starts_with($nomor, 'C') && intval(substr($nomor, 2)) >= 1 && intval(substr($nomor, 2)) <= 50)
    ) {
        if ($jumlah == 0) return '#22c55e'; // hijau
        if ($jumlah == 1) return '#facc15'; // kuning
        return '#ef4444'; // merah
    }

    // BARACK (C-51, C-52)
    if (in_array($nomor, ['C-51', 'C-52'])) {
        return match($jumlah) {
            0 => '#22c55e', // hijau
            1 => '#a0522d', // coklat
            2 => '#800080', // ungu
            3 => '#ffa500', // oren
            4 => '#3b82f6', // biru
            5 => '#facc15', // kuning
            6 => '#ef4444', // merah
            default => '#d1d5db', // abu-abu jika error
        };
    }

    return '#d1d5db'; // default abu-abu
}
@endphp



@section('content')

<style>
    .room-box {
        width: 40px;
        height: 40px;
        margin: 3px;
        border-radius: 6px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        color: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>


<!-- page content -->
<div class="right_col" role="main" style="background-color: #f5f6fa; height: 200vh; width: 86vw; margin-left:-20px;">
    <div class="main-panel">
        <div class="content">
            <!-- Header dengan gradasi biru -->
            <div class="panel-header bg-primary-gradient" style="background: #1265cb; height: 20vh;">
                <div class="page-inner" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="d-flex justify-content-start align-items-start flex-wrap">
                        <div style="margin-left: 30px;">
                            <h3 class="text-white pb-2 fw-bold" style="margin-top: 0;">Dashboard</h3>
                            <h2 class="text-white op-7 mb-2" style="margin-top: 0;">Welcome <b>{{ auth()->user()->name }}</b></h2>                            
                        </div>                         
                    </div>                    
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mb-4" style="width: 83%; margin: auto; border-radius: 20; margin-top: -40px;">
                <div class="card-body">
                    <h5 class="font-weight-bold">Statistik keseluruhan</h5>
                    <p class="text-muted">Informasi harian tentang terisinya kamar / terisinya orang</p>
                    <div class="d-flex justify-content-around mt-4">
                        <div class="text-center">
                            <div id="circles-1"></div>
                            <div class="mt-3 text-dark"><strong>VVIP</strong></div>
                        </div>
                        <div class="text-center">
                            <div id="circles-2"></div>
                            <div class="mt-3 text-dark"><strong>VIP</strong></div>
                        </div>
                        <div class="text-center">
                            <div id="circles-3"></div>
                            <div class="mt-3 text-dark"><strong>Barack</strong></div>
                        </div>
                    </div>                    
                </div>
            </div>            
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4 mt-5" style="width: 83%; margin: auto; border-radius: 20;">
        <div class="card-body">
    <h5 class="font-weight-bold">Ketersediaan Kamar</h5>
    <p class="text-muted">Warna: Hijau (kosong), Kuning (sebagian), Merah (penuh)</p>
    <p class="text-muted">Warna (Barack): Coklat (terisi 1), Ungu (terisi 2), Orange (terisi 3), Biru (terisi 4)</p>

    {{-- ================= VVIP ================= --}}
    <h3 class="mt-4 text-center fw-bold">VVIP</h3>
    <div class="d-flex justify-content-between" style="max-width: 1000px; gap: 40px;">
        <div style="flex: 1; text-align: center; font-weight: bold; font-size: 18px;">Putri</div>
        <div style="flex: 1; text-align: center; font-weight: bold; font-size: 18px;">Putra</div>
    </div>
    <div class="d-flex justify-content-between" style="gap: 40px; flex-wrap: wrap; max-width: 1000px;">
        <div style="flex: 1;">
            <div class="d-flex flex-wrap">
                @foreach(filter_kamar($kamars, 'A', 19, 23) as $kamar)
                    @php
                         $color = 'background-color: ' . warna_kamar($kamar) . ';';
                    @endphp
                    <div class="room-box m-1" style="{{ $color }}">{{ $kamar->nomor_kamar }}</div>
                @endforeach
            </div>
        </div>
        <div style="flex: 1;">
            <div class="d-flex flex-wrap justify-content-end">
                @foreach(filter_kamar($kamars, 'A', 24, 28) as $kamar)
                    @php
                         $color = 'background-color: ' . warna_kamar($kamar) . ';';
                    @endphp
                    <div class="room-box m-1" style="{{ $color }}">{{ $kamar->nomor_kamar }}</div>
                @endforeach
            </div>
        </div>
    </div>


{{-- ================= VIP ================= --}}
<h3 class="mt-5 text-center fw-bold">VIP</h3>
<div class="d-flex justify-content-between align-items-start" style="gap: 40px; max-width: 1000px; margin: auto;">
    {{-- Putri --}}
    <div style="flex: 1; text-align: center;">
        <div style="font-size: 18px;" class="fw-bold mb-2">Putri</div>
        <div class="d-flex flex-wrap justify-content-center" style="gap: 4px;">
            @foreach(collect()
                ->merge(filter_kamar($kamars, 'A', 1, 18))
                ->merge(filter_kamar($kamars, 'B', 1, 25))
                ->merge(filter_kamar($kamars, 'C', 1, 25)) as $kamar)
                @php
                     $color = 'background-color: ' . warna_kamar($kamar) . ';';
                @endphp
                <div class="room-box" style="{{ $color }}">{{ $kamar->nomor_kamar }}</div>
            @endforeach
        </div>
    </div>

    {{-- Spacer antara putri dan putra --}}
    <div style="width: 60px;"></div>

    {{-- Putra --}}
    <div style="flex: 1; text-align: center;">
        <div style="font-size: 18px;" class="fw-bold mb-2">Putra</div>
        <div class="d-flex flex-wrap justify-content-center" style="gap: 4px;">
            @foreach(collect()
                ->merge(filter_kamar($kamars, 'A', 29, 46))
                ->merge(filter_kamar($kamars, 'B', 26, 50))
                ->merge(filter_kamar($kamars, 'C', 26, 50)) as $kamar)
                @php
                     $color = 'background-color: ' . warna_kamar($kamar) . ';';
                @endphp
                <div class="room-box" style="{{ $color }}">{{ $kamar->nomor_kamar }}</div>
            @endforeach
        </div>
    </div>
</div>


{{-- ================= Barack ================= --}}
<h3 class="mt-4 text-center fw-bold">BARACK</h3>
    <div class="d-flex justify-content-between" style="max-width: 1000px; gap: 40px;">
        <div style="flex: 1; text-align: center; font-weight: bold; font-size: 18px;">Putri</div>
        <div style="flex: 1; text-align: center; font-weight: bold; font-size: 18px;">Putra</div>
    </div>
    <div class="d-flex justify-content-between" style="gap: 40px; flex-wrap: wrap; max-width: 1000px;">
    <div style="flex: 1;">
        <div class="d-flex flex-wrap">
            @foreach(filter_kamar($kamars, 'C', 51, 51) as $kamar)
                @php
                   $color = 'background-color: ' . warna_kamar($kamar) . ';';
                @endphp
                <div class="room-box m-1" style="{{ $color }}">{{ $kamar->nomor_kamar }}</div>
            @endforeach
        </div>
    </div>
    <div style="flex: 1;">
        <div class="d-flex flex-wrap justify-content-end">
            @foreach(filter_kamar($kamars, 'C', 52, 52) as $kamar)
                @php
                  $color = 'background-color: ' . warna_kamar($kamar) . ';';
                @endphp
                <div class="room-box m-1" style="{{ $color }}">{{ $kamar->nomor_kamar }}</div>
            @endforeach
        </div>
    </div>
</div>


    </div>
    
    
</div>

<script src="https://cdn.jsdelivr.net/npm/circles.js@0.0.6/circles.min.js"></script>
<script>
    Circles.create({
        id: 'circles-1',
        radius: 45,
        value: {{ $vvipCount }},
        maxValue: 10,
        width: 8,
        text: '{{ $vvipCount }}/{{ $vvipPenghuni }}',
        colors: ['#e6e6e6', '#FFA726'],
        duration: 400
    });
    Circles.create({
        id: 'circles-2',
        radius: 45,
        value: {{ $vipCount }},
        maxValue: 136,
        width: 8,
        text: '{{ $vipCount }}/{{ $vipPenghuni }}',
        colors: ['#e6e6e6', '#66BB6A'],
        duration: 400
    });
    Circles.create({
        id: 'circles-3',
        radius: 45,
        value: {{ $barackCount }},
        maxValue: 2,
        width: 8,
        text: '{{ $barackCount }}/{{ $barackPenghuni }}',
        colors: ['#e6e6e6', '#EF5350'],
        duration: 400
    });
</script>

@endsection
