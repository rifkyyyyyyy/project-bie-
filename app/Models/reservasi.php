<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    
        protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'email',
        'no_hp',
        'asal_kota',
        'periode_masuk',
        'periode_keluar',
        'lama_menginap',
        'tipe_kamar',
        'kamar_id'
    ]; 

    public function kamar()
    {
    return $this->belongsTo(Kamar::class);
    }

}