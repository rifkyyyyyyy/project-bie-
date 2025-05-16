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

                      <!-- Search Form -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari Customer...">
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
                                    <th>Aksi</th>
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
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $r->id }}">Edit</button>
                                            <form action="{{ route('reservasi.destroy', $r->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
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
{{-- @push('scripts')
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
</script>
@endpush --}}
