<?php

namespace App\Http\Payroll\Controllers;

use App\Models\Salary;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

class SalaryStatusController extends Controller
{
    /**
     * Ubah status salary menjadi final.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finalize($id)
    {
        $salary = Salary::findOrFail($id);

        if ($salary->status === 'final') {
            return redirect()->back()->with('info', 'Gaji sudah berstatus final.');
        }

        // Jika ingin, validasi data salary sudah lengkap sebelum finalisasi
        if (!$this->isSalaryComplete($salary)) {
            return redirect()->back()->withErrors(['error' => 'Data gaji belum lengkap, tidak bisa difinalisasi.']);
        }

        $salary->status = 'final';
        $salary->save();

        return redirect()->back()->with('success', 'Status gaji berhasil diubah menjadi final.');
    }

    /**
     * Contoh validasi sederhana apakah data gaji sudah lengkap
     */
    protected function isSalaryComplete(Salary $salary): bool
    {
        // Misal wajib ada gaji pokok dan total gaji lebih dari 0
        return $salary->gajiPokok > 0 && $salary->totalGaji > 0;
    }
}
