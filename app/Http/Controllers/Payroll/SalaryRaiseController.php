<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalaryRaise;
use App\Models\Employee;

class SalaryRaiseController extends Controller
{
    public function index(Request $request)
    {
        $query = SalaryRaise::with('employee')->orderBy('tanggalKenaikan', 'desc');

        // Jika ingin filter berdasarkan karyawan (optional)
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $salaryRaises = $query->paginate(15);

        $employees = Employee::orderBy('nama')->get();

        return view('pages.payroll.salary-raise-history', compact('salaryRaises', 'employees'));
    }

    public function myRaises()
{
    $user = auth()->user();

    // Pastikan hanya mengambil data kenaikan gaji milik karyawan yang login
    $salaryRaises = SalaryRaise::with('employee')
        ->where('employee_id', $user->employee->id)
        ->orderBy('tanggalKenaikan', 'desc')
        ->paginate(15);

    return view('pages.payroll.salary-raise-history-user', compact('salaryRaises'));
}

}
