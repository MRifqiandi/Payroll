@extends('layouts.admin.main') {{-- Ganti jika pakai layout khusus karyawan --}}

@section('title', 'Riwayat BPJS Saya')

@section('content')
<div class="bg-white min-vh-100 py-4">
    <div class="container">
        <h2 class="fw-bold text-primary mb-4">Riwayat Potongan BPJS Saya</h2>

        @if($bpjsData->count())
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Periode</th>
                            <th>Iuran Perusahaan</th>
                            <th>Iuran Peserta</th>
                            <th>Total Iuran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bpjsData as $bpjs)
                            <tr>
                                <td class="text-center">{{ $bpjs->periode }}</td>
                                <td>Rp {{ number_format($bpjs->iuran_perusahaan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($bpjs->iuran_peserta, 0, ',', '.') }}</td>
                                <td class="fw-bold">Rp {{ number_format($bpjs->iuran_total, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.bpjs.exportPDF', $bpjs->id) }}"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Download Bukti BPJS (PDF)">
                                        <i class="bi bi-file-earmark-arrow-down"></i>
                                    </a>
                                    <form action="{{ route('bpjs.destroy', $bpjs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data BPJS ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $bpjsData->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="alert alert-info">Belum ada data potongan BPJS ditemukan.</div>
        @endif
    </div>
</div>
@endsection
