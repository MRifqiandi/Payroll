@extends('layouts.admin.main')
@section('title', 'Upload Laporan')

@section('content')


<div class="bg-white min-vh-100 py-4">
    <div class="d-flex justify-content-between align-items-center pb-3 gap-3">
<div class="container">
    <h2 class="fw-bold text-primary pb-3">Upload Laporan (PDF / Excel)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
 
        <div class="mb-3">
            <label for="employee_id" class="form-label">Nama Karyawan</label>
            <select name="employee_id" id="employee_id" class="form-select select2">
                <option value="">-- Pilih Karyawan --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Dropdown Jenis Laporan --}}
        <div class="mb-3">
            <label for="jenisLaporan" class="form-label">Jenis Laporan</label>
            <select name="jenisLaporan" id="jenisLaporan" class="form-select select2" required>
                <option value="">-- Pilih Jenis Laporan --</option>
                <option value="pajak" {{ old('jenisLaporan') == 'pajak' ? 'selected' : '' }}>Pajak</option>
                <option value="bpjs" {{ old('jenisLaporan') == 'bpjs' ? 'selected' : '' }}>BPJS</option>
                <option value="kepatuhan" {{ old('jenisLaporan') == 'kepatuhan' ? 'selected' : '' }}>Kepatuhan</option>
                <option value="audit_internal" {{ old('jenisLaporan') == 'audit_internal' ? 'selected' : '' }}>Audit Internal</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="buktiPotong" class="form-label">Bukti Potong (PDF/JPG/PNG)</label>
            <input type="file" name="buktiPotong" id="buktiPotong" class="form-control" accept=".pdf,.jpg,.png">
        </div>

        <div class="mb-3">
            <label for="fileLaporan" class="form-label">File Laporan (PDF, XLS, XLSX)</label>
            <input type="file" name="fileLaporan" id="fileLaporan" class="form-control" accept=".pdf,.xls,.xlsx" required>
        </div>

        <div class="mb-3">
            <label for="tanggalLaporan" class="form-label">Tanggal Laporan</label>
            <input type="date" name="tanggalLaporan" id="tanggalLaporan" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload Laporan</button>
    </form>
</div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#employee_id').select2({
            placeholder: "-- Pilih Karyawan --",
            allowClear: true,
            width: '100%'
        });

        $('#jenisLaporan').select2({
            placeholder: "-- Pilih Jenis Laporan --",
            allowClear: true,
            width: '100%'
        });
    });
</script>

@endsection
