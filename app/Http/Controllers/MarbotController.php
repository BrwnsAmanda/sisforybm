<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marbot;
use Illuminate\Support\Facades\Http;

class MarbotController extends Controller
{
    // Handle file upload + simpan data marbot
    public function store(Request $request)
    {
        // Validasi form (sesuaikan dengan kebutuhan)
        $request->validate([
            'fc_ktp' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'foto_depan_masjid' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'foto_masjid' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'nama_lengkap' => 'required|string|max:255',
            'nama_masjid' => 'required|string|max:255',
        ]);

        // === Upload file ke Supabase (jika ada) ===
        $paths = [];

        $fileFields = [
            'fc_ktp' => 'fc_ktp_path',
            'foto_depan_masjid' => 'foto_depan_masjid_path',
            'foto_masjid' => 'foto_masjid_path',
        ];

        foreach ($fileFields as $inputName => $dbField) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                // Upload ke Supabase
                $response = Http::withToken(env('SUPABASE_KEY'))
                    ->attach('file', fopen($file->getPathname(), 'r'), $fileName)
                    ->post(env('SUPABASE_URL') . '/storage/v1/object/ybmstore/marbot/' . $fileName);

                if ($response->failed()) {
                    return response()->json([
                        'error' => "Upload $inputName gagal",
                        'detail' => $response->body()
                    ], 500);
                }

                $paths[$dbField] = 'marbot/' . $fileName;
            }
        }

        // === Simpan ke database ===
        $marbot = Marbot::create(array_merge([
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'nama_verifikator' => $request->nama_verifikator,
            'unit_kerja' => $request->unit_kerja,
            'no_telp_marbot' => $request->no_telp_marbot,
            'no_telp_masjid' => $request->no_telp_masjid,
            'pendapatan_rata_rata' => $request->pendapatan_rata_rata,
            'jabatan_pengurus' => $request->jabatan_pengurus,
            'nama_pengurus' => $request->nama_pengurus,
            'alamat_marbot' => $request->alamat_marbot,
            'alamat_masjid' => $request->alamat_masjid,
            'status_kepemilikan_rumah' => $request->status_kepemilikan_rumah,
            'domisili_sesuai_ktp' => $request->domisili_sesuai_ktp,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nik' => $request->nik,
            'no_rekening_bri' => $request->no_rekening_bri,
            'atas_nama_rekening' => $request->atas_nama_rekening,
            'alamat_rekening' => $request->alamat_rekening,
            'pekerjaan_lain' => $request->pekerjaan_lain,
            'status_pernikahan' => $request->status_pernikahan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'pendapatan_marbot' => $request->pendapatan_marbot,
            'total_pendapatan_lain' => $request->total_pendapatan_lain,
            'sumber_pendapatan_lainnya' => $request->sumber_pendapatan_lainnya,
            'grand_total_pendapatan' => $request->grand_total_pendapatan,
            'nomor_pendaftaran' => $request->nomor_pendaftaran,
            'surplus_defisit' => $request->surplus_defisit,
            'nama_masjid' => $request->nama_masjid,
        ], $paths));

        // Generate public URL kalau bucket public
        $publicUrls = [];
        foreach ($paths as $field => $path) {
            $publicUrls[$field] = env('SUPABASE_URL') . '/storage/v1/object/public/ybmstore/' . $path;
        }

        return response()->json([
            'message' => 'Data marbot berhasil disimpan',
            'marbot' => $marbot,
            'file_urls' => $publicUrls,
        ]);
    }
}
