@extends('layout.sidebar')

@section('content')
<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Tambah Akun</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('akun.store') }}" method="POST" class="form-horizontal">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-6">
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Level</label>
                                <div class="col-md-6">
                                    <select name="level" class="form-control" required>
                                        <option value="">-- Pilih Level --</option>
                                        <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="marketing" {{ old('level') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-2">
                                    <a href="{{ route('akun.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
