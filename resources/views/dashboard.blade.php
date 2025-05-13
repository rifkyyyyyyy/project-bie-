@extends('layout.sidebar')

@section('content')


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

    
    <section id="ProgramDormitoryIndex" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-10">
                <div class="container">
                    <div class="card p-4 shadow" style="border: none;">
            
                        <!-- VVIP Camp -->
                        <div class="row align-items-center mb-5">
                            <div class="col-md-6">
                                <img src="gambar/vvip.png" alt="VVIP Camp" class="img-fluid rounded shadow" style="transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'"
                                onmouseout="this.style.transform='scale(1)'">
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold">VVIP Camp</h4>
                                <p class="text-muted">Pilihan premium dengan fasilitas eksklusif untuk kenyamanan maksimal selama Anda belajar di Kampung Inggris Pare.</p>
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Water Heater</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>AC</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Wastafel</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>WiFi</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Security 24 Jam</li>
                                </ul>
                                <a href="/reservation+VVIP" class="btn btn-primary">Lihat Selengkapnya →</a>
                            </div>
                        </div>
            
                        <!-- VIP Camp (gambar kanan, teks kiri) -->
                        <div class="row align-items-center flex-row-reverse mb-5">
                            <div class="col-md-6">
                                <img src="gambar/vip.png" alt="VIP Camp" class="img-fluid rounded shadow" style="transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'"
                                onmouseout="this.style.transform='scale(1)'">
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold">VIP Camp</h4>
                                <p class="text-muted">Pilihan favorit dengan fasilitas modern dan kenyamanan optimal untuk pengalaman belajar yang maksimal.</p>
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Double-Deck Bed</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>AC</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>WiFi</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Security 24 Jam</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Area Ruangan Luas</li>
                                </ul>
                                <a href="/reservation+VIP" class="btn btn-primary">Lihat Selengkapnya →</a>
                            </div>
                        </div>
            
                        <!-- Barack Camp (gambar kiri, teks kanan) -->
                        <div class="row align-items-center mb-5">
                            <div class="col-md-6">
                                <img src="gambar/barack.png" alt="Barack Camp" class="img-fluid rounded shadow" style="transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'"
                                onmouseout="this.style.transform='scale(1)'">
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold">Baracks Camp (Khusus Rombongan)</h4>
                                <p class="text-muted">Pilihan ekonomis untuk rombongan dengan fasilitas lengkap dan harga terjangkau, Cocok untuk belajar bersama teman-teman.</p>
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>3 Double-Deck Bed</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>AC</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>WiFi</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Security 24 Jam</li>
                                    <li><i class="bi bi-check-circle-fill text-success me-2"></i>Area Ruangan Luas</li>
                                </ul>
                                <a href="/reservation+Barack" class="btn btn-primary">Lihat Selengkapnya →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
