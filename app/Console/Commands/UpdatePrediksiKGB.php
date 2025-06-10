<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdatePrediksiKGB extends Command
{
    protected $signature = 'kgb:update-prediksi';
    protected $description = 'Update prediksi kenaikan gaji berkala (KGB) semua karyawan aktif';

   public function handle()
{
    \Log::info('KGB Scheduler berjalan otomatis pada: ' . now());
    $now = Carbon::now();
    $employees = Employee::where('statusKepegawaian', 'aktif')->get();

    foreach ($employees as $employee) {
        $tanggalMasuk = Carbon::parse($employee->tanggalMasuk);

        // Hitung berapa tahun sudah berlalu sejak tanggal masuk sampai sekarang
        $yearsPassed = $tanggalMasuk->diffInYears($now);

        // Hitung berapa kali kenaikan berkala 2 tahun sudah terjadi (floor supaya pembulatan ke bawah)
        $cyclesPassed = floor($yearsPassed / 2);

        // Prediksi KGB berikutnya adalah tanggal masuk + (cyclesPassed + 1) * 2 tahun
        $prediksiKgbBerikutnya = $tanggalMasuk->copy()->addYears(2 * ($cyclesPassed + 1));

        // Update field prediksi dan tanggal_kgb_terakhir (kalau perlu)
        $employee->prediksi_kgb_berikutnya = $prediksiKgbBerikutnya->toDateString();

        // Optional: Update tanggal_kgb_terakhir ke prediksi sebelumnya (cyclesPassed kali 2 tahun)
        $tanggalKgbTerakhir = $tanggalMasuk->copy()->addYears(2 * $cyclesPassed);
        $employee->tanggal_kgb_terakhir = $tanggalKgbTerakhir->toDateString();

        $employee->save();
            // Logging setiap update employee
            Log::info('Prediksi KGB diperbarui', [
                'employee_id' => $employee->id,
                'nama' => $employee->nama,
                'tanggal_masuk' => $employee->tanggalMasuk,
                'tanggal_kgb_terakhir' => $employee->tanggal_kgb_terakhir,
                'prediksi_kgb_berikutnya' => $employee->prediksi_kgb_berikutnya,
            ]);
    }

    $this->info('Prediksi KGB semua karyawan telah diperbarui.');
    Log::info('Prediksi KGB semua karyawan telah diperbarui.');
}

}
