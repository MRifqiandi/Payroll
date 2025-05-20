@extends('layouts.admin.main')
@section('title', 'Daftar Laporan')

@section('content')
<div class="bg-white min-vh-100 py-4">
    <div class="d-flex justify-content-between align-items-center pb-3 gap-3">
        <div class="container">
            <h2 class="pb-3 fw-bold text-primary">📄 Daftar Laporan</h2>

    {{-- Alert Success --}}
    @if(session('success'))
        <div id="alert-success" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert Delete --}}
    @if(session('delete'))
        <div id="alert-delete" class="alert alert-danger">
            {{ session('delete') }}
        </div>
    @endif

    <div class="container mb-3">
    <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 align-items-center">

        <div class="col-auto">
            <label for="jenisLaporan" class="form-label">Jenis Laporan</label>
            <select name="jenisLaporan" id="jenisLaporan" class="form-select">
                <option value="">-- Semua Jenis --</option>
                <option value="bpjs" {{ request('jenisLaporan') == 'bpjs' ? 'selected' : '' }}>Bpjs</option>
                <option value="pajak" {{ request('jenisLaporan') == 'pajak' ? 'selected' : '' }}>Pajak</option>
                <option value="khusus" {{ request('jenisLaporan') == 'khusus' ? 'selected' : '' }}>Khusus</option>
                {{-- Tambah opsi jenis laporan sesuai kebutuhan --}}
            </select>
        </div>

        <div class="col-auto">
            <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
            <input type="text" name="namaKaryawan" id="namaKaryawan" value="{{ request('namaKaryawan') }}" class="form-control" placeholder="Cari nama karyawan...">
        </div>

        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
        </div>

    </form>
</div>


     <div class="card border-2" style="border-radius: 10px;">
        <div class="card-body p-0">

        <div class="table-responsive">
    <table  class="table table-bordered table-striped align-middle m-0">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Jenis Laporan</th>
                <th>Tanggal Laporan</th>
                <th>Bukti Potong</th>
                <th>File Laporan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration + ($laporan->currentPage() - 1) * $laporan->perPage() }}</td>
                    <td>{{ $item->employee ? $item->employee->nama : '-' }}</td>
                    <td>{{ ucfirst($item->jenisLaporan) }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggalLaporan)->format('d M Y') }}</td>

                    <td>
                        @if(!empty($item->detailLaporan['buktiPotong']))
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-info btn-md" href="{{ route('laporan.download', $item->id) }}?type=buktiPotong" target="_blank"><i class="bi bi-download"></i></a>
                            </div>
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if(!empty($item->detailLaporan['fileLaporan']))
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-info btn-md" href="{{ route('laporan.download', $item->id) }}?type=fileLaporan" target="_blank"><i class="bi bi-download"></i></a>
                        </div>
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        <!-- Tombol hapus yang buka modal -->
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus laporan ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada laporan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>
</div>

    {{ $laporan->links() }}
</div>
</div>
</div>


{{-- Script untuk menghilangkan alert otomatis --}}
<script>
    window.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            const alertSuccess = document.getElementById('alert-success');
            if (alertSuccess) {
                alertSuccess.style.display = 'none';
            }

            const alertDelete = document.getElementById('alert-delete');
            if (alertDelete) {
                alertDelete.style.display = 'none';
            }
        }, 3000);
    });
</script>
@endsection
