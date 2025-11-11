<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected $appends = [
        'foto_produk_url',
    ];

    protected function fotoProdukUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->foto_produk) return '-';

                $bucket = env('SUPABASE_BUCKET');
                $supabaseUrl = env('SUPABASE_URL');

                return "$supabaseUrl/storage/v1/object/public/$bucket/{$this->foto_produk}";
            }
        );
    }
}
