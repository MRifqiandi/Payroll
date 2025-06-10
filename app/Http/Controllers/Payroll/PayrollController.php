<?php
namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Employee;
use App\Models\GajiPokokPns;
use App\Models\TunjanganUmum;
use App\Models\Absensi;
use App\Models\UangMakan;
use App\Models\UangLembur;
use App\Models\SalaryRaise;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Bpjs;
use App\Models\Ptkp;
use Illuminate\Support\Facades\DB;
use App\Models\GajiPokokPppk;
use App\Models\Tax;
use App\Models\TunjanganFungsionalDosen;
use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\Salary;

class PayrollController extends Controller
{

    // public function showResult(Request $request)
    // {
    //       try {
    //     $query = Salary::with('employee');
    //     $periode = null;

    //     // Filter berdasarkan jenis kepegawaian
    //     if ($request->filled('jenis_kepegawaian')) {
    //         $query->whereHas('employee', function ($q) use ($request) {
    //             $q->where('jenisKepegawaian', $request->jenis_kepegawaian);
    //         });
    //     }

    //     // Filter berdasarkan periode_gaji, bulan, dan/atau tahun
    //     if ($request->filled('periode_gaji')) {
    //         $periode = $request->periode_gaji;
    //         $query->where('periode_gaji', $periode);
    //     } elseif ($request->filled('bulan') && $request->filled('tahun')) {
    //         $periode = $request->tahun . '-' . $request->bulan;
    //         $query->where('periode_gaji', 'like', $periode . '%');
    //     } elseif ($request->filled('tahun')) {
    //         $periode = $request->tahun;
    //         $query->where('periode_gaji', 'like', $periode . '%');
    //     } elseif ($request->filled('bulan')) {
    //         $periode = 'Bulan: ' . $request->bulan;
    //         $query->whereMonth('periode_gaji', $request->bulan);
    //     }

    //     $salaries = $query->latest('periode_gaji')->paginate(10)->withQueryString();


    //     // Ambil data employee untuk ditampilkan
    //     $employees = Employee::with('ptkp')->get();

    //     return view('pages.payroll.payroll-result', compact('salaries', 'employees', 'periode'));
    //         } catch (\Throwable $e) {
    //     dd($e->getMessage(), $e->getTraceAsString());
    // }
    // }

// public function showResult(Request $request)
// {
//     $periode = $request->query('periode_gaji');

//     $subquery = DB::table('salary as s1')
//         ->selectRaw('MAX(id) as latest_id')
//         ->join('employee', 's1.employee_id', '=', 'employee.id')
//         ->when($request->filled('jenis_kepegawaian'), function ($query) use ($request) {
//             $query->where('employee.jenisKepegawaian', $request->jenis_kepegawaian);
//         })
//         ->when($request->filled('bulan') && $request->filled('tahun'), function ($query) use ($request) {
//             $periode = $request->tahun . '-' . $request->bulan;
//             $query->where('s1.periode_gaji', 'like', $periode . '%');
//         })
//         ->when($request->filled('tahun') && !$request->filled('bulan'), function ($query) use ($request) {
//             $query->where('s1.periode_gaji', 'like', $request->tahun . '%');
//         })
//         ->when($request->filled('bulan') && !$request->filled('tahun'), function ($query) use ($request) {
//             $query->whereMonth('s1.periode_gaji', $request->bulan);
//         })
//         ->groupBy('s1.periode_gaji', 's1.employee_id');

//     // Ambil data gaji berdasarkan ID terbaru (per periode)
//     $salaries = Salary::with('employee')
//         ->whereIn('id', $subquery)
//         ->orderByRaw('GREATEST(UNIX_TIMESTAMP(created_at), UNIX_TIMESTAMP(updated_at)) DESC')
//         ->paginate(10)
//         ->withQueryString();

//     $employees = Employee::with('ptkp')->get();

//     return view('pages.payroll.payroll-result', compact('salaries', 'employees', 'periode'));
// }

public function showResult(Request $request)
{
    $periode = $request->query('periode_gaji');

    // Subquery: ambil salary.id terbaru per periode_gaji dan employee_id
    $subquery = DB::table('salary as s1')
        ->select(DB::raw('MAX(s1.id) as latest_id'))
        ->join('employee', 's1.employee_id', '=', 'employee.id')
        ->when($request->filled('jenis_kepegawaian'), function ($query) use ($request) {
            $query->where('employee.jenisKepegawaian', $request->jenis_kepegawaian);
        })
        ->when($request->filled('bulan') && $request->filled('tahun'), function ($query) use ($request) {
            $periode = $request->tahun . '-' . $request->bulan;
            $query->where('s1.periode_gaji', 'like', $periode . '%');
        })
        ->when($request->filled('tahun') && !$request->filled('bulan'), function ($query) use ($request) {
            $query->where('s1.periode_gaji', 'like', $request->tahun . '%');
        })
        ->when($request->filled('bulan') && !$request->filled('tahun'), function ($query) use ($request) {
            $query->whereMonth('s1.periode_gaji', $request->bulan);
        })
        ->groupBy('s1.employee_id', 's1.periode_gaji');

    // Ambil hanya ID terakhir dari masing-masing kombinasi
    $latestSalaryIds = $subquery->pluck('latest_id');

    // Ambil data gaji yang sesuai
    $salaries = Salary::with('employee')
        ->whereIn('id', $latestSalaryIds)
        ->orderByRaw('GREATEST(UNIX_TIMESTAMP(created_at), UNIX_TIMESTAMP(updated_at)) DESC')
        ->paginate(10)
        ->withQueryString();

    $employees = Employee::with('ptkp')->get();

    return view('pages.payroll.payroll-result', compact('salaries', 'employees', 'periode'));
}



public function hitungGaji(Request $request)
{
    try {
            $request->validate([
                'employee_id' => 'required|exists:employee,id',
                'periode_gaji' => 'required|date_format:Y-m',
                'tunjangan_lain_lain' => 'nullable|numeric|min:0',
            ]);

        $employeeId = $request->employee_id;
        $periodeGaji = $request->periode_gaji;
        $periodeGajiFull = $periodeGaji . '-01';
        $periodeYear = date('Y', strtotime($periodeGajiFull));
        $periodeMonth = date('m', strtotime($periodeGajiFull));

                ActivityLogger::log(
                'hitung_gaji',
                "Mulai menghitung gaji untuk employee_id: $employeeId pada periode: $periodeGaji"
            );

        $employee = Employee::with(['anak', 'ptkp'])->findOrFail($employeeId);

        $getGolonganUtama = function ($golongan) {
            preg_match('/^(I{1,3}|IV|V)/i', strtoupper($golongan), $matches);
            return $matches[0] ?? strtoupper($golongan);
        };

        $golonganUtama = $getGolonganUtama($employee->golongan);
        if ($employee->tanggalMasuk) {
            $periodeDate = new \DateTime($periodeGajiFull);
            $tanggalMasukDate = new \DateTime($employee->tanggalMasuk);
            $selisih = $tanggalMasukDate->diff($periodeDate);
            $mkg = $selisih->y;
        } else {
            Log::error("Tanggal masuk kosong untuk employee_id: {$employee->id}");
            $mkg = 0;
        }

        $jenisPegawai = strtoupper($employee->jenisKepegawaian ?? 'PNS');
        $golonganFormatted = $jenisPegawai . '-' . strtoupper(str_replace(' ', '', $employee->golongan));


                // Log data dasar sebelum cari gaji pokok
        Log::info('Proses hitung gaji - data dasar:', [
            'employee_id' => $employee->id,
            'nama' => $employee->nama,
            'golongan_asli' => $employee->golongan,
            'golongan_formatted' => $golonganFormatted,
            'tanggal_masuk' => $employee->tanggalMasuk,
            'mkg_yang_digunakan' => $mkg,
            'periode_gaji' => $periodeGajiFull,
        ]);

        if ($jenisPegawai === 'PNS') {
            $gajiPokokData = GajiPokokPns::where('golongan', $golonganFormatted)
            ->where('mkg', '<=', $mkg)
            ->orderBy('mkg', 'desc')
            ->first();
        } elseif ($jenisPegawai === 'PPPK') {
            if (str_starts_with($golonganFormatted, 'PPPK-')) {
                $golonganQuery = substr($golonganFormatted, strlen('PPPK-'));
            } else {
                $golonganQuery = $golonganFormatted;
            }

            $gajiPokokData = GajiPokokPppk::where('golongan', $golonganQuery)
                ->where('mkg', '<=', $mkg)
                ->orderBy('mkg', 'desc')
                ->first();
        } else {
            return response()->json(['message' => "Jenis pegawai tidak dikenal"], 422);
        }

    if (!$gajiPokokData) {
    Log::warning('Gaji pokok tidak ditemukan', [
        'employee_id' => $employee->id,
        'jenis_pegawai' => $jenisPegawai,
        'golongan' => $golonganFormatted,
        'mkg' => $mkg,
    ]);

    ActivityLogger::log(
        'hitung_gaji_error',
        "Gaji pokok tidak ditemukan untuk $jenisPegawai dengan golongan: $golonganFormatted dan mkg: $mkg",
        'error'
    );

    return response()->json(['message' => "Gaji pokok tidak ditemukan"], 404);
}
        $gajiPokok = $gajiPokokData->nominal;
        Log::info('Gaji pokok diset', ['nilai' => $gajiPokok]);
        Log::info('Gaji pokok ditemukan', [
            'employee_id' => $employee->id,
            'golongan' => $golonganFormatted,
            'mkg' => $mkg,
            'nominal_gaji_pokok' => $gajiPokokData->nominal,
        ]);

        $tunjanganUmum = optional(TunjanganUmum::where('golongan', $golonganUtama)->first())->tunjangan ?? 0;
        $tunjanganFungsional = optional(
            TunjanganFungsionalDosen::where('jabatan_fungsional_id', $employee->jabatan_fungsional_id)->first()
        )->nominal ?? 0;
        Log::info('Tunjangan fungsional diset', ['nilai' => $tunjanganFungsional]);

        $jumlahHadir = Absensi::where('employee_id', $employee->id)
            ->where('statusKehadiran', 'Hadir')
            ->whereYear('tanggalKehadiran', $periodeYear)
            ->whereMonth('tanggalKehadiran', $periodeMonth)
            ->count();

        $tunjanganIstriSuami = ($employee->statusPernikahan == 'Menikah') ? 0.10 * $gajiPokok : 0;

        $jumlahAnakBerhak = collect($employee->anak)->filter(function ($anak) {
            return !$anak->sudah_kawin && $anak->umur < 21 && !$anak->punya_penghasilan && $anak->menjadi_tanggungan;
        })->count();
        $tunjanganAnak = $jumlahAnakBerhak * 0.02 * $gajiPokok;

        $hargaBerasPerOrang = 72420;

        $jumlahAnakBeras = min($jumlahAnakBerhak, 2);

        $jumlahOrangBeras = 1 + ($employee->statusPernikahan ? 1 : 0) + $jumlahAnakBeras;
        $tunjanganBeras = $hargaBerasPerOrang * $jumlahOrangBeras;

        $tunjanganLainLain = $request->tunjangan_lain_lain ?? 0;

        $gajiPokok = ceil($gajiPokok);
        $tunjanganUmum = ceil($tunjanganUmum);
        $tunjanganLainLain = ceil($tunjanganLainLain);
        $tunjanganFungsional = ceil($tunjanganFungsional);        $tunjanganBeras = ceil($tunjanganBeras);
        $tunjanganIstriSuami = ceil($tunjanganIstriSuami);
        $tunjanganAnak = ceil($tunjanganAnak);

        $gajiKotor = $gajiPokok + $tunjanganUmum + $tunjanganFungsional + $tunjanganLainLain + $tunjanganBeras
            + $tunjanganIstriSuami + $tunjanganAnak;

        $potonganIwp8 = round($gajiKotor * 0.08);

        $iuranBpjsTotal = $gajiPokok * 0.05;
        $iuranBpjsPerusahaan = $gajiPokok * 0.04;
        $iuranBpjsPeserta = $gajiPokok * 0.01;

        Bpjs::updateOrCreate(
            ['employee_id' => $employee->id, 'periode' => $periodeGaji],
            [
                'iuran_total' => $iuranBpjsTotal,
                'iuran_perusahaan' => $iuranBpjsPerusahaan,
                'iuran_peserta' => $iuranBpjsPeserta,
            ]
        );

        $ptkpModel = Ptkp::find($employee->ptkp_id);
        if (!$ptkpModel) {
            ActivityLogger::log(
                    'hitung_gaji_error',
                    "PTKP tidak ditemukan untuk employee_id: $employeeId",
                    'error'
                );
            return response()->json(['message' => 'PTKP tidak ditemukan'], 422);
        }

        $ptkp = $ptkpModel->nilai_ptkp;
        $ptkpId = $ptkpModel->id;

        $penghasilanBrutoBulanan = $gajiPokok + $tunjanganUmum + $tunjanganFungsional + $tunjanganLainLain + $tunjanganBeras
            + $tunjanganIstriSuami + $tunjanganAnak;

        $penghasilanBrutoTahunan = $penghasilanBrutoBulanan * 12;

        $penghasilanNetoTahunan = $penghasilanBrutoTahunan;
        $pkp = max(0, $penghasilanNetoTahunan - $ptkp);
        $pkp = floor($pkp / 1000) * 1000;

        $pph21Tahunan = 0;
        $sisaPkp = $pkp;

        $tarifPajak = [
            ['batas' => 60000000, 'tarif' => 0.05],
            ['batas' => 250000000, 'tarif' => 0.15],
            ['batas' => 500000000, 'tarif' => 0.25],
            ['batas' => INF, 'tarif' => 0.30],
        ];

        $batasSebelumnya = 0;
        foreach ($tarifPajak as $lapisan) {
            if ($sisaPkp <= 0) break;
            $lapisanPajak = min($sisaPkp, $lapisan['batas'] - $batasSebelumnya);
            $pph21Tahunan += $lapisanPajak * $lapisan['tarif'];
            $sisaPkp -= $lapisanPajak;
            $batasSebelumnya = $lapisan['batas'];
        }
        Log::info('Debug Gaji', [
            'gajiPokok' => $gajiPokok,
            'tunjanganUmum' => $tunjanganUmum,
            'tunjanganFungsional' => $tunjanganFungsional,
            'tunjanganLainLain' => $tunjanganLainLain,
            'ptkp' => $ptkp,
            'penghasilanBrutoBulanan' => $penghasilanBrutoBulanan,
            'penghasilanBrutoTahunan' => $penghasilanBrutoTahunan,
            'penghasilanNetoTahunan' => $penghasilanNetoTahunan,
        ]);

        $pph21Bulanan = floor(round($pph21Tahunan / 12));

        Log::info('Debug PPH21', [
            'pkp' => $pkp,
            'pph21Tahunan' => $pph21Tahunan,
        ]);
        Tax::create([
            'employee_id' => $employee->id,
            'ptkp_id' => $ptkpId,
            'pph21' => $pph21Tahunan,
            'penghasilan_neto' => $penghasilanNetoTahunan,
            'penghasilan_kena_pajak' => $pkp,
            'tahun' => $periodeYear,
            'bulan' => $periodeMonth,
            'tanggalLaporan' => now()->toDateString(),
        ]);

        $totalPotongan = $pph21Bulanan + $iuranBpjsPeserta + $potonganIwp8;

       // Hitung gaji bersih awal (sebelum pembulatan)
        $gajiBersih = $gajiKotor - $totalPotongan;

        // Bulatkan ke atas ke kelipatan 100 rupiah
        $gajiBersihRounded = ceil($gajiBersih / 100) * 100;

        // Hitung selisih pembulatan
        $selisihPembulatan = $gajiBersihRounded - $gajiBersih;

        // Hanya tambahkan ke tunjangan pembulatan jika selisihnya positif
        $tunjanganPembulatan = max($selisihPembulatan, 0);

        // Tambahkan tunjangan pembulatan ke gaji kotor
        $gajiKotor += $tunjanganPembulatan;

        // Hitung ulang gaji bersih akhir
        $gajiBersih = $gajiKotor - $totalPotongan;


            Log::info('Siap menyimpan salary', [
            'employee_id' => $employee->id,
            'periode_gaji' => $periodeGaji,
            'gaji_pokok' => $gajiPokok,
            'tunjangan_fungsional' => $tunjanganFungsional,
            'tunjangan_umum' => $tunjanganUmum,
            // 'tunjangan_kinerja' => $tunjanganKinerja,
            'tunjangan_lain_lain' => $tunjanganLainLain,
            'tunjangan_pembulatan' => $tunjanganPembulatan,
            'tunjangan_beras' => $tunjanganBeras,
            // 'uang_makan' => $tunjanganMakanTotal,
            // 'uang_lembur' => $uangLembur,
            'potongan_bpjs' => $iuranBpjsPeserta,
            'potongan_iwp_8' => $potonganIwp8,
            'pph21' => $pph21Bulanan,
            'gaji_bersih' => $gajiBersih,
        ]);
        $salary = Salary::create([
            'employee_id' => $employeeId,
            'periode_gaji' => $periodeGajiFull,
            'gaji_pokok' => $gajiPokok,
            'tunjangan_umum' => $tunjanganUmum,
            'tunjangan_fungsional' => $tunjanganFungsional,
            'tunjangan_lain_lain' => $tunjanganLainLain,
            'tunjangan_pembulatan' => $tunjanganPembulatan,
            'tunjangan_beras' => $tunjanganBeras,
            'tunjangan_istri_suami' => $tunjanganIstriSuami,
            'tunjangan_anak' => $tunjanganAnak,
            'gaji_kotor' => $gajiKotor,
            'potongan_pph21' => $pph21Bulanan,
            'potongan_bpjs' => $iuranBpjsPeserta,
            'potongan_iwp_8' => $potonganIwp8,
            'potongan_lain' => 0,
            'total_potongan' => $totalPotongan,
            'gaji_bersih' => $gajiBersih,
        ]);

        $gajiSebelumnya = Salary::where('employee_id', $employeeId)
            ->where('periode_gaji', '<', $periodeGajiFull)
            ->orderBy('periode_gaji', 'desc')
            ->first();

        if ($gajiSebelumnya) {
            $gajiLama = $gajiSebelumnya->gaji_pokok;
            $gajiBaru = $gajiPokok;

            if ($gajiLama != $gajiBaru) {
                $selisih = $gajiBaru - $gajiLama;
                $persentaseKenaikan = $gajiLama > 0 ? ($selisih / $gajiLama) * 100 : null;

                SalaryRaise::create([
                    'employee_id' => $employeeId,
                    'gajiLama' => $gajiLama,
                    'gajiBaru' => $gajiBaru,
                    'persentaseKenaikan' => $persentaseKenaikan,
                    'alasan' => 'Perubahan gaji pokok otomatis berdasarkan golongan/MKG terbaru',
                    'tanggalKenaikan' => now()->toDateString(),
                ]);
            }
        }
          // Logging aktivitas sukses hitung gaji
            ActivityLogger::log(
                'hitung_gaji',
                "Sukses menghitung gaji employee_id: $employeeId, periode: $periodeGaji, gaji_bersih: $gajiBersih"
            );

        return response()->json([
            'message' => 'Gaji berhasil dihitung dan disimpan',
            'data' => $salary
        ]);
    } catch (\Exception $e) {
        Log::error('Exception saat simpan salary: ' . $e->getMessage(), [
        'trace' => $e->getTraceAsString(),
    ]);
        ActivityLogger::log(
                'hitung_gaji_error',
                "Error menghitung gaji: " . $e->getMessage(),
                'error'
            );

        return response()->json([
            'message' => 'Terjadi kesalahan saat menghitung gaji',
            'error' => $e->getMessage()
        ], 500);
    }
}


public function generateAllSalaries(Request $request)
{
    $request->validate([
        // 'periode_gaji' => 'required|date_format:Y-m',
        'periode_gaji' => 'required|string|regex:/^\d{4}-\d{2}$/',

        'tunjangan_lain_lain' => 'nullable|numeric|min:0'
    ]);

    $employeeId = $request->employee_id;
    $periodeGaji = $request->periode_gaji;
    $periodeGajiFull = $periodeGaji . '-01';
    $periodeYear = date('Y', strtotime($periodeGajiFull));
    $periodeMonth = date('m', strtotime($periodeGajiFull));


    ActivityLogger::log('generate_all_salaries_start', "Memulai generate gaji periode {$periodeGaji}");

    $employees = Employee::with(['anak', 'ptkp', 'jabatanFungsional'])->get();

    \Log::info('Jumlah karyawan: ' . $employees->count());
    ActivityLogger::log('employees_fetched', "Jumlah karyawan yang di-generate: {$employees->count()}");


    $results = [];

    foreach ($employees as $employee) {
        \Log::info('Mulai generate gaji untuk semua employee');
        ActivityLogger::log('generate_salary_start', "Mulai generate gaji untuk semua employee");

        try {
            // === Copy logika hitung gaji ===
            $getGolonganUtama = function ($golongan) {
                preg_match('/^(I{1,3}|IV|V)/i', strtoupper($golongan), $matches);
                return $matches[0] ?? strtoupper($golongan);
            };

            $golonganUtama = $getGolonganUtama($employee->golongan);
        if ($employee->tanggalMasuk) {
            $periodeDate = new \DateTime($periodeGajiFull);
            $tanggalMasukDate = new \DateTime($employee->tanggalMasuk);
            $selisih = $tanggalMasukDate->diff($periodeDate);
            $mkg = $selisih->y;
        } else {
            Log::error("Tanggal masuk kosong untuk employee_id: {$employee->id}");
            $mkg = 0;
        }

        $jenisPegawai = strtoupper($employee->jenisKepegawaian ?? 'PNS'); // Default ke 'PNS' jika null
        $golonganFormatted = $jenisPegawai . '-' . strtoupper(str_replace(' ', '', $employee->golongan));


            Log::info('Proses hitung gaji - data dasar:', [
            'employee_id' => $employee->id,
            'nama' => $employee->nama,
            'golongan_asli' => $employee->golongan,
            'golongan_formatted' => $golonganFormatted,
            'tanggal_masuk' => $employee->tanggalMasuk,
            // 'masa_kerja_golongan' => $employee->masa_kerja_golongan,
            'mkg_yang_digunakan' => $mkg,
            'periode_gaji' => $periodeGajiFull,
        ]);

if ($jenisPegawai === 'PNS') {
            $gajiPokokData = GajiPokokPns::where('golongan', $golonganFormatted)
            ->where('mkg', '<=', $mkg)
            ->orderBy('mkg', 'desc')
            ->first();
        } elseif ($jenisPegawai === 'PPPK') {
            // Untuk PPPK, hilangkan prefix 'PPPK-' jika ada
            if (str_starts_with($golonganFormatted, 'PPPK-')) {
                $golonganQuery = substr($golonganFormatted, strlen('PPPK-'));
            } else {
                $golonganQuery = $golonganFormatted;
            }

            $gajiPokokData = GajiPokokPppk::where('golongan', $golonganQuery)
                ->where('mkg', '<=', $mkg)
                ->orderBy('mkg', 'desc')
                ->first();
        } else {
            return response()->json(['message' => "Jenis pegawai tidak dikenal"], 422);
        }

        if (!$gajiPokokData) {
    Log::warning('Gaji pokok tidak ditemukan', [
        'employee_id' => $employee->id,
        'jenis_pegawai' => $jenisPegawai,
        'golongan' => $golonganFormatted,
        'mkg' => $mkg,
    ]);

    ActivityLogger::log(
        'hitung_gaji_error',
        "Gaji pokok tidak ditemukan untuk $jenisPegawai dengan golongan: $golonganFormatted dan mkg: $mkg",
        'error'
    );

    return response()->json(['message' => "Gaji pokok tidak ditemukan"], 404);
}
        $gajiPokok = $gajiPokokData->nominal;
        Log::info('Gaji pokok diset', ['nilai' => $gajiPokok]);
        Log::info('Gaji pokok ditemukan', [
            'employee_id' => $employee->id,
            'golongan' => $golonganFormatted,
            'mkg' => $mkg,
            'nominal_gaji_pokok' => $gajiPokokData->nominal,
        ]);

            $tunjanganUmum = optional(TunjanganUmum::where('golongan', $golonganUtama)->first())->tunjangan ?? 0;
            $tunjanganFungsional = optional(
                TunjanganFungsionalDosen::where('jabatan_fungsional_id', $employee->jabatan_fungsional_id)->first()
            )->nominal ?? 0;

            // $jumlahHadir = Absensi::where('employee_id', $employee->id)
            //     ->where('statusKehadiran', 'Hadir')
            //     ->whereYear('tanggalKehadiran', $periodeYear)
            //     ->whereMonth('tanggalKehadiran', $periodeMonth)
            //     ->count();


            $tunjanganIstriSuami = ($employee->statusPernikahan == 'Menikah') ? 0.10 * $gajiPokok : 0;

            $jumlahAnakBerhak = collect($employee->anak)->filter(function ($anak) {
                return !$anak->sudah_kawin && $anak->umur < 21 && !$anak->punya_penghasilan && $anak->menjadi_tanggungan;
            })->count();

            $tunjanganAnak = $jumlahAnakBerhak * 0.02 * $gajiPokok;

        // === TUNJANGAN BERAS (PANGAN) ===
        // Rp 72.420 per orang, maksimal: pegawai + pasangan (jika menikah) + 2 anak berhak
        $hargaBerasPerOrang = 72420;

        // Jumlah anak maksimal 2 yang dihitung
        $jumlahAnakBeras = min($jumlahAnakBerhak, 2);

        // Total anggota keluarga berhak beras
        $jumlahOrangBeras = 1 + ($employee->statusPernikahan ? 1 : 0) + $jumlahAnakBeras;

        $tunjanganBeras = $hargaBerasPerOrang * $jumlahOrangBeras;

        $tunjanganLainLain = $request->tunjangan_lain_lain ?? 0;

        $gajiPokok = ceil($gajiPokok);
        $tunjanganUmum = ceil($tunjanganUmum);
        $tunjanganLainLain = ceil($tunjanganLainLain);
        $tunjanganFungsional = ceil($tunjanganFungsional);
        // $tunjanganKinerja = ceil($tunjanganKinerja);
        $tunjanganBeras = ceil($tunjanganBeras);
        $tunjanganIstriSuami = ceil($tunjanganIstriSuami);
        $tunjanganAnak = ceil($tunjanganAnak);
        // $tunjanganMakanTotal = ceil($tunjanganMakanTotal);
        // $uangLembur = ceil($uangLembur);

            $gajiKotor = $gajiPokok + $tunjanganUmum + $tunjanganFungsional + $tunjanganLainLain + $tunjanganBeras
                + $tunjanganIstriSuami + $tunjanganAnak;

        // === IWP (Iuran Wajib Pegawai) ===
        // IWP 8%: 8% dari gaji pokok (pensiun dan THT)
        $potonganIwp8 = round($gajiKotor * 0.08);

        // IWP 1%: dari gaji pokok + tunjangan melekat (umum, istri/suami, anak)
        $tunjanganMelekat = $tunjanganUmum + $tunjanganIstriSuami + $tunjanganAnak;
        $potonganIwp1 = round(($gajiKotor + $tunjanganMelekat) * 0.01);

        $iuranBpjsTotal = $gajiPokok * 0.05;
        $iuranBpjsPerusahaan = $gajiPokok * 0.04;
        $iuranBpjsPeserta = $gajiPokok * 0.01;

            Bpjs::updateOrCreate(
                ['employee_id' => $employee->id, 'periode' => $periodeGaji],
                [
                    'iuran_total' => $iuranBpjsTotal,
                    'iuran_perusahaan' => $iuranBpjsPerusahaan,
                    'iuran_peserta' => $iuranBpjsPeserta,
                ]
            );

            $ptkpModel = Ptkp::find($employee->ptkp_id);
            if (!$ptkpModel) {
            ActivityLogger::log(
                    'hitung_gaji_error',
                    "PTKP tidak ditemukan untuk employee_id: $employeeId",                        'error'
                );
            return response()->json(['message' => 'PTKP tidak ditemukan'], 422);
        }

            $ptkp = $ptkpModel->nilai_ptkp;
            $ptkpId = $ptkpModel->id;

            $penghasilanBrutoBulanan = $gajiPokok + $tunjanganUmum + $tunjanganFungsional + $tunjanganLainLain + $tunjanganBeras
            + $tunjanganIstriSuami + $tunjanganAnak;

            $penghasilanBrutoTahunan = $penghasilanBrutoBulanan * 12;

            $penghasilanNetoTahunan = $penghasilanBrutoTahunan;
            $pkp = max(0, $penghasilanNetoTahunan - $ptkp);
            $pkp = floor($pkp / 1000) * 1000;

            $pph21Tahunan = 0;
            $sisaPkp = $pkp;

            $tarifPajak = [
                ['batas' => 60000000, 'tarif' => 0.05],
                ['batas' => 250000000, 'tarif' => 0.15],
                ['batas' => 500000000, 'tarif' => 0.25],
                ['batas' => INF, 'tarif' => 0.30],
            ];

            $batasSebelumnya = 0;
            foreach ($tarifPajak as $lapisan) {
                if ($sisaPkp <= 0) break;
                $lapisanPajak = min($sisaPkp, $lapisan['batas'] - $batasSebelumnya);
                $pph21Tahunan += $lapisanPajak * $lapisan['tarif'];
                $sisaPkp -= $lapisanPajak;
                $batasSebelumnya = $lapisan['batas'];
            }

            Log::info('Debug Gaji', [
            'gajiPokok' => $gajiPokok,
            'tunjanganUmum' => $tunjanganUmum,
            'tunjanganFungsional' => $tunjanganFungsional,
            'tunjanganLainLain' => $tunjanganLainLain,
            'ptkp' => $ptkp,
            'penghasilanBrutoBulanan' => $penghasilanBrutoBulanan,
            'penghasilanBrutoTahunan' => $penghasilanBrutoTahunan,
            'penghasilanNetoTahunan' => $penghasilanNetoTahunan,
        ]);

            $pph21Bulanan = floor(round($pph21Tahunan / 12));
            Log::info('Debug PPH21', [
                'pkp' => $pkp,
                'pph21Tahunan' => $pph21Tahunan,
            ]);
            Tax::updateOrCreate(
                ['employee_id' => $employee->id, 'tahun' => $periodeYear, 'bulan' => $periodeMonth],
                [
                    'ptkp_id' => $ptkpId,
                    'pph21' => $pph21Tahunan,
                    'penghasilan_neto' => $penghasilanNetoTahunan,
                    'penghasilan_kena_pajak' => $pkp,
                    'tahun' => $periodeYear,
                    'bulan' => $periodeMonth,
                ]
            );

        $totalPotongan = $pph21Bulanan + $iuranBpjsPeserta + $potonganIwp1 + $potonganIwp8;

        $gajiBersih = $gajiKotor - $totalPotongan;

        $gajiBersihRounded = ceil($gajiBersih / 100) * 100;

        $selisihPembulatan = $gajiBersihRounded - $gajiBersih;

        $tunjanganPembulatan = max($selisihPembulatan, 0);

        $gajiKotor += $tunjanganPembulatan;

        $gajiBersih = $gajiKotor - $totalPotongan;

            $salary = Salary::updateOrCreate(
                ['employee_id' => $employee->id, 'periode_gaji' => $periodeGajiFull],
                [
                    'gaji_pokok' => $gajiPokok,
                    'tunjangan_umum' => $tunjanganUmum,
                    'tunjangan_fungsional' => $tunjanganFungsional,
                    'tunjangan_lain-lain' => $tunjanganLainLain,
                    'tunjangan_pembulatan' => $tunjanganPembulatan,
                    'tunjangan_beras' => $tunjanganBeras,
                    'tunjangan_istri_suami' => $tunjanganIstriSuami,
                    'tunjangan_anak' => $tunjanganAnak,
                    'gaji_kotor' => $gajiKotor,
                    'potongan_pph21' => $pph21Bulanan,
                    'potongan_bpjs' => $iuranBpjsPeserta,
                    'potongan_iwp_8' => $potonganIwp8,
                    'potongan_iwp_1' => $potonganIwp1,
                    'potongan_lain' => 0,
                    'total_potongan' => $totalPotongan,
                    'gaji_bersih' => $gajiBersih,
                ]
            );

            $gajiSebelumnya = Salary::where('employee_id', $employee->id)
                ->where('periode_gaji', '<', $periodeGajiFull)
                ->orderBy('periode_gaji', 'desc')
                ->first();

            if ($gajiSebelumnya) {
            $gajiLama = $gajiSebelumnya->gaji_pokok;
            $gajiBaru = $gajiPokok;

            if ($gajiLama != $gajiBaru) {
                $selisih = $gajiBaru - $gajiLama;
                $persentaseKenaikan = $gajiLama > 0 ? ($selisih / $gajiLama) * 100 : null;
                    SalaryRaise::create([
                    'employee_id' => $employee->id,
                    'gajiLama' => $gajiLama,
                    'gajiBaru' => $gajiBaru,
                    'persentaseKenaikan' => $persentaseKenaikan,
                    'alasan' => 'Perubahan gaji pokok otomatis berdasarkan golongan/MKG terbaru',
                    'tanggalKenaikan' => now()->toDateString(),
                ]);
            }
        }
            ActivityLogger::log(
                'hitung_gaji',
                "Sukses menghitung gaji employee_id: $employee->id, periode: $periodeGaji, gaji_bersih: $gajiBersih"
            );

            \Log::info('Berhasil generate gaji untuk employee_id: ' . $employee->id . ', salary_id: ' . $salary->id);
            $results[$employee->id] = ['success' => true, 'salary_id' => $salary->id];
        } catch (\Exception $e) {
            \Log::error('Error generate gaji employee_id: ' . $employee->id . ' - ' . $e->getMessage());
            ActivityLogger::log('generate_salary_error', "Error generate gaji employee_id: {$employee->id} - {$e->getMessage()}", 'error');
            $results[$employee->id] = ['error' => $e->getMessage()];
        }

    }

    ActivityLogger::log('generate_all_salaries_end', "Selesai generate gaji periode {$periodeGaji}");
    ActivityLogger::log('generate_all_salaries_success', "Berhasil generate gaji untuk seluruh karyawan periode {$periodeGaji}");

    return response()->json([
    'success' => true,
    'message' => 'Proses generate gaji selesai.',
    'data' => $results
]);
}

public function checkExistingSalary(Request $request)
{
    $request->validate([
        'periode_gaji' => 'required|date_format:Y-m',
        'employee_id' => 'nullable|integer',
    ]);

    $periodeGajiFull = $request->periode_gaji . '-01';

    $query = Salary::where('periode_gaji', $periodeGajiFull);

    if ($request->employee_id) {
        $query->where('employee_id', $request->employee_id);
    }

    $exists = $query->exists();

    return response()->json(['exists' => $exists]);
}

public function checkExistingSalaryAll(Request $request)
{
    $request->validate([
        'periode_gaji' => 'required|date_format:Y-m'
    ]);

    $periode = $request->periode_gaji . '-01';
    $exists = Salary::where('periode_gaji', $periode)->exists();

    return response()->json(['exists' => $exists]);
}

    public function showGenerate(Request $request)
{
    $employees = Employee::with('ptkp')->get();
    $periodeGaji = $request->input('periode_gaji');

    $salaries = [];

    if ($periodeGaji) {
        $salaries = Salary::with('employee')
            ->where('periode_gaji', $periodeGaji)
            ->get();
    }

    return view('pages.payroll.generate', compact('employees', 'salaries', 'periodeGaji'));
}

public function exportKustomPDF($id)
{
    $salary =  Salary::with('employee')->findOrFail($id);

    $pdf = Pdf::loadView('pages.pdf.slip-gaji-kustom', compact('salary'))
              ->setPaper('A4', 'portrait');

    $filename = 'Slip_Gaji_' . str_replace(' ', '_', $salary->employee->nama) . '.pdf';

    return $pdf->download($filename);
}

public function destroy($id)
{
    $salary = Salary::findOrFail($id);
    $salary->delete();

    return redirect()->back()->with('success', 'Data gaji berhasil dihapus.');
}

public function edit($id)
{
    $salary = Salary::with('employee')->findOrFail($id);

    \Log::info('Edit Salary Page Accessed', ['salary_id' => $id, 'employee' => $salary->employee]);

    return view('pages.payroll.payroll-result', compact('salary'));
}

public function updatetunjanganlainlain(Request $request, $id)
{
    $request->validate([
        'tunjangan_lain_lain' => 'nullable|numeric|min:0',
        'periode_gaji' => 'required|date_format:Y-m',
    ]);

    $salary = Salary::findOrFail($id);

    if (\Carbon\Carbon::parse($salary->periode_gaji)->format('Y-m') !== $request->periode_gaji) {
        return response()->json(['message' => 'Periode gaji tidak sesuai dengan data yang ada'], 400);
    }

    $tunjanganLainLainLama = $salary->tunjangan_lain_lain ?? 0;
    $tunjanganLainLainBaru = $request->tunjangan_lain_lain ?? 0;

    $selisih = $tunjanganLainLainBaru - $tunjanganLainLainLama;

    logger()->info('DEBUG: KOMPUTASI TUNJANGAN LAIN', [
        'tunjangan_lain_lain_lama' => $tunjanganLainLainLama,
        'tunjangan_lain_lain_baru' => $tunjanganLainLainBaru,
        'selisih' => $selisih,
        'gaji_kotor_sebelum' => $salary->gaji_kotor,
        'gaji_bersih_sebelum' => $salary->gaji_bersih,
    ]);

    $salary->tunjangan_lain_lain = $tunjanganLainLainBaru;
    $salary->gaji_kotor += $selisih;
    $salary->gaji_bersih += $selisih;
    $salary->save();

    return response()->json([
        'message' => 'Tunjangan lain-lain berhasil diperbarui tanpa mengubah komponen lain',
        'tunjangan_lain_lain' => $tunjanganLainLainBaru,
        'gaji_kotor' => $salary->gaji_kotor,
        'gaji_bersih' => $salary->gaji_bersih,
    ]);
}

}
