<?php

namespace App\Services;

use App\Models\Salary;
use App\Models\SalaryLog;
use App\Models\Tax;
use App\Models\Bpjs;
use Illuminate\Support\Facades\DB;

class SalaryService
{
    // Cek apakah gaji untuk karyawan dan periode tertentu sudah ada (duplikat)
    public function isSalaryDuplicate(int $employeeId, string $periodeGaji): bool
    {
        return Salary::where('employee_id', $employeeId)
                     ->where('periodeGaji', $periodeGaji)
                     ->exists();
    }

    // Hitung kenaikan gaji berdasarkan lama kerja (dalam tahun)
    public function hitungKenaikanGaji(int $lamaKerjaTahun, float $gajiPokok): float
    {
        if ($lamaKerjaTahun < 2) {
            return $gajiPokok * 0.05;
        } elseif ($lamaKerjaTahun >= 2 && $lamaKerjaTahun < 5) {
            return $gajiPokok * 0.10;  // Harus 10%, bukan 15%
        } else {
            return $gajiPokok * 0.15;
        }
    }


    // Hitung tunjangan transportasi berdasar jabatan
    public function getTunjanganTransportasi(string $jabatan): float
    {
        $tunjangan = [
            'rektor' => 50000,
            'wakil rektor' => 25000,
            'dosen' => 10000,
            'staff' => 10000,
        ];
        return $tunjangan[strtolower($jabatan)] ?? 0;
        }

    // Hitung tunjangan makan berdasar jumlah kehadiran
    public function hitungTunjanganMakan(int $absensi, float $tunjanganPerHari): float
    {
        return $absensi * $tunjanganPerHari;
    }

    // Hitung total gaji dari komponen-komponen gaji
    public function calculateTotalSalary(array $data, float $potongan): float
    {
        return array_sum($data) - $potongan;
    }

    // Log perubahan salary (hanya jika nilai berubah)
    public function logPerubahanSalary(int $salaryId, int $employeeId, string $field, $oldValue, $newValue, ?string $alasan = null): void
    {
        if ($oldValue != $newValue) {
            SalaryLog::create([
                'salary_id' => $salaryId,
                'employee_id' => $employeeId,
                'field' => $field,
                'old_value' => $oldValue,
                'new_value' => $newValue,
                'alasan' => $alasan,
                'updated_at' => now(),
            ]);
        }
    }

    public function saveTaxAndBpjs(int $salaryId, array $taxData, array $bpjsData): void
    {
        DB::transaction(function () use ($salaryId, $taxData, $bpjsData) {
            $salary = Salary::findOrFail($salaryId);

            Tax::updateOrCreate(
                ['salary_id' => $salaryId],
                array_merge($taxData, [
                    'salary_id' => $salaryId, // ⬅ WAJIB disertakan di sini juga!
                    'employee_id' => $salary->employee_id,
                ])
            );

           Bpjs::updateOrCreate(
    [
        'salary_id' => $salaryId,
        'jenisBpjs' => 'Kesehatan'
    ],
    [
        'employee_id' => $salary->employee_id,
        'iuranPerusahaan' => $bpjsData['kesehatan']['iuranPerusahaan'],
        'iuranKaryawan' => $bpjsData['kesehatan']['iuranKaryawan'],
        'tanggalIuran' => $bpjsData['kesehatan']['tanggalIuran'] ?? now()->toDateString(),
    ]
);



Bpjs::updateOrCreate(
    [
        'salary_id' => $salaryId,
        'jenisBpjs' => 'Ketenagakerjaan'
    ],
    [
        'employee_id' => $salary->employee_id,
        'iuranPerusahaan' => $bpjsData['ketenagakerjaan']['iuranPerusahaan'],
        'iuranKaryawan' => $bpjsData['ketenagakerjaan']['iuranKaryawan'],
        'tanggalIuran' => $bpjsData['ketenagakerjaan']['tanggalIuran'] ?? now()->toDateString(),
    ]
);

        });
    }



    // Contoh method untuk create atau update salary sekaligus hitung total gaji dan log perubahan
    public function createOrUpdateSalary(array $data): Salary
    {
        $salary = Salary::updateOrCreate(
            [
                'employee_id' => $data['employee_id'],
                'periodeGaji' => $data['periodeGaji'],
            ],
            $data
        );

        // Hitung total gaji otomatis berdasarkan komponen gaji (misal)
        $totalGaji = $this->calculateTotalSalary([
            $data['gajiPokok'],
            $data['tunjanganTransportasi'],
            $data['tunjanganMakan'],
            $data['tunjanganKesehatan'],
            $data['bonus'],
            $data['insentif'],
            $data['lembur'],
        ]) - $data['totalPotongan'];

        if ($salary->totalGaji != $totalGaji) {
            $this->logPerubahanSalary($salary->id, $salary->employee_id, 'totalGaji', $salary->totalGaji, $totalGaji, 'Update total gaji otomatis');
            $salary->totalGaji = $totalGaji;
            $salary->save();
        }

        return $salary;
    }

    public function calculatePph21(
        float $brutoBulanan,
        float $iuranPensiunBulanan = 100000,
        float $ptkp = 54000000
    ): float {
        $brutoTahunan = $brutoBulanan * 12;
        $biayaJabatan = min($brutoTahunan * 0.05, 6000000); // Maks Rp6 juta
        $iuranPensiun = $iuranPensiunBulanan * 12;

        $neto = $brutoTahunan - $biayaJabatan - $iuranPensiun;
        $pkp = $neto - $ptkp;

        if ($pkp <= 0) return 0;

        // Bulatkan ke bawah ke ribuan terdekat
        $pkp = floor($pkp / 1000) * 1000;

        // Hitung PPh21 tahunan dengan tarif progresif
        $pph21 = 0;
        $lapisan = [
            [50000000, 0.05],
            [250000000, 0.15],
            [500000000, 0.25],
            [floatval(PHP_INT_MAX), 0.30],
        ];

        $sisa = $pkp;
        $batasSebelumnya = 0;

        foreach ($lapisan as [$batas, $tarif]) {
            $batasKena = $batas - $batasSebelumnya;

            if ($sisa <= 0) break;

            $kena = min($sisa, $batasKena);
            $pph21 += $kena * $tarif;
            $sisa -= $kena;
            $batasSebelumnya = $batas;
        }

        return round($pph21 / 12); // Bulanan
    }


}
