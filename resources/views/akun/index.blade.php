@extends('layout.sidebar')

@section('content')
<div class="right_col" role="main" style="padding: 20px; background-color: #0d47a1; min-height: 100vh; color: white;">

    <h1 style="margin-bottom: 20px;">Daftar Akun</h1>

    @if(session('success'))
        <div style="background-color: #009688; padding: 10px; border-radius: 5px; margin-bottom: 20px; color: white;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('akun.create') }}" 
       style="background-color: #1976d2; padding: 10px 15px; border-radius: 5px; color: white; text-decoration: none; display: inline-block; margin-bottom: 20px;">
       Tambah Akun
    </a>

    <table style="width: 100%; border-collapse: collapse; background-color: white; color: black;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">No</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Nama</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Email</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Level</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataAkun as $index => $akun)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $akun->name }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $akun->email }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-transform: capitalize;">{{ $akun->level }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <div style="display: flex; gap: 5px; align-items: center;">
                        <a href="{{ route('akun.edit', $akun->id) }}" 
                        style="background-color: #ffca28; padding: 5px 10px; border-radius: 3px; color: black; text-decoration: none;">
                            Edit
                        </a>

                        <form action="{{ route('akun.destroy', $akun->id) }}" method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    style="background-color: #e53935; color: white; border: none; padding: 5px 10px; border-radius: 3px;">
                                Hapus
                            </button>
                        </form>
                    </div>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding: 10px;">Data akun belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
