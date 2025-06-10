@extends('layouts.admin.main')

@section('title', 'Data BPJS Karyawan')

@section('content')
<div class="bg-white min-vh-100 py-4">
    <div class="container">
        <h2 class="fw-bold text-primary mb-4">📋 Data BPJS Seluruh Karyawan</h2>

        {{-- Filter Karyawan --}}
        <form method="GET" class="row g-3 align-items-center mb-4">
            <div class="col-auto">
                <label for="employee_id" class="form-label">Filter Karyawan:</label>
            </div>
            <div class="col-md-4">
                <select name="employee_id" id="employee_id" class="form-select">
                    <option value="">-- Semua Karyawan --</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-filter"></i> Filter</button>
                <a href="{{ route('admin.bpjs.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-clockwise"></i> Reset</a>
            </div>
        </form>

        {{-- Table Data --}}
        @if ($bpjsData->count())
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Nama Karyawan</th>
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
                                <td>{{ $bpjs->employee->nama ?? 'N/A' }}</td>
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
                                        <form action="{{ route('bpjs.destroy', $bpjs->id) }}" method="POST" class="delete-bpjs-form d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
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
            <div class="alert alert-info">Tidak ada data potongan BPJS ditemukan.</div>
        @endif
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.delete-bpjs-form');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menghapus data BPJS ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
});
</script>

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false,
        timerProgressBar: true
    });
});
</script>
@endif

@endsection
