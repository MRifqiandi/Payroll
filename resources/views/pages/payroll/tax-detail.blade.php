@extends('layouts.admin.main')

@section('content')
<div class="bg-white min-vh-100 py-4">
<div class="container">
    <h2 class="fw-bold text-primary mb-4">Riwayat Perhitungan PPh21</h2>
   <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle table-hover m-0">
        <thead class="table-light">
            <tr>
                <th>Nama Karyawan</th>
                <th>PTKP</th>
                <th>Penghasilan Neto Tahunan</th>
                <th>Biaya Jabatan</th>
                <th>Iuran Pensiun</th>
                <th>PKP</th>
                <th>PPh21 Tahunan</th>
                <th>Tanggal Laporan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($taxes as $tax)
            <tr>
                <td>{{ $tax->employee->nama }}</td>
                 <td>
                    @if ($tax->ptkp)
                        {{ $tax->ptkp->kode_ptkp }} (Rp{{ number_format($tax->ptkp->nilai_ptkp, 0, ',', '.') }})
                    @else
                        <span class="text-muted">- (Rp0)</span>
                    @endif
                </td>
                <td>Rp{{ number_format($tax->penghasilan_neto, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($tax->biaya_jabatan, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($tax->iuran_pensiun, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($tax->penghasilan_kena_pajak, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($tax->pph21, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($tax->tanggalLaporan)->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center text-muted">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
        <div class="mt-3">
        {{ $taxes->links('pagination::bootstrap-5') }}
    </div>
</div>

</div>
@endsection
