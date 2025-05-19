@extends('layout.sidebar')

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
    }
</style>


<!-- page content -->
<div class="right_col" role="main" style="background-color: #f5f6fa; height: 250vh; width: 86vw; margin-left:-20px;">
    <div class="main-panel">
        <div class="content">
            <!-- Header dengan gradasi biru -->
            <div class="panel-header bg-primary-gradient" style="background: #1265cb; height: 20vh;">
                <div class="page-inner" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="d-flex justify-content-start align-items-start flex-wrap">
                        <div style="margin-left: 30px;">
                            <h3 class="text-white pb-2 fw-bold" style="margin-top: 0;">Dashboard</h3>
                            <h2 class="text-white op-7 mb-2" style="margin-top: 0;">Welcome Admin!</h2>                            
                        </div>
                        <div class="py-2" style="margin-left: 770px;">
                            <a href="#" style="background-color: transparent; color: white; border: 2px solid white; border-radius: 999px; padding: 12px 28px; text-decoration: none; font-weight: 500; display: inline-block; margin-right: 10px; font-size: 14px;">
                                Manage
                            </a>
                            <a href="#" style="background-color: #7462e1; color: white; border: none; border-radius: 999px; padding: 12px 28px; text-decoration: none; font-weight: 500; display: inline-block; font-size: 14px;">
                                Add Customer
                            </a>
                        </div>                                      
                    </div>                    
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mb-4" style="width: 83%; margin: auto; border-radius: 20; margin-top: -40px;">
                <div class="card-body">
                    <h5 class="font-weight-bold">Statistik keseluruhan</h5>
                    <p class="text-muted">Informasi harian tentang ketersediaan kamar</p>
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
            <p class="text-muted">Warna: Abu-abu (kosong), Kuning (sebagian), Hijau (penuh)</p>
            
            <div class="d-flex flex-wrap" style="max-width: 550px;">
                @foreach($kamars as $kamar)
                        @php
                            switch ($kamar->status_warna ?? 'gray') {
                                case 'green':
                                    $color = 'background-color: #22c55e;'; // penuh
                                    break;
                                case 'yellow':
                                    $color = 'background-color: #facc15;'; // sebagian
                                    break;
                                default:
                                    $color = 'background-color: #d1d5db;'; // abu (kosong)
                            }
                    @endphp
            
    
                    <div class="room-box d-flex align-items-center justify-content-center m-1"
                         style="width: 40px; height: 40px; border-radius: 6px; {{ $color }}">
                        {{ $kamar->nomor_kamar }}
                    </div>
                @endforeach
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
    maxValue: 46,
    width: 8,
    text: '{{ $vvipCount }}', // ini memastikan "0" tetap tampil sebagai string
    colors: ['#e6e6e6', '#FFA726'],
    duration: 400
});
Circles.create({
    id: 'circles-2',
    radius: 45,
    value: {{ $vipCount }},
    maxValue: 50,
    width: 8,
    text: '{{ $vipCount }}',
    colors: ['#e6e6e6', '#66BB6A'],
    duration: 400
});
Circles.create({
    id: 'circles-3',
    radius: 45,
    value: {{ $barackCount }},
    maxValue: 50,
    width: 8,
    text: '{{ $barackCount }}',
    colors: ['#e6e6e6', '#EF5350'],
    duration: 400
});

</script>

@endsection
