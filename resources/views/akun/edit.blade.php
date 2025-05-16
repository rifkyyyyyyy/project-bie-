@extends('layout.sidebar')

@section('content')
<div class="right_col" role="main">
    <h1>Edit Akun</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('akun.update', $akun->id) }}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $akun->name) }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $akun->email) }}" required>
        </div>

        <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control" required>
                <option value="">-- Pilih Level --</option>
                <option value="admin" {{ old('level', $akun->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="marketing" {{ old('level', $akun->level) == 'marketing' ? 'selected' : '' }}>Marketing</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('akun.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
