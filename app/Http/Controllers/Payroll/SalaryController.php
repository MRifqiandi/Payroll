<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\Tax;
use App\Models\Bpjs;
use App\Models\Absensi;
use App\Models\SalaryLog;
use App\Models\SalaryRaise;
use App\Models\Ptkp;
use App\Models\Ter;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');
        $salaries = Salary::with(['employee'])
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('employee', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('periodeGaji', 'desc')
            ->latest('created_at')
            ->get();
        return view('pages.payroll.index', compact('salaries'));
    }

        public function getSalary($id)
{
    $employee = Employee::with(['salary' => function($q) {
        $q->latest();
    }])->find($id);

    if (!$employee || $employee->salary->isEmpty()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Data salary tidak ditemukan.'
        ]);
    }

    $salary = $employee->salary->sortByDesc('created_at')->first();


    return response()->json([
        'status' => 'success',
        'salary' => [
            'gajiPokok' => $salary->gajiPokok,
            'tunjanganTransportasi' => $salary->tunjanganTransportasi,
            'tunjanganMakan' => $salary->tunjanganMakan,
            'tunjanganKesehatan' => $salary->tunjanganKesehatan,
            'bonus' => $salary->bonus,
            'insentif' => $salary->insentif,
            'lembur' => $salary->lembur,
            'totalPotongan' => $salary->totalPotongan,
        ],
        'tanggalMasuk' => $employee->tanggalMasuk,
    ]);
}

    public function create()
    {
        $employees = Employee::all();
        $ptkps = Ptkp::all();
        return view('pages.payroll.create', compact('employees', 'ptkps'));
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
        'iuranPensiun' => $iuranPensiunBulanan,       // Iuran pensiun per bulan
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
        $salaryHistoryQuery->whereMonth('created_at', $request->filter_bulan);
    }

    if ($request->filled('filter_tahun')) {
        $salaryHistoryQuery->whereYear('created_at', $request->filter_tahun);
    }

    $salaryHistory = $salaryHistoryQuery->orderByDesc('created_at')->paginate(10);


    // Filter untuk riwayat perubahan gaji (salaryLogs)
    $salaryLogQuery = SalaryLog::with('employee');

    if ($request->filled('nama')) {
        $salaryLogQuery->whereHas('employee', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->nama . '%');
        });
    }

    if ($request->filled('bulan')) {
        $salaryLogQuery->whereMonth('created_at', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $salaryLogQuery->whereYear('created_at', $request->tahun);
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
