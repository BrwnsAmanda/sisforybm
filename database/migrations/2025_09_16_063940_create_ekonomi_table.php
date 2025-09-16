<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekonomis', function (Blueprint $table) {
            $table->id();
            $table->string('foto_produk')->nullable();
            $table->string('nama_produk');
            $table->date('tanggal_verifikasi')->nullable();
            $table->string('nama_lengkap');
            $table->string('nomor_kk')->nullable();
            $table->integer('umur')->nullable();
            $table->string('no_telp')->nullable();

            // alamat ringkas
            $table->string('alamat_dusun')->nullable();
            $table->string('alamat_kelurahan')->nullable();
            $table->string('alamat_kecamatan')->nullable();
            $table->string('alamat_kota')->nullable();

            $table->enum('hasil', ['layak', 'tidak_layak'])->nullable();
            $table->enum('status_mustahik', ['mustahik', 'non_mustahik'])->nullable();
            $table->string('asnaf')->default('ekonomi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekonomis');
    }
};
