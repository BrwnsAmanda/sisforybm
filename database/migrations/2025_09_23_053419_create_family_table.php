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
        Schema::create('family_strengthenings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_assessment')->nullable();
            $table->string('nama_lengkap');
            $table->string('nomor_kk')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('umur')->nullable();
            $table->string('no_telp')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('hasil', ['LAYAK', 'TIDAK LAYAK'])->nullable();
            $table->enum('status_mustahik', ['Mustahik', 'Non-Mustahik'])->nullable();
            $table->string('asnaf')->nullable();
            $table->integer('nilai_verifikasi')->nullable();
            $table->integer('lwa')->nullable(); // Daftar Hadir, Kesungguhan, Kejujuran
            $table->integer('nilai_akhir')->nullable();
            $table->enum('keterangan', ['Lulus', 'Tidak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family');
    }
};
