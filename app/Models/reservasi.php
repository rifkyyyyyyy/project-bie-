<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class reservasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'email',
        'no_hp',
        'asal_kota',
        'periode_masuk',
        'priode_keluar',
        'lama_menginap',
        'tipe_kamar',
    ]; }

