<?php

namespace App\Http\Controllers\Payroll;

use App\Models\SalaryRaise;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryRaiseController extends Controller
{
    // Menampilkan riwayat kenaikan gaji
    public function index(Request $request)
    {
        // Ambil semua karyawan untuk dropdown
        $employees = Employee::all();

        // Ambil riwayat kenaikan gaji berdasarkan karyawan yang dipilih
        $salaryRaises = null;
        if ($request->has('employee_id') && $request->employee_id) {
            $salaryRaises = SalaryRaise::where('employee_id', $request->input('employee_id'))
                ->orderBy('tanggalKenaikan', 'desc')
                ->get();

            // Jika request AJAX, kirim data dalam bentuk JSON
            if ($request->ajax()) {
                return response()->json([
                    'salaryRaises' => $salaryRaises
                ]);
            }
        }

        // Kembali ke view dengan data
        return view('pages.payroll.salary-raise-history', compact('employees', 'salaryRaises'));
    }
}
