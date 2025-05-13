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
      top: 0.25rem;
      padding: 0.25rem 0.5rem;
      border-radius: 0.25rem;
      color: white;
      font-size: 0.85rem;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
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
        <button class="btn btn-primary btn-sm">+ Reservation</button>
        </div>
  </div>

  <!-- Calendar -->
  <div class="overflow-auto">
    <div class="calendar-grid text-center text-uppercase small fw-semibold border-bottom bg-white">
      <div class="bg-light px-2 py-2 border-end">Room</div>
      <div class="py-2">TUE<br>31 AUG</div>
      <div class="py-2">WED<br>01 SEP</div>
      <div class="py-2">THU<br>02 SEP</div>
      <div class="py-2">FRI<br>03 SEP</div>
      <div class="py-2">SAT<br>04 SEP</div>
      <div class="py-2">SUN<br>05 SEP</div>
      <div class="py-2">MON<br>06 SEP</div>
      <div class="py-2">TUE<br>07 SEP</div>
      <div class="py-2">WED<br>08 SEP</div>
      <div class="py-2">THU<br>09 SEP</div>
      <div class="py-2">FRI<br>10 SEP</div>
      <div class="py-2">SAT<br>11 SEP</div>
      <div class="py-2">SUN<br>12 SEP</div>
      <div class="py-2">MON<br>13 SEP</div>
    </div>

    <div class="position-relative">
      <!-- Repeatable Section Template for VVIP, VIP, and Barack -->
      <!-- Example: Group Header -->
      <div class="calendar-grid bg-light align-items-center text-sm fw-semibold border-bottom">
        <div class="h-100 px-2 border-end d-flex align-items-center">VIP</div>
        <div class="col-span-14"></div>
      </div>

      <!-- Example: Room Rows -->
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 4</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 5</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 6</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid bg-light align-items-center text-sm fw-semibold border-bottom">
        <div class="h-100 px-2 border-end d-flex align-items-center">VVIP</div>
        <div class="col-span-14"></div>
      </div>

      <!-- Example: Room Rows -->
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 1</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 2</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 3</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 4</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 5</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 6</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 7</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 8</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 9</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative vvip" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 10</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>

      <div class="calendar-grid bg-light align-items-center text-sm fw-semibold border-bottom">
        <div class="h-100 px-2 border-end d-flex align-items-center">Barack</div>
        <div class="col-span-14"></div>
      </div>

      <!-- Example: Room Rows -->
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative barack" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 1</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <div class="calendar-grid align-items-center border-bottom bg-white position-relative barack" style="height: 48px;">
        <div class="h-100 px-2 border-end d-flex align-items-center">Room 2</div>
        <!-- 14 empty columns -->
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="border-end h-100"></div> <div class="border-end h-100"></div>
        <div class="border-end h-100"></div> <div class="h-100"></div>
      </div>
      <!-- Duplikat dan ubah nama room dan class vvip/vip/barack sesuai kebutuhan -->

    </div>
  </div>

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
