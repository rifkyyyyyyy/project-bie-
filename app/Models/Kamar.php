<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = ['nomor_kamar', 'tipe_kamar', 'jenis_kelamin', 'kapasitas', 'terisi'];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}