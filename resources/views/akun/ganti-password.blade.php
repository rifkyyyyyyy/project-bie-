@extends('layout.sidebar')

@section('content')
<div class="right_col" role="main" style="padding: 20px; background-color: #0d47a1; min-height: 100vh; color: white;">

    <h1 style="margin-bottom: 20px;">Ganti Password: {{ $akun->name }}</h1>

    @if ($errors->any())
        <div style="background-color: #e53935; padding: 10px; border-radius: 5px; margin-bottom: 20px; color: white;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('akun.gantiPassword', $akun->id) }}" method="POST" style="max-width: 400px;">
        @csrf
        @method('PUT')

        <label for="password" style="display: block; margin-bottom: 8px;">Password Baru</label>
        <input type="password" id="password" name="password" required minlength="6" style="width: 100%; padding: 8px; margin-bottom: 15px; border-radius: 4px; border: none;">

        <label for="password_confirmation" style="display: block; margin-bottom: 8px;">Konfirmasi Password Baru</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6" style="width: 100%; padding: 8px; margin-bottom: 20px; border-radius: 4px; border: none;">

        <button type="submit" style="background-color: #1976d2; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">
            Simpan Password
        </button>

        <a href="{{ route('dashboard') }}" style="margin-left: 15px; color: #bbdefb; text-decoration: underline; cursor: pointer;">
            Batal
        </a>
    </form>

</div>
@endsection
