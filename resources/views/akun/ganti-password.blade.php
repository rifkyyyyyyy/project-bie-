@extends('layout.sidebar')

@section('content')
<div class="right_col" role="main" style="min-height: 100vh; background-color: #0666c6; display: flex; flex-direction: column; align-items: center; padding-top: 40px;">

    <!-- Judul di luar card -->
    <h1 style="color: white; margin-bottom: 25px;">Ganti Password {{ $akun->name }}</h1>

    <!-- Card -->
    <div style="width: 100%; max-width: 500px; background-color: white; color: #333; border-radius: 10px; padding: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">

        @if ($errors->any())
            <div style="background-color: #e53935; padding: 10px; border-radius: 5px; margin-bottom: 20px; color: white;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('akun.gantiPassword', $akun->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; font-weight: bold;">Password Baru</label>
                <input type="password" id="password" name="password" required minlength="6"
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password_confirmation" style="display: block; font-weight: bold;">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6"
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            </div>

            <div style="text-align: center;">
                <button type="submit"
                        style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer;">
                    Simpan Password
                </button>
                <a href="{{ route('dashboard') }}"
                   style="margin-left: 15px; color: #0d6efd; text-decoration: underline;">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
