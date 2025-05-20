@extends('layout.sidebar')

@section('content')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .calendar-grid {
      display: grid;
      grid-template-columns: 150px repeat(14, 1fr);
      border-left: 1px solid #dee2e6;
    }
    .calendar-grid > div:not(:last-child) {
      border-right: 1px solid #dee2e6;
    }
    .booking {
        position: absolute;
        top: 4px;
        left: 0;
        padding: 2px 6px;
        font-size: 0.75rem;
        color: white;
        background-color: #28a745;
        border-radius: 4px;
        width: 100%;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
  </style>


  <!-- Top Controls -->
  <div class="bg-white shadow-sm border-bottom p-3 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-2">
        <button class="btn btn-outline-secondary btn-sm">14 days</button>
        <button class="btn btn-outline-secondary btn-sm">View today</button>
        <div class="d-flex align-items-center gap-2" style="margin-left:280px;">
            <span id="prev-month" class="px-2 text-muted fs-5" style="cursor:pointer">&#8592;&#8592;</span>
            <span id="current-month" class="fw-medium small">31 Aug 2021</span>
            <span id="next-month" class="px-2 text-muted fs-5" style="cursor:pointer">&#8594;&#8594;</span>
          </div>
          
      </div>
      
        <div class="d-flex align-items-center gap-2">
        <select id="roomFilter" class="form-select form-select-sm w-auto">
            <option value="all">All</option>
            <option value="vip">VIP</option>
            <option value="vvip">VVIP</option>
            <option value="barack">Barack</option>
        </select>
        @if (auth()->user()->level === 'admin')
        <button class="btn btn-primary btn-sm">+ Reservation</button>
        @endif
        </div>
  </div>

                <!-- Calendar -->
              <div class="overflow-auto">
                @php
                $dayWidth = 80; // px
                $today = now();
                @endphp
                
                <div class="calendar-grid text-center text-uppercase small fw-semibold border-bottom bg-white">
                    <div class="bg-light px-2 py-2 border-end">Room</div>
                    @for ($i = 0; $i < 14; $i++)
                        <div class="py-2">{{ now()->addDays($i)->format('D') }}<br>{{ now()->addDays($i)->format('d M') }}</div>
                    @endfor
                </div>
                
                @foreach ($kamars as $tipe => $listKamar)
                    <div class="calendar-grid bg-light align-items-center text-sm fw-semibold border-bottom">
                        <div class="h-100 px-2 border-end d-flex align-items-center">{{ strtoupper($tipe) }}</div>
                        <div class="col-span-14"></div>
                    </div>
                
                    @foreach ($listKamar as $kamar)

                        @php
                            // Cek apakah kamar punya reservasi aktif (masih menginap)
                            $isActive = $reservasis->where('kamar_id', $kamar->id)->contains(function ($r) use ($today) {
                                return \Carbon\Carbon::parse($r->periode_keluar)->gte($today);
                            });
                        @endphp

                        @if ($isActive)
                        <div class="calendar-grid align-items-start border-bottom bg-white position-relative" style="height: 48px; overflow: visible;">
                            <div class="h-100 px-2 border-end d-flex align-items-center">{{ $kamar->nomor_kamar }}</div>

                            <div class="position-relative" style="grid-column: span 14; height: 48px; width: 100%;">

                                @php
                                    $offsetTop = 0;

                                    $activeReservasis = $reservasis->where('kamar_id', $kamar->id)->filter(function ($r) use ($today) {
                                        return \Carbon\Carbon::parse($r->periode_masuk)->lte($today) &&
                                              \Carbon\Carbon::parse($r->periode_keluar)->gte($today);
                                    });

                                    $jumlahAktif = $activeReservasis->count();

                                    $bgColor = '';
                                    if ($jumlahAktif > 0 && $jumlahAktif < $kamar->kapasitas) {
                                        $bgColor = '#ffcc00'; // kuning
                                    } elseif ($jumlahAktif >= $kamar->kapasitas) {
                                        $bgColor = '#1fe668'; // hijau
                                    }
                                @endphp

                                @foreach ($reservasis->where('kamar_id', $kamar->id) as $r)
                                    @php
                                        $periodeKeluar = \Carbon\Carbon::parse($r->periode_keluar);
                                        if ($periodeKeluar->lt($today)) continue;

                                        $startIndex = \Carbon\Carbon::parse($r->periode_masuk)->diffInDays($startDate);
                                        $duration = \Carbon\Carbon::parse($r->periode_masuk)->diffInDays($r->periode_keluar) + 1;
                                        $left = $startIndex * $dayWidth;
                                        $width = $duration * $dayWidth;
                                    @endphp

                                    <div class="booking"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalReservasi{{ $r->id }}"
                                        style="left: {{ $left }}px; width: {{ $width }}px; top: {{ $offsetTop }}px; background-color: {{ $bgColor }};">
                                        {{ $r->nama_lengkap }}
                                    </div>

                                    {{-- Modal --}}
                                    <div class="modal fade" id="modalReservasi{{ $r->id }}" tabindex="-1" aria-labelledby="modalReservasiLabel{{ $r->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalReservasiLabel{{ $r->id }}">Detail Reservasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama:</strong> {{ $r->nama_lengkap }}</p>
                                                    <p><strong>Periode:</strong><br>
                                                        {{ \Carbon\Carbon::parse($r->periode_masuk)->translatedFormat('d F Y') }} - 
                                                        {{ \Carbon\Carbon::parse($r->periode_keluar)->translatedFormat('d F Y') }}
                                                    </p>
                                                    <p><strong>Lama Menginap:</strong> 
                                                        @switch($r->lama_menginap)
                                                            @case(1) 1 Hari @break
                                                            @case(7) 1 Minggu @break
                                                            @case(14) 2 Minggu @break
                                                            @case(30) 1 Bulan @break
                                                            @case(60) 2 Bulan @break
                                                            @case(90) 3 Bulan @break
                                                            @default {{ $r->lama_menginap }} Hari
                                                        @endswitch
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $offsetTop += 24;
                                    @endphp
                                @endforeach

                            </div>
                        </div>
                        @endif

                    @endforeach
                  @endforeach

  




  <!-- Legend -->
  <div class="d-flex gap-4 small mt-4 px-4 text-white">
  <div class="d-flex align-items-center">
    <div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #ff8832;"></div>
    Confirmed
  </div>
  <div class="d-flex align-items-center">
    <div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #1fe668;"></div>
    Checked in
  </div>
  <div class="d-flex align-items-center">
    <div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #8490a7;"></div>
    Checked out
  </div>
  <div class="d-flex align-items-center">
    <div class="me-2 rounded-1" style="width: 16px; height: 16px; background-color: #ff5f5f;"></div>
    Room closure
  </div>
</div>


  <!-- Script Filter -->
  <script>
    document.getElementById('roomFilter').addEventListener('change', function () {
      const value = this.value;
      const rows = document.querySelectorAll('.calendar-grid.position-relative');
      rows.forEach(row => {
        if (value === 'all') {
          row.style.display = '';
        } else if (row.classList.contains(value)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  </script>
  <script>
    let currentDate = new Date();
  
    function updateDisplayedMonth() {
      const options = { year: 'numeric', month: 'long' }; // Format bulan panjang
      document.getElementById("current-month").textContent =
        currentDate.toLocaleDateString('en-US', options);
    }
  
    document.getElementById("prev-month").addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() - 1);
      updateDisplayedMonth();
    });
  
    document.getElementById("next-month").addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() + 1);
      updateDisplayedMonth();
    });
  
    // Initial load
    updateDisplayedMonth();
  </script>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @endsection
