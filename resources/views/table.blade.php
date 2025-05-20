@extends('layout.sidebar')

@section('title', 'Dashboard')

@section('content')
<div class="right_col" role="main">
    <div class="">
      <div class="page-title text-white">
        <div class="title_left">
            <h3>Data <small class="text-white">Informasi Customer</small></h3>
        </div>
    </div>    

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Customer</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <!-- Search -->
                            <div class="col-md-6">
                                <form method="GET" action="{{ route('table') }}">
                                    <input type="text" name="search" class="form-control" id="searchInput" placeholder="Cari Customer..." value="{{ request('search') }}">
                                </form>
                            </div>
                        
                            <!-- Filter Tanggal dan Status -->
                                <form method="GET" action="{{ route('table') }}" class="d-flex ms-auto">
                                    <!-- Filter Tanggal -->
                                    <div class="me-2">
                                        <select name="filter" class="form-select" onchange="this.form.submit()">
                                            <option value="">-- Semua Data --</option>
                                            <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                                            <option value="last7days" {{ request('filter') == 'last7days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                        </select>
                                    </div>

                                    <!-- Filter Status -->
                                    <div>
                                        <select name="status" class="form-select" onchange="this.form.submit()">
                                            <option value="">-- Semua Status --</option>
                                            <option value="masih_menginap" {{ request('status') == 'masih_menginap' ? 'selected' : '' }}>Masih Menginap</option>
                                            <option value="sudah_keluar" {{ request('status') == 'sudah_keluar' ? 'selected' : '' }}>Sudah Keluar</option>
                                        </select>
                                    </div>
                                </form>
                                <a href="{{ route('table', request()->query()) }}" onclick="printTable(event)" class="btn btn-outline-secondary">
                                    <i class="fa fa-print"></i> Print Tabel
                                </a>
                        </div>                        
                    </div>

                        <!-- Tabel Data -->
                        <table class="table table-bordered" id="customerTable">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Asal Kota</th>
                                    <th>Periode Masuk</th>
                                    <th>Periode Keluar</th>
                                    <th>Lama Menginap</th>
                                    <th>Tipe Kamar</th>
                                    <th>No Kamar</th>
                                    <th>Status</th>
                                    @if (auth()->user()->level === 'admin')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                           <tbody>
                                @forelse ($reservasi as $r)
                                    <tr>
                                        <td>{{ $r->nama_lengkap }}</td>
                                        <td>{{ $r->email }}</td>
                                        <td>{{ $r->no_hp }}</td>
                                        <td>{{ $r->asal_kota }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->periode_masuk)->translatedFormat('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->periode_keluar)->translatedFormat('d F Y') }}</td>
                                        <td>
                                        @switch($r->lama_menginap)
                                            @case(1)
                                            1 Hari
                                            @break
                                            @case(7)
                                            1 Minggu
                                            @break
                                            @case(14)
                                            2 Minggu
                                            @break
                                            @case(30)
                                            1 Bulan
                                            @break
                                            @case(60)
                                            2 Bulan
                                            @break
                                            @case(90)
                                            3 Bulan
                                            @break
                                            @default
                                            {{ $r->lama_menginap }} Hari
                                        @endswitch
                                        </td>   
                                        <td>{{ $r->kamar->tipe_kamar ?? '-' }}</td> 
                                        <td>{{ $r->kamar->nomor_kamar ?? '-' }}</td>
                                        <td>
                                            @if (\Carbon\Carbon::parse($r->periode_keluar)->isPast())
                                                <span class="badge bg-danger">Sudah Keluar</span>
                                            @else
                                                <span class="badge bg-success">Masih Menginap</span>
                                            @endif
                                        </td>
                                        @if (auth()->user()->level === 'admin')
                                        <td>
                                            <!-- Tombol Edit (Icon Pencil) -->
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $r->id }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Tombol Hapus (Icon Trash) -->
                                            <form action="{{ route('reservasi.destroy', $r->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal{{ $r->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $r->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $r->id }}">Edit Reservasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('reservasi.update', $r->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Nama Lengkap</label>
                                                            <input type="text" class="form-control" name="nama_lengkap" value="{{ $r->nama_lengkap }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control" name="email" value="{{ $r->email }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>No HP</label>
                                                            <input type="text" class="form-control" name="no_hp" value="{{ $r->no_hp }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Asal Kota</label>
                                                            <input type="text" class="form-control" name="asal_kota" value="{{ $r->asal_kota }}" required>
                                                        </div>
                                                        <!-- Tambahkan field lain jika diperlukan -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Belum ada data reservasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('customerTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function () {
            const filter = searchInput.value.toLowerCase();
            for (let i = 1; i < rows.length; i++) { // mulai dari index 1 karena index 0 adalah header
                const td = rows[i].getElementsByTagName('td')[0]; // kolom "Nama Lengkap"
                if (td) {
                    const textValue = td.textContent || td.innerText;
                    rows[i].style.display = textValue.toLowerCase().includes(filter) ? '' : 'none';
                }
            }
        });
    });

    function printTable(event) {
    event.preventDefault();

    // Ambil isi tabel saja
    let printContents = document.getElementById('customerTable').outerHTML;

    // Tambahkan gaya dasar untuk cetak
    let style = `
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
            }
            table, th, td {
                border: 1px solid black;
                padding: 5px;
                text-align: left;
            }
            h2 {
                text-align: center;
            }
        </style>
    `;

    // Buat window baru
    let printWindow = window.open('', '', 'height=700,width=900');
    printWindow.document.write('<html><head><title>Data Customer</title>');
    printWindow.document.write(style);
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h2>Data Customer</h2>');
    printWindow.document.write(printContents);
    printWindow.document.write('</body></html>');
    printWindow.document.write('<p>Dicetak pada: {{ \Carbon\Carbon::now()->format("d-m-Y H:i") }}</p>');
    printWindow.document.write('<p>Filter: {{ request("filter") ?? "Semua" }} | Status: {{ request("status") ?? "Semua" }}</p>');

    // Tunggu load lalu cetak
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

</script>
@endpush
