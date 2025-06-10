<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
    use Illuminate\Support\Facades\DB;

class EmployeeSalaryController extends Controller
{


public function index(Request $request)
{
    $pegawai = Auth::user()->employee;

    if (!$pegawai) {
        abort(403, 'Pegawai tidak ditemukan');
    }

    // Ambil hanya id terbaru per periode_gaji milik pegawai yang login
    $subquery = DB::table('salary as s1')
        ->selectRaw('MAX(s1.id) as latest_id')
        ->where('s1.employee_id', $pegawai->id)
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
        ->groupBy('s1.periode_gaji');

    // Ambil id hasil subquery
    $latestSalaryIds = $subquery->pluck('latest_id');

    // Ambil data salary berdasarkan id tersebut
    $salaries = \App\Models\Salary::with('employee')
        ->whereIn('id', $latestSalaryIds)
        ->orderByRaw('GREATEST(UNIX_TIMESTAMP(created_at), UNIX_TIMESTAMP(updated_at)) DESC')
        ->paginate(10)
        ->withQueryString();

    return view('pages.payroll.salary-user', compact('salaries'));
}

    // Download slip gaji sebagai PDF
    public function downloadSlip($id)
    {
        $user = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            abort(403, 'Akun Anda tidak terhubung dengan data karyawan.');
        }

        $salary = Salary::where('id', $id)
                        ->where('employee_id', $employee->id)
                        ->firstOrFail();

        $pdf = Pdf::loadView('pages.pdf.slip-gaji-kustom', compact('salary'));

        return $pdf->download('Slip-Gaji-' . $salary->periode_gaji . '.pdf');
    }
}
