<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\Tax;
use App\Models\Bpjs;
use App\Models\Absensi;
use App\Models\SalaryLog;
use App\Models\SalaryRaise;
use Illuminate\Support\Facades\Auth;
use App\Models\Ptkp;
use App\Models\UangLembur;
use App\Models\UangMakan;
use App\Models\TunjanganFungsional;
use App\Models\TunjanganKinerja;
use App\Models\TunjanganUmum;
use App\Models\GajiPokokPns;


// use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
// public function index(Request $request)
// {
//     $user = auth()->user();

//     $search = $request->input('search');

//     $query = Salary::with('employee');

//     // Jika ingin hanya menampilkan gaji employee login (misal staff)
//     if ($user->employee) {
//         $query->where('employee_id', $user->employee->id);
//     }

//     // Jika ada filter search nama karyawan
//     if ($search) {
//         $query->whereHas('employee', function ($q) use ($search) {
//             $q->where('nama', 'like', '%' . $search . '%');
//         });
//     }

//     $salaries = $query->orderBy('periode_gaji', 'desc')
//                       ->latest('created_at')
//                       ->get();

//     return view('pages.payroll.index', compact('salaries'));
// }


    public function create()
    {
        $employees = Employee::all();
        $ptkps = Ptkp::all();
        return view('pages.payroll.create', compact('employees', 'ptkps'));
    }

//     public function mySalary(Request $request)
// {
//     $user = auth()->user();

//     if (!$user->employee) {
//         abort(403, 'Anda tidak punya data gaji.');
//     }

//     $search = $request->input('search');

//     $query = Salary::with('employee')
//         ->where('employee_id', $user->employee->id);

//     if ($search) {
//         $query->whereHas('employee', function ($q) use ($search) {
//             $q->where('nama', 'like', '%' . $search . '%');
//         });
//     }

//     $salaries = $query->orderBy('periodeGaji', 'desc')
//                       ->latest('created_at')
//                       ->paginate(10); // Ganti dari ->get() ke ->paginate()

//     return view('pages.payroll.salary-user', compact('salaries'));
// }

function getGolonganUtama($golongan)
{
    // Misal golongan = "III/b" atau "II/a"
    // kita ambil hanya bagian romawi, sebelum slash
    $parts = explode('/', $golongan);
    return strtoupper(trim($parts[0])); // misal "III"
}


// public function hitungGaji(Request $request)
// {
//     try {
//         // Validasi input
//         $request->validate([
//             'employee_id' => 'required|exists:employees,id',
//             'periode_gaji' => 'required|date_format:Y-m',
//         ]);

//         $employeeId = $request->employee_id;
//         $periodeGaji = $request->periode_gaji; // format YYYY-MM

//         $employee = Employee::with('anak')->findOrFail($employeeId);

//         // Fungsi bantu untuk ambil golongan utama (bagian sebelum '/')
//         $getGolonganUtama = function($golongan) {
//             $parts = explode('/', $golongan);
//             return strtoupper(trim($parts[0]));
//         };

//         $golonganUtama = $getGolonganUtama($employee->golongan);
//         Log::info("Golongan utama employee: " . $golonganUtama);
//         $jabatanFungsional = $employee->jabatan_fungsional;
//         $mkg = $employee->masa_kerja_golongan;

//         // Ambil gaji pokok dengan pencocokan golongan (like %golonganUtama%)
//         // Contoh: jika di DB golongan pakai format "PNS-III/b"
//         $gajiPokokData = GajiPokokPns::where('golongan', 'like', '%' . $golonganUtama . '%')
//                         ->where('mkg', '<=', $mkg)
//                         ->orderBy('mkg', 'desc')
//                         ->first();

//         $gajiPokok = $gajiPokokData ? $gajiPokokData->nominal : 0;

//         // Ambil tunjangan umum sesuai golongan utama (misal: "III")
//         $tunjanganUmumData = TunjanganUmum::where('golongan', $golonganUtama)->first();
//         $tunjanganUmum = $tunjanganUmumData ? $tunjanganUmumData->tunjangan : 0;

//         // Ambil tunjangan fungsional sesuai jabatan fungsional
//         $tunjanganFungsionalData = TunjanganFungsional::where('jabatan_fungsional', $jabatanFungsional)->first();
//         $tunjanganFungsional = $tunjanganFungsionalData ? $tunjanganFungsionalData->tunjangan : 0;

//         // Parse tahun dan bulan dari periode_gaji (format Y-m)
//         $tahunSekarang = date('Y', strtotime($periodeGaji . '-01'));
//         $bulanSekarang = date('m', strtotime($periodeGaji . '-01'));

//         // Hitung jumlah hadir di bulan itu
//         $jumlahHadir = Absensi::where('employee_id', $employee->id)
//             ->where('statusKehadiran', 'Hadir')
//             ->whereYear('tanggalKehadiran', $tahunSekarang)
//             ->whereMonth('tanggalKehadiran', $bulanSekarang)
//             ->count();

//         // Uang makan sesuai golongan utama
//         $uangMakanData = UangMakan::where('golongan', $golonganUtama)->first();
//         $nominalUangMakan = $uangMakanData ? $uangMakanData->nominal : 0;
//         $tunjanganMakanTotal = $jumlahHadir * $nominalUangMakan;

//         // Uang lembur sesuai golongan utama
//         $uangLemburData = UangLembur::where('golongan', $golonganUtama)->first();
//         $uangLembur = $uangLemburData ? $uangLemburData->nominal : 0;

//         // Tunjangan istri/suami 10% dari gaji pokok jika status menikah
//         $tunjanganIstriSuami = $employee->status_menikah ? 0.10 * $gajiPokok : 0;

//         // Hitung tunjangan anak yang berhak
//         $jumlahAnakBerhak = 0;
//         foreach ($employee->anak as $anak) {
//             if (!$anak->sudah_kawin &&
//                 $anak->umur < 21 &&
//                 !$anak->punya_penghasilan &&
//                 $anak->menjadi_tanggungan) {
//                 $jumlahAnakBerhak++;
//             }
//         }
//         $tunjanganAnak = $jumlahAnakBerhak * 0.02 * $gajiPokok;

//         // Tunjangan kinerja sesuai kelas jabatan
//         $kelasJabatanId = $employee->kelas_jabatan_id;
//         $tunjanganKinerjaData = TunjanganKinerja::where('kelas_jabatan_id', $kelasJabatanId)->first();
//         $tunjanganKinerja = $tunjanganKinerjaData ? $tunjanganKinerjaData->tunjangan : 0;

//         // Hitung gaji kotor
//         $gajiKotor = $gajiPokok + $tunjanganUmum + $tunjanganFungsional + $tunjanganKinerja
//             + $tunjanganIstriSuami + $tunjanganAnak + $tunjanganMakanTotal + $uangLembur;

//         // Placeholder potongan
//         $potonganPph21 = 0;
//         $potonganBpjs = 0;
//         $potonganLain = 0;

//         $totalPotongan = $potonganPph21 + $potonganBpjs + $potonganLain;

//         $gajiBersih = $gajiKotor - $totalPotongan;

//         // Simpan data gaji
//         $salary = Salary::create([
//             'employee_id' => $employeeId,
//             'periode_gaji' => $periodeGaji,
//             'gaji_pokok' => $gajiPokok,
//             'tunjangan_umum' => $tunjanganUmum,
//             'tunjangan_fungsional' => $tunjanganFungsional,
//             'tunjangan_kinerja' => $tunjanganKinerja,
//             'tunjangan_istri_suami' => $tunjanganIstriSuami,
//             'tunjangan_anak' => $tunjanganAnak,
//             'uang_makan' => $tunjanganMakanTotal,
//             'uang_lembur' => $uangLembur,
//             'gaji_kotor' => $gajiKotor,
//             'potongan_pph21' => $potonganPph21,
//             'potongan_bpjs' => $potonganBpjs,
//             'potongan_lain' => $potonganLain,
//             'total_potongan' => $totalPotongan,
//             'gaji_bersih' => $gajiBersih,
//         ]);

//         return response()->json([
//             'message' => 'Gaji berhasil dihitung dan disimpan',
//             'data' => $salary,
//         ]);

//     } catch (\Exception $e) {
//         return response()->json([
//             'message' => 'Terjadi kesalahan saat menghitung gaji',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }




public function showGenerate()
{
    $employees = Employee::all(); // misalnya kamu ingin memilih karyawan
    return view('pages.payroll.generate', compact('employees'));
}



public function store(Request $request)
{
    $validatedData = $request->validate([
        'employee_id' => 'required|exists:employee,id',
        'periodeGaji' => ['required', 'regex:/^\d{4}-\d{2}$/'],
        'gajiPokok' => 'required|numeric|min:0',
        'tunjanganMakan' => 'required|numeric|min:0',
        'tunjanganKesehatan' => 'required|numeric|min:0',
        'tukin' => 'nullable|numeric|min:0',
        'bonus' => 'required|numeric|min:0',
        'insentif' => 'required|numeric|min:0',
        'lembur' => 'required|numeric|min:0',
        'ptkp' => ['required', 'string', 'in:TK/0,TK/1,TK/2,TK/3,K/0,K/1,K/2,K/3'],
        'iuranKaryawan' => 'required|numeric|min:0',
        'iuranPerusahaan' => 'required|numeric|min:0',
    ]);

    $employee = Employee::findOrFail($validatedData['employee_id']);

    $periodeGajiDate = $validatedData['periodeGaji'] . '-01';
    $periodeYear = date('Y', strtotime($periodeGajiDate));
    $periodeMonth = date('m', strtotime($periodeGajiDate));

    // Cek duplikat data gaji per employee dan periode
    $exists = Salary::where('employee_id', $employee->id)
        ->whereYear('periodeGaji', $periodeYear)
        ->whereMonth('periodeGaji', $periodeMonth)
        ->exists();

    if ($exists) {
        return redirect()->route('salary.index')
            ->with('warning', 'Data gaji untuk karyawan ini pada periode ini sudah ada.');
    }

    // Ambil nilai PTKP
    $ptkpModel = Ptkp::where('kode_ptkp', $validatedData['ptkp'])->first();
    if (!$ptkpModel) {
        return back()->withErrors(['ptkp' => 'Kode PTKP tidak ditemukan di database.']);
    }
    $ptkp = $ptkpModel->nilai_ptkp;
    $ptkpId = $ptkpModel->id;

    // Hitung masa kerja dalam tahun
    $masaKerja = $employee->tanggalMasuk
        ? now()->diffInYears(\Carbon\Carbon::parse($employee->tanggalMasuk))
        : 0;

    $gajiPokokAwal = $validatedData['gajiPokok'];
    $gajiPokokBaru = $gajiPokokAwal;

    // Logika kenaikan gaji 10% tiap 2 tahun masa kerja
    if ($masaKerja >= 2) {
        $kelipatan = floor($masaKerja / 2);
        $persenKenaikan = 0.10 * $kelipatan;
        $gajiPokokBaru = $gajiPokokAwal * (1 + $persenKenaikan);

        SalaryRaise::create([
            'employee_id' => $employee->id,
            'gajiLama' => $gajiPokokAwal,
            'gajiBaru' => $gajiPokokBaru,
            'persentaseKenaikan' => round($persenKenaikan * 100, 2),
            'alasan' => 'Kenaikan berkala sesuai masa kerja',
            'tanggalKenaikan' => now()->toDateString(),
        ]);

        session()->flash('info', 'Gaji pokok naik otomatis sebesar ' . round($persenKenaikan * 100) . '% karena masa kerja.');
    }

    // Tunjangan transportasi berdasarkan jabatan
    $jabatan = strtolower($employee->jabatan ?? '');
    $tunjanganTransportasi = match ($jabatan) {
        'rektor' => 50000,
        'wakil rektor' => 25000,
        'dosen' => 10000,
        default => 10000,
    };

    // Hitung tukin (tunjangan kinerja) berdasarkan jabatan
    // Ambil dari input jika ada, jika tidak hitung otomatis
    $tukin = $request->filled('tukin')
        ? $validatedData['tukin']
        : match ($jabatan) {
            'rektor' => 2000000,
            'wakil rektor' => 1500000,
            'dosen' => 1000000,
            default => 500000,
        };

    // untuk pengujian
    $bulanSekarang = 4;
    $tahunSekarang = 2025;

    // Hitung jumlah hadir di bulan periode
    $jumlahHadir = Absensi::where('employee_id', $employee->id)
        ->where('statusKehadiran', 'Hadir')
        ->whereYear('tanggalKehadiran', $tahunSekarang)
        ->whereMonth('tanggalKehadiran', $bulanSekarang)
        ->count();

    // Hitung tunjangan makan total (jumlah hadir x tunjangan makan)
    $tunjanganMakanTotal = $jumlahHadir * $validatedData['tunjanganMakan'];

    // Hitung penghasilan bruto bulanan
    $penghasilanBrutoBulanan =
        $gajiPokokBaru +
        $tunjanganTransportasi +
        $tunjanganMakanTotal +
        $validatedData['tunjanganKesehatan'] +
        $validatedData['bonus'] +
        $validatedData['insentif'] +
        $validatedData['lembur'] +
        $tukin;

    // Penghasilan bruto tahunan
    $penghasilanBrutoTahunan = $penghasilanBrutoBulanan * 12;

    // Hitung biaya jabatan per bulan (5% dari bruto bulanan, max 500.000)
    $biayaJabatanBulanan = min(0.05 * $penghasilanBrutoBulanan, 500000);

    // Hitung biaya jabatan (5% dari penghasilan bruto tahunan, max 6 juta)
    $biayaJabatanTahunan = min(0.05 * $penghasilanBrutoTahunan, 6000000);

    // Hitung iuran pensiun tahunan (ambil dari input iuranKaryawan dan iuranPerusahaan)
    $iuranPensiunBulanan = 100000;
    $iuranPensiunTahunan = $iuranPensiunBulanan * 12;

    // Penghasilan neto tahunan
    $penghasilanNetoTahunan = $penghasilanBrutoTahunan - $biayaJabatanTahunan - $iuranPensiunTahunan;

    // Hitung PKP (Penghasilan Kena Pajak)
    $pkp = max(0, $penghasilanNetoTahunan - $ptkp);
    // Bulatkan ke ribuan terdekat ke bawah
    $pkp = floor($pkp / 1000) * 1000;

    // Hitung PPh21 tahunan dengan tarif progresif
    $pph21Tahunan = 0;
    $sisaPkp = $pkp;

    // Tarif pajak berdasarkan lapisan PKP
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


    $pph21Bulanan = $pph21Tahunan / 12;
    $totalPotongan = $pph21Bulanan + $iuranPensiunBulanan + $biayaJabatanBulanan;

    // Simpan data ke tabel salary
    Salary::create([
        'employee_id' => $employee->id,
        'periodeGaji' => $validatedData['periodeGaji'] . '-01',
        'gajiPokok' => $gajiPokokBaru,
        'tunjanganTransportasi' => $tunjanganTransportasi,
        'tunjanganMakan' => $tunjanganMakanTotal,
        'tunjanganKesehatan' => $validatedData['tunjanganKesehatan'],
        'tukin' => $tukin, // <-- tambahkan ini
        'bonus' => $validatedData['bonus'],
        'insentif' => $validatedData['insentif'],
        'lembur' => $validatedData['lembur'],
        'biayaJabatan' => $biayaJabatanTahunan / 12,
        'iuranPensiun' => $iuranPensiunBulanan,
        'totalPotongan' => $totalPotongan,
        'totalGaji' => $penghasilanBrutoBulanan - $pph21Bulanan - $biayaJabatanBulanan - $iuranPensiunBulanan,
    ]);

    Tax::create([
        'employee_id' => $employee->id,
        'ptkp_id' => $ptkpId,
        'pph21' => $pph21Tahunan,
        'penghasilan_neto' => $penghasilanNetoTahunan,
        'biaya_jabatan' => $biayaJabatanTahunan,
        'iuran_pensiun' => $iuranPensiunTahunan,
        'penghasilan_kena_pajak' => $pkp,
        'tahun' => $periodeYear,
        'bulan' => $periodeMonth,
    ]);

    return redirect()->route('salary.index')->with('success', 'Data gaji dan pajak berhasil disimpan.');
}

private function calculatePph21($pkp)
{
    $pph = 0;
    $remaining = $pkp;

    $brackets = [
        ['limit' => 60000000, 'rate' => 0.05],
        ['limit' => 250000000, 'rate' => 0.15],
        ['limit' => 500000000, 'rate' => 0.25],
        ['limit' => INF, 'rate' => 0.30],
    ];

    $previousLimit = 0;

    foreach ($brackets as $bracket) {
        if ($remaining <= 0) break;

        $taxable = min($remaining, $bracket['limit'] - $previousLimit);
        $pph += $taxable * $bracket['rate'];

        $remaining -= $taxable;
        $previousLimit = $bracket['limit'];
    }

    return round($pph, 2);
}

// Fungsi helper PTKP
private function getPTKP(string $status, int $tanggungan): int
{
    $ptkpTable = [
        'TK' => [0 => 54000000, 1 => 58500000, 2 => 63000000, 3 => 67500000],
        'K'  => [0 => 58500000, 1 => 63000000, 2 => 67500000, 3 => 72000000],
    ];

    $tanggungan = min($tanggungan, 3); // Maksimum 3 tanggungan

    return $ptkpTable[$status][$tanggungan] ?? 54000000; // Default TK/0
}



//     public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'employee_id' => 'required|exists:employee,id',
//         'periodeGaji' => ['required', 'regex:/^\d{4}-\d{2}$/'], // format YYYY-MM
//         'gajiPokok' => 'required|numeric',
//         'tunjanganMakan' => 'required|numeric',
//         'tunjanganKesehatan' => 'required|numeric',
//         'bonus' => 'required|numeric',
//         'insentif' => 'required|numeric',
//         'lembur' => 'required|numeric',
//         'pph21' => 'required|numeric',
//         'iuranKaryawan' => 'required|numeric',
//         'iuranPerusahaan' => 'required|numeric',
//     ]);

//     $employee = Employee::findOrFail($validatedData['employee_id']);

//     // --- Cegah gaji dobel di bulan yang sama ---
//     // $periodeMonth = 5; // Untuk testing, ganti ke date('m') jika di produksi
//     // $periodeYear = 2025;

//     // Ubah $periodeGajiDate ke tanggal 1 setiap bulan
//     $periodeGajiDate = $validatedData['periodeGaji'] . '-01';

//     $periodeYear = date('Y', strtotime($periodeGajiDate));
//     $periodeMonth = date('m', strtotime($periodeGajiDate));

//     $gajiExist = Salary::where('employee_id', $employee->id)
//         ->whereYear('periodeGaji', $periodeYear)
//         ->whereMonth('periodeGaji', $periodeMonth)
//         ->exists();

//     if ($gajiExist) {
//         return redirect()->route('salary.index')
//             ->with('warning', 'Data gaji untuk karyawan ini pada periode ini sudah ada. Tidak boleh duplikat.');
//     }


//     $masaKerja = $employee->masaKerja ?? now()->diffInYears($employee->tanggalMasuk);
//     $gajiAwal = $validatedData['gajiPokok'];
//     $gajiPokokBaru = $gajiAwal;
//     $alasanKenaikan = '';

//     // Tambah kenaikan berkala setiap 2 tahun (10% per 2 tahun)
//     if ($masaKerja >= 2) {
//         $kenaikanBerkala = floor($masaKerja / 2);
//         $persenKenaikan = 0.10 * $kenaikanBerkala;
//         $gajiSetelahNaik = $gajiAwal * (1 + $persenKenaikan);

//         if ($gajiSetelahNaik > $gajiAwal) {
//             $alasanKenaikan = 'Kenaikan berkala sesuai masa kerja';
//             $gajiPokokBaru = $gajiSetelahNaik;

//             SalaryRaise::create([
//                 'employee_id' => $employee->id,
//                 'gajiLama' => $gajiAwal,
//                 'gajiBaru' => $gajiPokokBaru,
//                 'persentaseKenaikan' => round($persenKenaikan * 100, 2),
//                 'alasan' => $alasanKenaikan,
//                 'tanggalKenaikan' => now()->toDateString(),

//             ]);
//                  session()->flash('info', 'Gaji pokok naik otomatis sebesar ' . round($persenKenaikan * 100) . '% karena masa kerja.');
//         }
//     }

//         // Tunjangan transportasi berdasarkan jabatan
//     $tunjanganTransportasi = match (strtolower($employee->jabatan)) {
//         'rektor' => 50000,
//         'wakil rektor' => 25000,
//         'dosen' => 10000,
//         default => 10000,
//     };

//     //hitungan tunjangan makan berdasarkan bulan periode sekarang
//     // $bulanSekarang = (int)$periodeMonth;
//     // $tahunSekarang = (int)$periodeYear;


//     // untuk pengujian
//     $bulanSekarang = 4;
//     $tahunSekarang = 2025;

//     // Ambil jumlah hari hadir pada bulan dan tahun tersebut
//     $jumlahHadir = Absensi::where('employee_id', $validatedData['employee_id'])
//         ->where('statusKehadiran', 'Hadir')
//         ->whereMonth('tanggalKehadiran', $bulanSekarang)
//         ->whereYear('tanggalKehadiran', $tahunSekarang)
//         ->count();

//     // Hitung tunjangan makan berdasarkan jumlah hadir
//     $tunjanganMakanTotal = $jumlahHadir * $validatedData['tunjanganMakan'];

//     // Hitung total potongan
//     $totalPotongan = $validatedData['pph21'] + $validatedData['iuranKaryawan'] + $validatedData['iuranPerusahaan'];

//     // Hitung total gaji
//     $totalGaji = $gajiPokokBaru +
//         $tunjanganTransportasi +
//         $tunjanganMakanTotal +
//         $validatedData['tunjanganKesehatan'] +
//         $validatedData['bonus'] +
//         $validatedData['insentif'] +
//         $validatedData['lembur'] -
//         $totalPotongan;

//     // Simpan data ke tabel salary
//     $salary = new Salary();
//     $salary->employee_id = $validatedData['employee_id'];
//     $salary->periodeGaji = $periodeGajiDate;
//     $salary->gajiPokok = $gajiPokokBaru;
//     $salary->tunjanganTransportasi = $tunjanganTransportasi;
//     $salary->tunjanganMakan = $tunjanganMakanTotal;
//     $salary->tunjanganKesehatan = $validatedData['tunjanganKesehatan'];
//     $salary->bonus = $validatedData['bonus'];
//     $salary->insentif = $validatedData['insentif'];
//     $salary->lembur = $validatedData['lembur'];
//     $salary->totalPotongan = $totalPotongan;
//     $salary->totalGaji = $totalGaji;


//     $salary->save();

//     // Simpan data PPh21 ke tabel tax
//     $tax = new Tax();
//     $tax->employee_id = $validatedData['employee_id'];
//     $tax->pph21 = $validatedData['pph21'];
//     $tax->save();

//     // Simpan data BPJS ke tabel bpjs
//     $bpjs = new BPJS();
//     $bpjs->employee_id = $validatedData['employee_id'];
//     $bpjs->iuranKaryawan = $validatedData['iuranKaryawan'];
//     $bpjs->iuranPerusahaan = $validatedData['iuranPerusahaan'];
//     $bpjs->save();

//     return redirect()->route('salary.index')->with('success', 'Data gaji berhasil disimpan!');
// }

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'gajiPokok' => 'required|numeric',
        'tunjanganMakan' => 'required|numeric', // nilai default per hari
        'tunjanganKesehatan' => 'required|numeric',
        'bonus' => 'required|numeric',
        'insentif' => 'required|numeric',
        'lembur' => 'required|numeric',
        'pph21' => 'required|numeric',
        'iuranKaryawan' => 'required|numeric',
        'iuranPerusahaan' => 'required|numeric',
    ]);

    $salary = Salary::findOrFail($id);

    $employee = Employee::findOrFail($salary->employee_id);
    $masaKerja = $employee->masaKerja ?? now()->diffInYears($employee->tanggalMasuk);

    $gajiAwal = $validatedData['gajiPokok'];
    $gajiPokokBaru = $gajiAwal;
    $alasanKenaikan = '';

    // Tambah kenaikan berkala setiap 2 tahun (10% per 2 tahun)
    if ($masaKerja >= 2) {
        $kenaikanBerkala = floor($masaKerja / 2);
        $persenKenaikan = 0.10 * $kenaikanBerkala;
        $gajiSetelahNaik = $gajiAwal * (1 + $persenKenaikan);

        if ($gajiSetelahNaik > $gajiAwal) {
            $alasanKenaikan = 'Kenaikan berkala masa kerja';
            $gajiPokokBaru = $gajiSetelahNaik;

            SalaryRaise::create([
                'employee_id' => $employee->id,
                'gajiLama' => $gajiAwal,
                'gajiBaru' => $gajiPokokBaru,
                'persentaseKenaikan' => round($persenKenaikan * 100, 2),
                'alasan' => $alasanKenaikan,
                'tanggalKenaikan' => now()->toDateString(),
            ]);
             session()->flash('info', 'Gaji pokok naik otomatis sebesar ' . round($persenKenaikan * 100) . '% karena masa kerja.');
        }
    }

            // Tunjangan transportasi berdasarkan jabatan
    $tunjanganTransportasi = match (strtolower($employee->jabatan)) {
        'Rektor' => 50000,
        'Wakil Rektor' => 25000,
        'Dosen' => 10000,
        default => 10000,
    };

    // Hitung jumlah hadir
    $bulanSekarang = date('m');
    $tahunSekarang = date('Y');

    $jumlahHadir = Absensi::where('employee_id', $employee->id)
        ->where('statusKehadiran', 'Hadir')
        ->whereMonth('tanggalKehadiran', $bulanSekarang)
        ->whereYear('tanggalKehadiran', $tahunSekarang)
        ->count();

    $tunjanganMakanTotal = $jumlahHadir * $validatedData['tunjanganMakan'];
    $totalPotongan = $validatedData['pph21'] + $validatedData['iuranKaryawan'] + $validatedData['iuranPerusahaan'];

    $totalGaji = $gajiPokokBaru +
        $tunjanganTransportasi +
        $tunjanganMakanTotal +
        $validatedData['tunjanganKesehatan'] +
        $validatedData['bonus'] +
        $validatedData['insentif'] +
        $validatedData['lembur'] -
        $totalPotongan;

        $fieldsToCheck = [
            'gajiPokok' => $gajiPokokBaru,
            'tunjanganMakan' => $tunjanganMakanTotal,
            'tunjanganKesehatan' => $validatedData['tunjanganKesehatan'],
            'bonus' => $validatedData['bonus'],
            'insentif' => $validatedData['insentif'],
            'lembur' => $validatedData['lembur'],
            'totalPotongan' => $totalPotongan,
            'totalGaji' => $totalGaji,
        ];

    foreach ($fieldsToCheck as $field => $newValue) {
        $oldValue = $salary->$field;
        if ((float) $oldValue !== (float) $newValue) {
            SalaryLog::create([
                'salary_id' => $salary->id,
                'employee_id' => $employee->id,
                'field' => $field,
                'old_value' => $oldValue,
                'new_value' => $newValue,
                'alasan' => 'Perubahan manual oleh admin',
            ]);
        }
    }


    // Update salary
    $salary->gajiPokok = $gajiPokokBaru;
    $salary->tunjanganTransportasi = $tunjanganTransportasi;
    $salary->tunjanganMakan = $tunjanganMakanTotal;
    $salary->tunjanganKesehatan = $validatedData['tunjanganKesehatan'];
    $salary->bonus = $validatedData['bonus'];
    $salary->insentif = $validatedData['insentif'];
    $salary->lembur = $validatedData['lembur'];
    $salary->totalPotongan = $totalPotongan;
    $salary->totalGaji = $totalGaji;
    $salary->save();

    // Update atau insert Tax
    $tax = Tax::firstOrNew(['employee_id' => $employee->id]);
    $tax->pph21 = $validatedData['pph21'];
    $tax->save();

    // Update atau insert BPJS
    $bpjs = Bpjs::firstOrNew(['employee_id' => $employee->id]);
    $bpjs->iuranKaryawan = $validatedData['iuranKaryawan'];
    $bpjs->iuranPerusahaan = $validatedData['iuranPerusahaan'];
    $bpjs->save();

    return redirect()->route('salary.index')->with('success', 'Data gaji berhasil diperbarui!');
}


    public function destroy($id)
    {
        Salary::destroy($id);
        return redirect()->route('salary.index')->with('success', 'Data gaji berhasil dihapus.');
    }

    private function validateData($request)
    {
        return $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'gajiPokok' => 'required|numeric',
            'tunjanganTransportasi' => 'required|numeric',
            'tunjanganMakan' => 'required|numeric',
            'tunjanganKesehatan' => 'required|numeric',
            'bonus' => 'required|numeric',
            'insentif' => 'required|numeric',
            'lembur' => 'required|numeric',
        ]);
    }

    private function calculateTotalSalary($data, $totalPotongan)
    {
        // Total salary dihitung dengan menambahkan semua tunjangan, bonus, dan insentif, kemudian mengurangi total potongan
        return (
            $data['gajiPokok'] +
            $data['tunjanganTransportasi'] +
            $data['tunjanganMakan'] +
            $data['tunjanganKesehatan'] +
            $data['bonus'] +
            $data['insentif'] +
            $data['lembur']
        ) - $totalPotongan;
    }
public function salaryHistoryUser(Request $request)
{
    $employeeId = Auth::user()->employee_id;

    // Filter riwayat gaji milik user login
    $salaryHistoryQuery = Salary::with('employee')->where('employee_id', $employeeId);

    if ($request->filled('filter_bulan')) {
        $salaryHistoryQuery->whereMonth('periodeGaji', $request->filter_bulan);
    }

    if ($request->filled('filter_tahun')) {
        $salaryHistoryQuery->whereYear('periodeGaji', $request->filter_tahun);
    }

    $salaryHistory = $salaryHistoryQuery->orderByDesc('created_at')->paginate(10);

    // Filter riwayat perubahan gaji milik user login
    $salaryLogQuery = SalaryLog::with('employee')->where('employee_id', $employeeId);

    if ($request->filled('bulan')) {
        $salaryLogQuery->whereMonth('created_at', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $salaryLogQuery->whereYear('created_at', $request->tahun);
    }

    $salaryLogs = $salaryLogQuery->orderByDesc('created_at')->paginate(10);

    return view('pages.payroll.salary-history-user', compact('salaryHistory', 'salaryLogs'));
}

public function salaryHistory(Request $request)
{
    // Filter untuk riwayat gaji (salaryHistory)
    $salaryHistoryQuery = Salary::with('employee');

    if ($request->filled('search_nama')) {
        $salaryHistoryQuery->whereHas('employee', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search_nama . '%');
        });
    }

    if ($request->filled('filter_bulan')) {
        $salaryHistoryQuery->whereMonth('periodeGaji', $request->filter_bulan);
    }

    if ($request->filled('filter_tahun')) {
        $salaryHistoryQuery->whereYear('periodeGaji', $request->filter_tahun);
    }

    $salaryHistory = $salaryHistoryQuery->orderByDesc('created_at')->paginate(10);


    // Filter untuk riwayat perubahan gaji (salaryLogs)
    $salaryLogQuery = SalaryLog::with('employee');

    if ($request->filled('nama')) {
        $salaryLogQuery->whereHas('employee', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->nama . '%');
        });
    }

    if ($request->filled('filter_bulan')) {
        $salaryHistoryQuery->whereMonth('periodeGaji', $request->filter_bulan);
    }

    if ($request->filled('filter_tahun')) {
        $salaryHistoryQuery->whereYear('periodeGaji', $request->filter_tahun);
    }

    $salaryLogs = $salaryLogQuery->orderBy('created_at', 'desc')->paginate(10);

    return view('pages.payroll.salary-history', compact('salaryHistory', 'salaryLogs'));
}

public function getSalaryLogsAjax(Request $request)
{
    $query = SalaryLog::with('employee');

    if ($request->filled('search')) {
        $query->whereHas('employee', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%');
        });
    }

    $salaryLogs = $query->orderBy('created_at', 'desc')->paginate(10);

    return response()->json($salaryLogs);
}


}
