<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Tax;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Helpers\ActivityLogger;

class TaxController extends Controller
{
public function index()
{
    $taxes = Tax::with('employee', 'ptkp')->latest()->paginate(10);
    return view('pages.tax.tax-detail', compact('taxes'));
}

public function myTax()
{
    $user = auth()->user();

    // if (!$user->employee) {
    //     abort(403, 'Tidak memiliki data pegawai.');
    // }


    if (!$user->employee) {
        return response('Tidak memiliki data pegawai.', 403);
    }

    $taxes = Tax::with('ptkp')
                ->where('employee_id', $user->employee->id)
                ->orderByDesc('tanggalLaporan')
                ->paginate(10);

    return view('pages.tax.tax-detail-user', compact('taxes'));
}

public function exportBuktiPotongPDF($id)
{
    try {
        $tax = Tax::with(['employee', 'ptkp'])->findOrFail($id);

        $pdf = Pdf::loadView('pages.tax.pdf', compact('tax'))
                  ->setPaper('A4', 'portrait');

        $filename = 'Bukti_Potong_PPh21_' . str_replace(' ', '_', $tax->employee->nama) . '.pdf';

        ActivityLogger::log(
            'export_bukti_potong_pdf',
            "User mengunduh Bukti Potong PPh21 untuk karyawan: {$tax->employee->nama}",
            'info'
        );

        return $pdf->download($filename);
    } catch (\Exception $e) {
        ActivityLogger::log(
            'export_bukti_potong_pdf_error',
            "Gagal mengunduh Bukti Potong PPh21 ID {$id}. Error: " . $e->getMessage(),
            'error'
        );
        return redirect()->back()->with('error', 'Gagal mengunduh bukti potong.');
    }
}


  public function destroy($id)
{
    try {
        $tax = Tax::findOrFail($id);
        $employeeName = $tax->employee->nama ?? 'Nama karyawan tidak tersedia';
        $tax->delete();

        ActivityLogger::log(
            'delete_bukti_potong',
            "Data bukti potong PPh21 untuk karyawan: {$employeeName} (ID: {$id}) telah dihapus.",
            'warning'
        );

        return redirect()->back()->with('success', 'Data bukti potong berhasil dihapus.');
    } catch (\Exception $e) {
        ActivityLogger::log(
            'delete_bukti_potong_error',
            "Gagal menghapus data bukti potong ID {$id}. Error: " . $e->getMessage(),
            'error'
        );
        return redirect()->back()->with('error', 'Gagal menghapus data bukti potong.');
    }
}


}
