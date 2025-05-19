@extends('layout.sidebar')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">

                {{-- Form Tambah Akun --}}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Akun <small>Tambah Akun Baru</small></h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <br />
                        <form id="form-akun" action="{{ route('akun.store') }}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                            @csrf

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 label-align" for="nama">Nama</label>
                                <div class="col-md-6">
                                    <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" required>
                                    @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 label-align" for="email">Email</label>
                                <div class="col-md-6">
                                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 label-align" for="level">Level</label>
                                <div class="col-md-6">
                                    <select id="level" name="level" class="form-control" required>
                                        <option value="">-- Pilih Level --</option>
                                        <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="marketing" {{ old('level') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                                    </select>
                                    @error('level') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 offset-md-2">
                                    {{-- <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('akun.index') }}'">Kembali</button> --}}
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Tabel Daftar Akun --}}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Akun</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr style="text-align:center;">
                                    <th style="width: 50px;">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Level</th>
                                    <th style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dataAkun as $index => $akun)
                                    <tr>
                                        <td style="text-align:center;">{{ $index + 1 }}</td>
                                        <td>{{ $akun->nama }}</td>
                                        <td>{{ $akun->email }}</td>
                                        <td>{{ $akun->password }}</td>
                                        <td>{{ ucfirst($akun->level) }}</td>
                                        <td style="text-align:center;">
                                            <div style="display: flex; justify-content: center; gap: 5px; align-items: center;">
                                                <a href="{{ route('akun.edit', $akun->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="{{ route('akun.ganti_password', $akun->id) }}" class="btn btn-info btn-sm">Ganti Password</a>
                                                <form action="{{ route('akun.destroy', $akun->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus akun ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align:center;">Tidak ada data akun.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

            </div> <!-- col -->
        </div> <!-- row -->
    </div>
</div>
@endsection
