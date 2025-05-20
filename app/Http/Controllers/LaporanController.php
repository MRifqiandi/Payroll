<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    // Tampilkan semua laporan (paginate 10), untuk API
    public function index(Request $request)
    {
        $query = Laporan::query()->with('employee');

        // Filter berdasarkan jenis laporan
        if ($request->filled('jenisLaporan')) {
            $query->where('jenisLaporan', $request->jenisLaporan);
        }

        // Filter berdasarkan nama karyawan (relasi employee)
        if ($request->filled('namaKaryawan')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->namaKaryawan . '%');
            });
        }

        $laporan = $query->orderBy('tanggalLaporan', 'desc')->paginate(10)->withQueryString();

        return view('pages.laporan.list', compact('laporan'));
    }


    // Tampilkan laporan berdasarkan jenis, untuk API
    public function byJenis($jenis)
    {
        $laporan = Laporan::where('jenisLaporan', $jenis)->latest()->get();
        return response()->json($laporan);
    }

    // Tampilkan detail laporan, untuk API
    public function show($id)
    {
        $laporan = Laporan::with('employee')->findOrFail($id);
        return response()->json($laporan);
    }

    // Tampilkan halaman form upload laporan (view blade)
    public function create()
    {
        $employees = \App\Models\Employee::orderBy('nama')->get(); // ambil semua karyawan, urut nama
        return view('pages.laporan.upload', compact('employees'));
    }

    public function list()
    {
        // Ambil laporan dengan pagination 10 per halaman, termasuk relasi employee
        $laporan = Laporan::with('employee')->latest()->paginate(10);
        return view('pages.laporan.list', compact('laporan'));
    }

public function download($id, Request $request)
{
    $laporan = Laporan::findOrFail($id);
    $type = $request->query('type', 'fileLaporan'); // file yang ingin di-download: fileLaporan atau buktiPotong

    $filePath = $laporan->detailLaporan[$type] ?? null;
    if (!$filePath || !Storage::exists($filePath)) {
        abort(404, 'File tidak ditemukan');
    }

    // Ambil nama asli file sesuai jenisnya
    if ($type === 'buktiPotong') {
        $fileName = $laporan->originalBuktiPotong ?? basename($filePath);
    } else {
        $fileName = $laporan->originalFileLaporan ?? basename($filePath);
    }

    return Storage::download($filePath, $fileName);
}






    // Simpan laporan baru dengan upload file (PDF / Excel)
    public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'nullable|exists:employee,id',
        'jenisLaporan' => 'required|string',
        'tanggalLaporan' => 'required|date',
        'buktiPotong' => 'nullable|file|mimes:pdf,jpg,png',
        'fileLaporan' => 'required|file|mimes:pdf,xls,xlsx',
    ]);

    $data = $request->only('employee_id', 'jenisLaporan', 'tanggalLaporan');

    // Simpan file buktiPotong jika ada
    $buktiPotongPath = null;
    $originalBuktiPotong = null;
    if ($request->hasFile('buktiPotong')) {
        $file = $request->file('buktiPotong');
        $originalBuktiPotong = $file->getClientOriginalName();
        $buktiPotongPath = $file->store('bukti_potong');
    }

    // Simpan file laporan
    $fileLaporan = $request->file('fileLaporan');
    $originalFileLaporan = $fileLaporan->getClientOriginalName();
    $fileLaporanPath = $fileLaporan->store('laporan_files');

    // Simpan ke database, termasuk nama asli file di detailLaporan
    $detailLaporan = [
        'buktiPotong' => $buktiPotongPath,
        'fileLaporan' => $fileLaporanPath,
    ];

    $laporan = new Laporan();
    $laporan->employee_id = $data['employee_id'] ?? null;
    $laporan->jenisLaporan = $data['jenisLaporan'];
    $laporan->tanggalLaporan = $data['tanggalLaporan'];
    $laporan->detailLaporan = $detailLaporan;

    // Simpan nama asli file ke field baru
    $laporan->originalBuktiPotong = $originalBuktiPotong;
    $laporan->originalFileLaporan = $originalFileLaporan;

    $laporan->save();

    return redirect()->route('laporan.list')->with('success', 'Laporan berhasil diupload.');
}


    // Hapus laporan dan file terkait
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $detail = $laporan->detailLaporan ?? [];

        if (!empty($detail['buktiPotong']) && Storage::exists($detail['buktiPotong'])) {
            Storage::delete($detail['buktiPotong']);
        }

        if (!empty($detail['fileLaporan']) && Storage::exists($detail['fileLaporan'])) {
            Storage::delete($detail['fileLaporan']);
        }

        $laporan->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Laporan berhasil dihapus.']);
        }

        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }
}
