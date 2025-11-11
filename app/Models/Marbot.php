<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Marbot extends Model
{
    use HasFactory;

    protected $table = 'marbots';

    protected $fillable = [
        'nama_lengkap',
        'jabatan',
        'nama_verifikator',
        'unit_kerja',
        'no_telp_marbot',
        'no_telp_masjid',
        'pendapatan_rata_rata',
        'jabatan_pengurus',
        'nama_pengurus',
        'alamat_marbot',
        'alamat_masjid',
        'status_kepemilikan_rumah',
        'domisili_sesuai_ktp',
        'tanggal_lahir',
        'nik',
        'no_rekening_bri',
        'atas_nama_rekening',
        'alamat_rekening',
        'pekerjaan_lain',
        'status_pernikahan',
        'jumlah_tanggungan',
        'pendapatan_marbot',
        'total_pendapatan_lain',
        'sumber_pendapatan_lainnya',
        'fc_ktp_path',
        'foto_depan_masjid_path',
        'grand_total_pendapatan',
        'nomor_pendaftaran',
        'surplus_defisit',
        'nama_masjid',
        'foto_masjid_path',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'domisili_sesuai_ktp' => 'boolean',
    ];

    protected $appends = [
        'foto_masjid_url',
        'fc_ktp_url',
    ];

    protected function fotoMasjidUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->foto_masjid_path) return '-';

                $bucket = env('SUPABASE_BUCKET');
                $supabaseUrl = env('SUPABASE_URL');

                return "$supabaseUrl/storage/v1/object/public/$bucket/{$this->foto_masjid_path}";
            }
        );
    }

    protected function fcKtpUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->fc_ktp_path) return '-';

                $bucket = env('SUPABASE_BUCKET');
                $supabaseUrl = env('SUPABASE_URL');

                return "$supabaseUrl/storage/v1/object/public/$bucket/{$this->fc_ktp_path}";
            }
        );
    }
}
