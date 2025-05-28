@extends('layout.sidebar')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  html {
      font-size: 16px;
  }

  body, .calendar-grid > div, .booking, select, .modal-body, .modal-title, .btn, .form-select {
      font-size: 1rem !important;
  }

  .calendar-wrapper {
      overflow-x: auto;
      white-space: nowrap;
  }
  .calendar-grid {
      display: grid;
      grid-auto-flow: column;
      grid-auto-columns: 100px;
      overflow-x: auto;
      white-space: nowrap;
  }

  .calendar-grid > div:not(:last-child) {
      border-right: 1px solid #dee2e6;
  }
  .calendar-grid > div {
      padding: 2px 2px;
      line-height: 1.1;
      text-align: center;
      height: 36px;
  }
  .booking {
      position: absolute;
      top: 2px;
      left: 0;
      padding: 1px 4px;
      color: white;
      background-color: #28a745;
      border-radius: 2px;
      text-overflow: ellipsis;
      white-space: nowrap;
      overflow: hidden;
      height: 22px;
  }
</style>




@php
    $selectedMonth = request('month') ?? now()->month;
    $selectedYear = request('year') ?? now()->year;
    $startDate = \Carbon\Carbon::create($selectedYear, $selectedMonth, 1);
    $daysInMonth = $startDate->daysInMonth;
@endphp

<div class="bg-white shadow-sm border-bottom p-3 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-3">
        <form method="GET" id="monthForm" class="d-flex gap-2">
            <select name="month" class="form-select form-select-sm" onchange="document.getElementById('monthForm').submit();">
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                    </option>
                @endforeach
            </select>
            <select name="year" class="form-select form-select-sm" onchange="document.getElementById('monthForm').submit();">
                @for($y = now()->year - 2; $y <= now()->year + 2; $y++)
                    <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </form>
            <select id="roomFilter" class="form-select gap-3 form-select-sm d-inline-block" style="width: auto; padding-top: 4px; padding-bottom: 4px; margin-left: -20px;">
              <option value="all">All</option>
              <option value="vvip">VVIP</option>
              <option value="vip">VIP</option>
              <option value="barack">Barack</option>
            </select>
    </div>
    
    <div class="d-flex align-items-center gap-2">
        @if (auth()->user()->level === 'admin')
        <a href="{{ route('reservasi.create') }}" class="btn btn-primary btn-sm">+ Reservation</a>
        @endif
    </div>
</div>

<!-- Kalender -->
<div class="calendar-wrapper">
    <!-- WRAPPER SATU-SATUNYA YANG DISCROLL -->
    <div class="overflow-auto">
        <div style="min-width: max-content;"> <!-- supaya tidak memaksa lebar -->
            
            @php
                // Tanggal awal kalender (1 di bulan yang dipilih)
                $startDate = \Carbon\Carbon::create($selectedYear, $selectedMonth, 1);
            @endphp

            <!-- Header tanggal -->
            <div class="calendar-grid text-center text-uppercase fw-semibold border-bottom bg-white">
                <div class="bg-light px-1 py-1 border-end">Room</div>
                @for ($i = 1; $i <= $daysInMonth; $i++)
                    @php $date = \Carbon\Carbon::create($selectedYear, $selectedMonth, $i); @endphp
                    <div class="px-1 py-1">
                        {{ $date->format('D') }}<br>{{ $date->format('d M') }}
                    </div>
                @endfor
            </div>

            <!-- Isi kamar -->
            @foreach ($kamars as $tipe => $listKamar)
                <div class="calendar-grid bg-light align-items-center text-sm fw-semibold border-bottom">
                    <div class="h-100 px-2 border-end d-flex align-items-center">{{ strtoupper($tipe) }}</div>
                    @for ($i = 1; $i <= $daysInMonth; $i++)
                        <div></div>
                    @endfor
                </div>

                @foreach ($listKamar as $kamar)
                @php
                $isActive = $reservasis->where('kamar_id', $kamar->id)->contains(function ($r) use ($selectedYear, $selectedMonth) {
                    $periodeMasuk = \Carbon\Carbon::parse($r->periode_masuk);
                    $periodeKeluar = \Carbon\Carbon::parse($r->periode_keluar);
                    $startOfMonth = \Carbon\Carbon::create($selectedYear, $selectedMonth, 1);
                    $endOfMonth = $startOfMonth->copy()->endOfMonth();
                
                    return $periodeMasuk->lte($endOfMonth) && $periodeKeluar->gte($startOfMonth);
                });
                @endphp
                

                    @if ($isActive)
                    <div class="calendar-grid align-items-start border-bottom bg-white position-relative {{ strtolower($tipe) }}" style="height: 48px;">
                      <div class="h-100 px-2 border-end d-flex align-items-center">{{ $kamar->nomor_kamar }}</div>
                            <div class="position-relative d-flex" style="grid-column: span {{ $daysInMonth }}; height: 48px;">
                                <div class="position-relative" style="margin-left: 0; min-width: {{ $daysInMonth * 80 }}px; height: 100%;">
                                    @php $offsetTop = 0; @endphp
                                    @foreach ($reservasis->where('kamar_id', $kamar->id) as $r)
                                            @php
                                            $start = \Carbon\Carbon::parse($r->periode_masuk);
                                            $end = \Carbon\Carbon::parse($r->periode_keluar);
                                        
                                            if ($end->lt($startDate)) continue;
                                        
                                            $startOffset = max(0, $start->diffInDays($startDate, false));
                                            $duration = max(1, $start->diffInDays($end) + 1);
                                            

                                        
                                            // Hitung jumlah penghuni aktif pada kamar di tanggal tersebut
                                            $jumlahAktif = $reservasis->where('kamar_id', $kamar->id)
                                            ->filter(function ($rr) use ($selectedYear, $selectedMonth) {
                                                $masuk = \Carbon\Carbon::parse($rr->periode_masuk);
                                                $keluar = \Carbon\Carbon::parse($rr->periode_keluar);
                                                $startOfMonth = \Carbon\Carbon::create($selectedYear, $selectedMonth, 1);
                                                $endOfMonth = $startOfMonth->copy()->endOfMonth();

                                                return $masuk->lte($endOfMonth) && $keluar->gte($startOfMonth);
                                            })->count();

                                        
                                            // Atur warna sesuai logika
                                            $bgColor = '#22c55e'; // default hijau (kosong)
                                        
                                            if (strtolower($kamar->tipe_kamar) === 'vvip' || strtolower($kamar->tipe_kamar) === 'vip') {
                                                if ($jumlahAktif === 2) {
                                                    $bgColor = '#dc2626'; // merah (penuh)
                                                } elseif ($jumlahAktif === 1) {
                                                    $bgColor = '#facc15'; // kuning (sebagian)
                                                }
                                            } elseif (strtolower($kamar->tipe_kamar) === 'barack') {
                                                switch ($jumlahAktif) {
                                                    case 1: $bgColor = '#a16207'; break; // coklat
                                                    case 2: $bgColor = '#9333ea'; break; // ungu
                                                    case 3: $bgColor = '#f97316'; break; // oren
                                                    case 4: $bgColor = '#3b82f6'; break; // biru
                                                    case 5: $bgColor = '#facc15'; break; // kuning
                                                    case 6: $bgColor = '#dc2626'; break; // merah
                                                }
                                            }
                                        @endphp

                                        <div class="booking"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalReservasi{{ $r->id }}"
                                            style="position: absolute; left: {{ $startOffset * 80 }}px; width: {{ $duration * 80 }}px; top: {{ $offsetTop }}px; background-color: {{ $bgColor }};">
                                            {{ $r->nama_lengkap }}
                                        </div>
                                          <!-- Modal -->
                                          <div class="modal fade" id="modalReservasi{{ $r->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $r->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel{{ $r->id }}">Detail Reservasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Nama:</strong> {{ $r->nama_lengkap }}</p>
                                                        <p><strong>Periode:</strong><br>
                                                            {{ \Carbon\Carbon::parse($r->periode_masuk)->translatedFormat('d F Y') }} -
                                                            {{ \Carbon\Carbon::parse($r->periode_keluar)->translatedFormat('d F Y') }}
                                                        </p>
                                                        <p><strong>Lama Menginap:</strong> {{ $r->lama_menginap }} Hari</p>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        @php $offsetTop += 24; @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</div>


<div class="d-flex gap-4 small mt-4 px-4 text-white flex-wrap">
  <div class="d-flex align-items-center"><div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #22c55e;"></div> Kosong</div>
  <div class="d-flex align-items-center"><div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #facc15;"></div> Kuning (1/2 atau 5/6)</div>
  <div class="d-flex align-items-center"><div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #a16207;"></div> Coklat (1/6)</div>
  <div class="d-flex align-items-center"><div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #9333ea;"></div> Ungu (2/6)</div>
  <div class="d-flex align-items-center"><div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #f97316;"></div> Oren (3/6)</div>
  <div class="d-flex align-items-center"><div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #3b82f6;"></div> Biru (4/6)</div>
  <div class="d-flex align-items-center"><div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #dc2626;"></div> Merah (Penuh)</div>
</div>

<script>
  document.getElementById('roomFilter').addEventListener('change', function () {
      const value = this.value;
      const rows = document.querySelectorAll('.calendar-grid.position-relative');

      rows.forEach(row => {
          if (value === 'all') {
              row.style.display = '';
          } else {
              row.style.display = row.classList.contains(value) ? '' : 'none';
          }
      });
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection