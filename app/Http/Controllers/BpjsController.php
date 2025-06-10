<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bpjs;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Employee;

class BpjsController extends Controller
{

        public function index(Request $request)
    {
        $query = Bpjs::with('employee')->orderByDesc('periode');

        // Filter berdasarkan karyawan
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $bpjsData = $query->paginate(15);
        $employees = Employee::orderBy('nama')->get();

        return view('pages.employee.bpjs-history-admin', compact('bpjsData', 'employees'));
    }
    public function myBpjs()
    {
        $user = auth()->user();
        $employee = $user->employee;
    if (!$employee) {
            abort(403, 'Tidak memiliki data pegawai.');
        }

        $bpjsData = Bpjs::where('employee_id', $employee->id)
                        ->orderByDesc('periode')
                        ->paginate(15);

        return view('pages.employee.bpjs-history', compact('bpjsData'));
    }

     public function exportPDF($id)
    {
        $bpjs = Bpjs::with('employee')->findOrFail($id);

        $pdf = PDF::loadView('pages.employee.bpjs-pdf', compact('bpjs'));

        $fileName = 'bukti_bpjs_'.$bpjs->employee->nama.'_'.str_replace('-', '', $bpjs->periode).'.pdf';

        return $pdf->download($fileName);
    }

    public function destroy($id)
{
    $bpjs = Bpjs::findOrFail($id);
    $bpjs->delete();

    return redirect()->back()->with('success', 'Data BPJS berhasil dihapus.');
}

}
