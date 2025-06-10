<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    protected $laporan;

    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $query = $this->laporan->newQuery()->with('employee');

        // Filter berdasarkan role
        if ($user->hasRole('staff')) {
            
            if ($user->employee) {
                $query->where('employee_id', $user->employee->id);
            } else {
                $query->whereNull('employee_id');
            }
        }
if ($request->has('jenisLaporan') && !empty($request->jenisLaporan)) {
    $query->where('jenisLaporan', $request->jenisLaporan);
}

if ($request->has('namaKaryawan') && !empty($request->namaKaryawan)) {
    $query->whereHas('employee', function ($q) use ($request) {
        $q->where('nama', 'like', '%' . $request->namaKaryawan . '%');
    });
}

        $laporan = $query->orderBy('tanggalLaporan', 'desc')->paginate(10)->withQueryString();

        return view('pages.laporan.list', compact('laporan'));
    }

    public function byJenis($jenis)
    {
        $laporan = $this->laporan->where('jenisLaporan', $jenis)->latest()->get();
        return response()->json($laporan);
    }

    public function show($id)
    {
        $laporan = $this->laporan->with('employee')->findOrFail($id);
        return response()->json($laporan);
    }

     public function create()
    {
        $user = Auth::user();

        if ($user->hasRole('staff')) {
            $employees = collect([$user->employee]);
        } else {
            // Admin & finance bisa pilih employee lain
            $employees = Employee::orderBy('nama')->get();
        }

        return view('pages.laporan.upload', compact('employees'));
    }

    public function download($id, Request $request)
    {
        $laporan = $this->laporan->findOrFail($id);
        $type = $request->query('type', 'fileLaporan');

        $filePath = $laporan->detailLaporan[$type] ?? null;
        if (!$filePath || !Storage::exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        $fileName = $type === 'buktiPotong'
            ? ($laporan->originalBuktiPotong ?? basename($filePath))
            : ($laporan->originalFileLaporan ?? basename($filePath));

        return Storage::download($filePath, $fileName);
    }

     public function store(Request $request)
    {
        $user = Auth::user();

        // Kalau staff, override employee_id jadi miliknya sendiri
        if ($user->hasRole('staff') && $user->employee) {
            $employeeId = $user->employee->id;
        } else {
            $employeeId = $request->employee_id;
        }

        $request->validate([
            'jenisLaporan' => 'required|string',
            'tanggalLaporan' => 'required|date',
            'buktiPotong' => 'nullable|file|mimes:pdf,jpg,png',
            'fileLaporan' => 'required|file|mimes:pdf,xls,xlsx',
        ]);

        $data = [
            'employee_id' => $employeeId,
            'jenisLaporan' => $request->jenisLaporan,
            'tanggalLaporan' => $request->tanggalLaporan,
        ];

        $buktiPotongPath = null;
        $originalBuktiPotong = null;
        if ($request->hasFile('buktiPotong')) {
            $file = $request->file('buktiPotong');
            $originalBuktiPotong = $file->getClientOriginalName();
            $buktiPotongPath = $file->store('bukti_potong');
        }

        $fileLaporan = $request->file('fileLaporan');
        $originalFileLaporan = $fileLaporan->getClientOriginalName();
        $fileLaporanPath = $fileLaporan->store('laporan_files');

        $detailLaporan = [
            'buktiPotong' => $buktiPotongPath,
            'fileLaporan' => $fileLaporanPath,
        ];

        $laporan = $this->laporan->newInstance();
        $laporan->employee_id = $data['employee_id'];
        $laporan->jenisLaporan = $data['jenisLaporan'];
        $laporan->tanggalLaporan = $data['tanggalLaporan'];
        $laporan->detailLaporan = $detailLaporan;
        $laporan->originalBuktiPotong = $originalBuktiPotong;
        $laporan->originalFileLaporan = $originalFileLaporan;

        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diupload.');
    }

    public function destroy($id)
    {
        $laporan = $this->laporan->findOrFail($id);
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
