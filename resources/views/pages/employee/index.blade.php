@extends('layouts.admin.main')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white min-vh-100 py-4">
<div class="container mt-4">
    <h2 class="fw-bold text-primary">Selamat datang, {{ $employee->nama }}</h2>

    @if ($employee)
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Data Karyawan</strong>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Nama:</strong> {{ $employee->nama }}</p>
                    <p><strong>NIK:</strong> {{ $employee->nik }}</p>
                    <p><strong>Alamat:</strong> {{ $employee->alamat ?? '-' }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $employee->tanggalLahir ? $employee->tanggalLahir->format('d-m-Y') : '-' }}</p>
                    <p><strong>Status Pernikahan:</strong> {{ $employee->statusPernikahan ?? '-' }}</p>
                    <p><strong>Jabatan:</strong> {{ $employee->jabatan ?? '-' }}</p>
                    <p><strong>Departemen:</strong> {{ $employee->departemen ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status Kepegawaian:</strong> {{ ucfirst($employee->statusKepegawaian) }}</p>
                    <p><strong>Masa Kerja:</strong> {{ $employee->masaKerja ?? '-' }} tahun</p>
                    <p><strong>NPWP:</strong> {{ $employee->npwp ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $employee->email ?? '-' }}</p>
                    <p><strong>Telepon:</strong> {{ $employee->telepon ?? '-' }}</p>
                    <p><strong>Tanggal Masuk:</strong> {{ $employee->tanggalMasuk ? $employee->tanggalMasuk->format('d-m-Y') : '-' }}</p>
                    <p><strong>Tanggal Keluar:</strong> {{ $employee->tanggalKeluar ? $employee->tanggalKeluar->format('d-m-Y') : '-' }}</p>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-warning mt-4">
        Tidak ada data karyawan yang terkait dengan akun Anda.
    </div>
    @endif
</div>
</div>
@endsection
