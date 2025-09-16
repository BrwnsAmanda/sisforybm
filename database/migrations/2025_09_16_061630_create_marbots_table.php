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
        Schema::create('marbots', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('jabatan')->nullable();
            $table->string('nama_verifikator')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('no_telp_marbot')->nullable();
            $table->string('no_telp_masjid')->nullable();
            $table->integer('pendapatan_rata_rata')->nullable();
            $table->string('jabatan_pengurus')->nullable();
            $table->string('nama_pengurus')->nullable();
            $table->string('alamat_marbot')->nullable();
            $table->string('alamat_masjid')->nullable();
            $table->string('status_kepemilikan_rumah')->nullable();
            $table->boolean('domisili_sesuai_ktp')->default(false);
            $table->date('tanggal_lahir')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_rekening_bri')->nullable();
            $table->string('atas_nama_rekening')->nullable();
            $table->string('alamat_rekening')->nullable();
            $table->string('pekerjaan_lain')->nullable();
            $table->string('status_pernikahan')->nullable();
            $table->integer('jumlah_tanggungan')->nullable();
            $table->integer('pendapatan_marbot')->nullable();
            $table->integer('total_pendapatan_lain')->nullable();
            $table->string('sumber_pendapatan_lainnya')->nullable();
            $table->string('fc_ktp_path')->nullable();
            $table->string('foto_depan_masjid_path')->nullable();
            $table->integer('grand_total_pendapatan')->nullable();
            $table->string('nomor_pendaftaran')->nullable();
            $table->string('surplus_defisit')->nullable();
            $table->string('nama_masjid')->nullable();
            $table->string('foto_masjid_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marbots');
    }
};
