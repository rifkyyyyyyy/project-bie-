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
                                <input type="text" class="form-control" placeholder="Cari Customer...">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info">Search</button>
                            </div>
                        </div>

                        <!-- Tabel Data -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Asal Kota</th>
                                    <th>Periode Masuk</th>
                                    <th>Periode Keluar</th>
                                    <th>Lama Menginap</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Budi Santoso</td>
                                    <td>budi@example.com</td>
                                    <td>081234567890</td>
                                    <td>Surabaya</td>
                                    <td>01 Januari 2024</td>
                                    <td>01 Juni 2024</td>
                                    <td>5 bulan</td>
                                    <td>Sudah Keluar</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Siti Aminah</td>
                                    <td>siti@example.com</td>
                                    <td>082345678901</td>
                                    <td>Malang</td>
                                    <td>15 Februari 2024</td>
                                    <td>15 Mei 2024</td>
                                    <td>3 bulan</td>
                                    <td>Sudah Keluar</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Andi Wijaya</td>
                                    <td>andi@example.com</td>
                                    <td>083456789012</td>
                                    <td>Jember</td>
                                    <td>01 Maret 2024</td>
                                    <td>-</td>
                                    <td>2 bulan</td>
                                    <td>Masih Menginap</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p><i>*Tombol Edit, Hapus, dan Search belum terhubung dengan fungsi atau database.</i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection