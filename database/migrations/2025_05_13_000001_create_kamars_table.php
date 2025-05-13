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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kamar'); // contoh: A-01
            $table->enum('tipe_kamar', ['VVIP', 'VIP', 'Barack']);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // sesuai gender
            $table->integer('kapasitas'); // misal 2 / 6
            $table->integer('terisi')->default(0); // jumlah penghuni sekarang
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};