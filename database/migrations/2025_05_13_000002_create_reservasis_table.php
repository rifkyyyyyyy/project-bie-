<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap')->collation('utf8mb4_general_ci');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->collation('utf8mb4_general_ci');
            $table->string('email')->collation('utf8mb4_general_ci');
            $table->string('no_hp')->collation('utf8mb4_general_ci');
            $table->string('asal_kota')->collation('utf8mb4_general_ci');
            $table->date('periode_masuk');
            $table->date('periode_keluar'); 
            $table->integer('lama_menginap');
            $table->string('tipe_kamar')->collation('utf8mb4_general_ci');
            $table->foreignId('kamar_id')->constrained('kamars');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};