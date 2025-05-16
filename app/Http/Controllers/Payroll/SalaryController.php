<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\Tax;
use App\Models\Bpjs;
use App\Models\Absensi;
use App\Models\SalaryLog;
use App\Models\SalaryRaise;
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
        return view('pages.payroll.create', compact('employees'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'employee_id' => 'required|exists:employee,id',
        'periodeGaji' => ['required', 'regex:/^\d{4}-\d{2}$/'], // format YYYY-MM
        'gajiPokok' => 'required|numeric',
        'tunjanganMakan' => 'required|numeric',
        'tunjanganKesehatan' => 'required|numeric',
        'bonus' => 'required|numeric',
        'insentif' => 'required|numeric',
        'lembur' => 'required|numeric',
        'pph21' => 'required|numeric',
        'iuranKaryawan' => 'required|numeric',
        'iuranPerusahaan' => 'required|numeric',
    ]);

    $employee = Employee::findOrFail($validatedData['employee_id']);

    // --- Cegah gaji dobel di bulan yang sama ---
    // $periodeMonth = 5; // Untuk testing, ganti ke date('m') jika di produksi
    // $periodeYear = 2025;

    // Ubah $periodeGajiDate ke tanggal 1 setiap bulan
    $periodeGajiDate = $validatedData['periodeGaji'] . '-01';

    $periodeYear = date('Y', strtotime($periodeGajiDate));
    $periodeMonth = date('m', strtotime($periodeGajiDate));

    $gajiExist = Salary::where('employee_id', $employee->id)
        ->whereYear('periodeGaji', $periodeYear)
        ->whereMonth('periodeGaji', $periodeMonth)
        ->exists();

    if ($gajiExist) {
        return redirect()->route('salary.index')
            ->with('warning', 'Data gaji untuk karyawan ini pada periode ini sudah ada. Tidak boleh duplikat.');
    }


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
            $alasanKenaikan = 'Kenaikan berkala sesuai masa kerja';
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
        'rektor' => 50000,
        'wakil rektor' => 25000,
        'dosen' => 10000,
        default => 10000,
    };

    //hitungan tunjangan makan berdasarkan bulan periode sekarang
    // $bulanSekarang = (int)$periodeMonth;
    // $tahunSekarang = (int)$periodeYear;


    // untuk pengujian
    $bulanSekarang = 4;
    $tahunSekarang = 2025;

    // Ambil jumlah hari hadir pada bulan dan tahun tersebut
    $jumlahHadir = Absensi::where('employee_id', $validatedData['employee_id'])
        ->where('statusKehadiran', 'Hadir')
        ->whereMonth('tanggalKehadiran', $bulanSekarang)
        ->whereYear('tanggalKehadiran', $tahunSekarang)
        ->count();

    // Hitung tunjangan makan berdasarkan jumlah hadir
    $tunjanganMakanTotal = $jumlahHadir * $validatedData['tunjanganMakan'];

    // Hitung total potongan
    $totalPotongan = $validatedData['pph21'] + $validatedData['iuranKaryawan'] + $validatedData['iuranPerusahaan'];

    // Hitung total gaji
    $totalGaji = $gajiPokokBaru +
        $tunjanganTransportasi +
        $tunjanganMakanTotal +
        $validatedData['tunjanganKesehatan'] +
        $validatedData['bonus'] +
        $validatedData['insentif'] +
        $validatedData['lembur'] -
        $totalPotongan;

    // Simpan data ke tabel salary
    $salary = new Salary();
    $salary->employee_id = $validatedData['employee_id'];
    $salary->periodeGaji = $periodeGajiDate;
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

    // Simpan data PPh21 ke tabel tax
    $tax = new Tax();
    $tax->employee_id = $validatedData['employee_id'];
    $tax->pph21 = $validatedData['pph21'];
    $tax->save();

    // Simpan data BPJS ke tabel bpjs
    $bpjs = new BPJS();
    $bpjs->employee_id = $validatedData['employee_id'];
    $bpjs->iuranKaryawan = $validatedData['iuranKaryawan'];
    $bpjs->iuranPerusahaan = $validatedData['iuranPerusahaan'];
    $bpjs->save();

    return redirect()->route('salary.index')->with('success', 'Data gaji berhasil disimpan!');
}

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
    // Filter untuk Riwayat Perubahan Gaji
    $salaryLogQuery = SalaryLog::with('employee');

    if ($request->filled('nama')) {
        $salaryLogQuery->whereHas('employee', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->nama . '%');
        });
    }

    if ($request->filled('bulan')) {
        $salaryLogQuery->whereMonth('updated_at', $request->bulan);
    }

    if ($request->filled('tahun')) {
        $salaryLogQuery->whereYear('updated_at', $request->tahun);
    }

    $salaryLogs = $salaryLogQuery->orderBy('updated_at', 'desc')->get();

    // Filter untuk Riwayat Gaji Karyawan
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

    return view('pages.payroll.salary-history', compact('salaryLogs', 'salaryHistory'));
}





}
