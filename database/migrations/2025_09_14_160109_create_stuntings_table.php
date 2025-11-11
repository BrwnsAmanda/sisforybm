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
    Schema::create('stuntings', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('nomor_kk');
        $table->date('tanggal_lahir');
        $table->integer('umur');
        $table->string('agama')->nullable();
        $table->string('dusun')->nullable();
        $table->string('kelurahan_desa')->nullable();
        $table->string('kecamatan')->nullable();
        $table->string('kab_kota')->nullable();
        $table->string('telepon')->nullable();
        $table->string('pekerjaan_ortu')->nullable();
        $table->integer('jumlah_tanggungan')->nullable();
        $table->integer('total_pengeluaran')->nullable();
        $table->integer('total_pendapatan')->nullable();
        $table->integer('selisih')->nullable();
        $table->string('komitmen_program')->nullable();
        $table->string('hasil')->nullable();
        $table->string('status_mustahik')->nullable();
        $table->string('asnaf')->nullable();
        $table->date('tanggal_penerimaan')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stuntings');
    }
};
