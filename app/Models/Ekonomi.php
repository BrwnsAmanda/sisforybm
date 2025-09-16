<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekonomi extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_produk',
        'nama_produk',
        'tanggal_verifikasi',
        'nama_lengkap',
        'nomor_kk',
        'umur',
        'no_telp',
        'alamat_dusun',
        'alamat_kelurahan',
        'alamat_kecamatan',
        'alamat_kota',
        'hasil',
        'status_mustahik',
        'asnaf',
    ];
}
