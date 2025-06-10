<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class MockApiController extends Controller
{
    public function getPegawai(): JsonResponse
    {
        return response()->json([
            "status" => true,
            "message" => "Data pegawai berhasil dimuat",
            "data" => [
                [
                    "id" => 1,
                    "nama" => "Data Pegawai Perguruan Tinggi 1",
                    "nik" => "1234567891011122",
                    "alamat" => "Jl. Tanjung 1, RT 3 RW 1, Kel. Bukit Tinggi, Kota Balikpapan",
                    "tanggalLahir" => "1995-06-07",
                    "statusPernikahan" => "Kawin",
                    "jabatan" => "Kepala Pusat",
                    "ptkp_id" => 1,
                    "departemen" => "Institut Teknologi Kalimantan",
                    "statusKepegawaian" => "aktif",
                    "golongan" => "III/c (Penata)",
                    "npwp" => "123456789101112",
                    "email" => "dosen@lecturer.itk.ac.id",
                    "telepon" => "085202200202",
                    "tanggalMasuk" => "2018-09-03",
                    "tanggalKeluar" => null,
                    "created_at" => now(),
                    "updated_at" => now(),
                    "jabatan_fungsional_id" => 91
                ]
            ]
        ]);
    }
}
