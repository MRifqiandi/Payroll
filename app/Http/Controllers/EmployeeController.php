<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JabatanFungsional;
use App\Models\Ptkp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class EmployeeController extends Controller
{


    // Menampilkan daftar seluruh pegawai untuk admin
    public function index()
    {
        $employees = Employee::with('ptkp', 'jabatanFungsional')->paginate(10);
        return view('pages.employee.admin-employee', compact('employees'));
    }

    // Fungsi lain (show, create, store, update, dst) bisa tetap di sini


    /**
     * Menampilkan data karyawan milik user yang sedang login.
     */
    public function profile()
    {
    $user = Auth::user();

    if (!$user->employee_id) {
        // employee_id null, kita set $employee null, jangan abort 404
        $employee = null;
    } else {
        $employee = Employee::find($user->employee_id);
    }

        return view('pages.employee.index', compact('employee'));
    }


public function create()
{
    $ptkps = Ptkp::all();
    $jabatans = JabatanFungsional::all();

    return view('pages.employee.add-account', compact('ptkps', 'jabatans'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nik' => 'nullable|string|max:50|unique:employee,nik',
        'alamat' => 'nullable|string',
        'tanggalLahir' => 'nullable|date',
        'statusPernikahan' => 'nullable|string',
        'jabatan' => 'nullable|string|max:255',
        'ptkp_id' => 'nullable|integer|exists:ptkp,id',
        'departemen' => 'nullable|string|max:255',
        'statusKepegawaian' => 'nullable|string',
        'npwp' => 'nullable|string|max:50',
        // 'email' => 'required|email|max:255|unique:' . config('database.tables.DB_USERS') . ',email',
        'email' => 'required|email|max:255|unique:users,email',
        'telepon' => 'nullable|string|max:20',
        'tanggalMasuk' => 'nullable|date',
        'tanggalKeluar' => 'nullable|date|after_or_equal:tanggalMasuk',
        'golongan' => 'nullable|string|max:50',
        'jabatan_fungsional_id' => 'nullable|integer|exists:jabatan_fungsional,id',
        'password' => 'required|string|min:6|confirmed',
        'position' => 'required|in:Admin,Staff',
    ]);

    // Buat employee terlebih dahulu
    $employee = Employee::create([
        'nama' => $validated['nama'],
        'nik' => $validated['nik'] ?? null,
        'alamat' => $validated['alamat'] ?? null,
        'tanggalLahir' => $validated['tanggalLahir'] ?? null,
        'statusPernikahan' => $validated['statusPernikahan'] ?? null,
        'jabatan' => $validated['jabatan'] ?? null,
        'ptkp_id' => $validated['ptkp_id'] ?? null,
        'departemen' => $validated['departemen'] ?? null,
        'statusKepegawaian' => $validated['statusKepegawaian'] ?? null,
        'npwp' => $validated['npwp'] ?? null,
        'email' => $validated['email'],
        'telepon' => $validated['telepon'] ?? null,
        'tanggalMasuk' => $validated['tanggalMasuk'] ?? null,
        'tanggalKeluar' => $validated['tanggalKeluar'] ?? null,
        'golongan' => $validated['golongan'] ?? null,
        'jabatan_fungsional_id' => $validated['jabatan_fungsional_id'] ?? null,
    ]);

    \Log::info('Creating user with:', [
    'name' => $employee->nama,
    'email' => $validated['email'],
    'position' => $validated['position'],
]);

    $user = User::create([
        'name' => $employee->nama,
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'employee_id' => $employee->id,
        'position' => $validated['position'],
    ]);

    $user->assignRole($validated['position']);
    \Log::info('User created with ID: ' . $user->id);

    return redirect()->route('admin.employee.index')->with('success', 'Data pegawai dan akun berhasil ditambahkan.');
}


    /**
     * (Opsional) Jika ingin nanti tambahkan fitur edit profil.
     */
    public function edit()
    {
        $user = Auth::user();

        if (!$user->employee_id) {
            abort(404, 'Data karyawan tidak ditemukan.');
        }

        $employee = Employee::findOrFail($user->employee_id);
        // $ptkps = Ptkp::all();
        // $jabatans = JabatanFungsional::all();

        return view('pages.employee.edit', compact('employee', 'ptkps', 'jabatans'));
    }

    /**
     * (Opsional) Proses update data profil karyawan.
     */
    public function update(Request $request)
{
    $validated = $request->validate([
        'id' => 'required|exists:employee,id',
        'nama' => 'required|string|max:255',
        'nik' => 'nullable|string|max:50',
        'alamat' => 'nullable|string',
        'tanggalLahir' => 'nullable|date',
        'statusPernikahan' => 'nullable|string',
        'jabatan' => 'nullable|string|max:255',
        'ptkp_id' => 'nullable|integer|exists:ptkp,id',
        'departemen' => 'nullable|string|max:255',
        'statusKepegawaian' => 'nullable|string',
        // 'masaKerja' => 'nullable|integer',
        'npwp' => 'nullable|string|max:50',
        'email' => 'nullable|email|max:255',
        'telepon' => 'nullable|string|max:20',
        'tanggalMasuk' => 'nullable|date',
        'tanggalKeluar' => 'nullable|date',
        'golongan' => 'nullable|string|max:50',
        'jabatan_fungsional_id' => 'nullable|integer|exists:jabatan_fungsional,id',
        'password' => 'nullable|string|min:6|confirmed', // new
    ]);

    $employee = Employee::findOrFail($validated['id']);
    $employee->update($validated);

        // Update password jika diisi
    if (!empty($validated['password'])) {
        $user = $employee->user; // asumsi relasi: employee → user
        $user->password = bcrypt($validated['password']);
        $user->save();
    }

    return redirect()->back()->with('success', 'Data pegawai berhasil diperbarui.');
}


    public function showOwnData()
{
    $user = auth()->user();
    $employee = null;

    if ($user->employee_id) {
        $employee = Employee::find($user->employee_id);
    }

    return view('employee.index', compact('employee'));
}

    public function prediksiKGB()
{
    $employees = Employee::where('statusKepegawaian', 'aktif')->paginate(10);

    foreach ($employees as $employee) {
        $tanggalMasuk = Carbon::parse($employee->tanggalMasuk);

        // Hitung jumlah tahun kerja
        $masaKerjaTahun = $tanggalMasuk->diffInYears(Carbon::now());

        // Hitung jumlah kenaikan yang sudah seharusnya terjadi (tiap 2 tahun)
        $jumlahKenaikan = floor($masaKerjaTahun / 2);

        // Hitung tanggal kenaikan terakhir (tanggal masuk + n*2 tahun)
        $tanggalTerakhirKGB = $tanggalMasuk->copy()->addYears($jumlahKenaikan * 2);

        // Hitung prediksi kenaikan berikutnya
        $tanggalBerikutnya = $tanggalTerakhirKGB->copy()->addYears(2);

        // Simpan ke database
        $employee->update([
            'tanggal_kgb_terakhir' => $tanggalTerakhirKGB->format('Y-m-d'),
            'prediksi_kgb_berikutnya' => $tanggalBerikutnya->format('Y-m-d'),
        ]);
    }

    return view('pages.employee.prediksi-naik-gaji', compact('employees'));
}

public function destroy($id)
{
    $employee = Employee::findOrFail($id);

    $employee->bpjs()->delete();
    $employee->tax()->delete();
    $employee->salaries()->delete();
    $employee->salaryRaise()->delete();

    $employee->delete();

    return redirect()->back()->with('success', 'Data pegawai berhasil dihapus.');
}


}
