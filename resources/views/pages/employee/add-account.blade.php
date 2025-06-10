@extends('layouts.admin.main')

@section('title', 'Tambah Akun Karyawan')

@section('content')
<div class="bg-white min-vh-100 py-4">
    <div class="container py-4">
        <div class="shadow-sm rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h4 class="mb-0">Tambah Akun dan Data Karyawan</h4>
            </div>

            <form action="{{ route('employee.store') }}" method="POST">
                @csrf
                <div class="card-body row g-3">

                    {{-- Informasi Pribadi --}}
                    <h5 class="mt-4 fw-bold">Informasi Pribadi</h5>
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggalLahir" class="form-control" value="{{ old('tanggalLahir') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="statusPernikahan" class="form-label">Status Pernikahan</label>
                        <select name="statusPernikahan" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="belum" {{ old('statusPernikahan') == 'belum' ? 'selected' : '' }}>Belum Kawin</option>
                            <option value="sudah" {{ old('statusPernikahan') == 'sudah' ? 'selected' : '' }}>Sudah Kawin</option>
                        </select>
                    </div>

                    {{-- Informasi Pekerjaan --}}
                    <h5 class="mt-4 fw-bold">Informasi Pekerjaan</h5>
                    <div class="col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="departemen" class="form-label">Departemen</label>
                        <input type="text" name="departemen" class="form-control" value="{{ old('departemen') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="statusKepegawaian" class="form-label">Status Kepegawaian</label>
                        <select name="statusKepegawaian" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="aktif" {{ old('statusKepegawaian') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('statusKepegawaian') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="position" class="form-label">Posisi Akun</label>
                        <select name="position" class="form-select" required>
                            <option value="">-- Pilih Posisi --</option>
                            <option value="Staff" {{ old('position') == 'Staff' ? 'selected' : '' }}>Staff</option>
                            <option value="Admin" {{ old('position') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggalMasuk" class="form-control" value="{{ old('tanggalMasuk') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="tanggalKeluar" class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tanggalKeluar" class="form-control" value="{{ old('tanggalKeluar') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="golongan" class="form-label">Golongan</label>
                        <input type="text" name="golongan" class="form-control" value="{{ old('golongan') }}">
                    </div>

                    {{-- Relasi Data --}}
                    <h5 class="mt-4 fw-bold">Relasi Data</h5>
                    <div class="col-md-6">
                        <label for="ptkp_id" class="form-label">PTKP</label>
                        <select name="ptkp_id" class="form-select">
                            <option value="">-- Pilih PTKP --</option>
                            @foreach($ptkps as $ptkp)
                                <option value="{{ $ptkp->id }}" {{ old('ptkp_id') == $ptkp->id ? 'selected' : '' }}>
                                    {{ $ptkp->kode_ptkp }} - {{ number_format($ptkp->nilai_ptkp, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="jabatan_fungsional_id" class="form-label">Jabatan Fungsional</label>
                        <select name="jabatan_fungsional_id" class="form-select">
                            <option value="">-- Pilih --</option>
                            @foreach($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}" {{ old('jabatan_fungsional_id') == $jabatan->id ? 'selected' : '' }}>
                                    {{ $jabatan->nama_jabatan_fungsional }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Informasi Kontak & Akun --}}
                    <h5 class="mt-4 fw-bold">Kontak & Login</h5>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password Login</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                    <a href="{{ route('admin.employee.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
