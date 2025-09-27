<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyStrengthening extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_assessment',
        'nama_lengkap',
        'nomor_kk',
        'tanggal_lahir',
        'umur',
        'no_telp',
        'alamat',
        'hasil',
        'status_mustahik',
        'asnaf',
        'nilai_verifikasi',
        'lwa',
        'nilai_akhir',
        'keterangan',
    ];
}
