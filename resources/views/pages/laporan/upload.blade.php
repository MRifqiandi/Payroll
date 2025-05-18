@extends('layouts.admin.main')
@section('title', 'Upload Laporan')

@section('content')

<div class="container mt-5">
    <h2>Upload Laporan (PDF / Excel)</h2>

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
            <label for="employee_id" class="form-label">Karyawan (Optional)</label>
            <select name="employee_id" id="employee_id" class="form-select">
                <option value="">-- Pilih Karyawan --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->nama }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label for="jenisLaporan" class="form-label">Jenis Laporan</label>
            <select name="jenisLaporan" id="jenisLaporan" class="form-select" required>
                <option value="">-- Pilih Jenis Laporan --</option>
                <option value="pajak">Pajak</option>
                <option value="bpjs">BPJS</option>
                <option value="kepatuhan">Kepatuhan</option>
                <option value="audit_internal">Audit Internal</option>
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
@endsection
