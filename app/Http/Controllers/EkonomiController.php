<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekonomi;
use Illuminate\Support\Facades\Http;

class EkonomiController extends Controller
{
    // Handle file upload
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'foto_produk' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:10240', // max 10MB
            'nama_produk' => 'required|string|max:255',
        ]);

        $file = $request->file('foto_produk');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        // Upload ke Supabase Storage (pakai REST API)
        $response = Http::withToken(env('SUPABASE_KEY'))
            ->attach('file', fopen($file->getPathname(), 'r'), $fileName)
            ->post(env('SUPABASE_URL') . '/storage/v1/object/ybmstore/ekonomi/' . $fileName);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Upload ke Supabase gagal',
                'detail' => $response->body()
            ], 500);
        }

        // Path file di Supabase
        $filePath = 'ekonomi/' . $fileName;

        // Simpan data ke database
        $ekonomi = Ekonomi::create([
            'foto_produk' => $filePath,
            'nama_produk' => $request->nama_produk,
            'tanggal_verifikasi' => $request->tanggal_verifikasi,
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_kk' => $request->nomor_kk,
            'umur' => $request->umur,
            'no_telp' => $request->no_telp,
            'alamat_dusun' => $request->alamat_dusun,
            'alamat_kelurahan' => $request->alamat_kelurahan,
            'alamat_kecamatan' => $request->alamat_kecamatan,
            'alamat_kota' => $request->alamat_kota,
            'hasil' => $request->hasil,
            'status_mustahik' => $request->status_mustahik,
            'asnaf' => $request->asnaf,
        ]);

        // Generate public URL kalau bucket kamu sudah di-set public
        $publicUrl = env('SUPABASE_URL') . '/storage/v1/object/public/ybmstore/' . $filePath;

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'ekonomi' => $ekonomi,
            'foto_url' => $publicUrl,
        ]);
    }
}
