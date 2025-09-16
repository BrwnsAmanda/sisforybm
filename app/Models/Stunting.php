<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stunting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'nomor_kk',
        'tanggal_lahir',
        'umur',
        'agama',
        'dusun',
        'kelurahan_desa',
        'kecamatan',
        'kab_kota',
        'telepon',
        'pekerjaan_ortu',
        'jumlah_tanggungan',
        'total_pengeluaran',
        'total_pendapatan',
        'selisih',
        'komitmen_program',
        'hasil',
        'status_mustahik',
        'asnaf',
        'tanggal_penerimaan',
    ];
}
