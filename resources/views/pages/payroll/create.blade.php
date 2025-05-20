@extends('layouts.admin.main')

@section('content')
<div class="bg-white min-vh-100 py-4" style="border-radius: 0.5rem;">
    <div class="container-fluid d-flex justify-content-center align-items-center pt-md-1 pt-lg-3">
        <div class="col-12">
            <h2 class="mb-2 text-center fw-bold text-primary">Form Input Penggajian</h2>
            <div class="container">
                <form action="{{ route('salary.store') }}" method="POST" class="shadow-sm p-4 bg-white rounded-3 w-100">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label for="employee_id">Nama Karyawan</label>
                            <select class="form-control" name="employee_id" id="employee_id" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" data-jabatan="{{ $employee->jabatan }}"
                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->nama }} ({{ $employee->nik }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="periodeGaji" class="form-label">Periode Gaji</label>
                            <input type="month" name="periodeGaji" id="periodeGaji" class="form-control" 
                                value="{{ old('periodeGaji') }}" required>
                        </div>
                    </div>

                    {{-- PTKP Dropdown --}}
                    <div class="mb-3">
                        <label for="ptkp" class="form-label">PTKP</label>
                        <select name="ptkp" id="ptkp" class="form-control" required>
                            <option value="">Pilih PTKP</option>
                            @foreach($ptkps as $ptkp)
                                <option value="{{ $ptkp->kode_ptkp }}"
                                    {{ old('ptkp') == $ptkp->kode_ptkp ? 'selected' : '' }}>
                                    {{ $ptkp->kode_ptkp }} | ({{ number_format($ptkp->nilai_ptkp, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Komponen Gaji Permanen --}}
                    <h5 class="mt-4 mb-2 text-primary fw-bold">Komponen Gaji Permanen</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="gajiPokok">Gaji Pokok</label>
                            <input type="number" name="gajiPokok" id="gajiPokok" class="form-control" 
                                value="{{ old('gajiPokok', 0) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tunjanganKesehatan">Tunjangan Kesehatan</label>
                            <input type="number" name="tunjanganKesehatan" id="tunjanganKesehatan" class="form-control" 
                                value="{{ old('tunjanganKesehatan', 0) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tukin">Tunjangan Kinerja (Tukin)</label>
                        <input type="number" step="0.01" name="tukin" class="form-control" value="{{ old('tukin') }}">
                        <small class="form-text text-muted">Kosongkan jika ingin dihitung otomatis berdasarkan jabatan.</small>
                    </div>


                    {{-- Komponen Gaji Tidak Permanen --}}
                    <h5 class="mt-4 mb-2 text-primary fw-bold">Komponen Gaji Tidak Permanen</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="tunjanganTransportasi">Tunjangan Transportasi</label>
                            <input type="number" name="tunjanganTransportasi" id="tunjanganTransportasi" class="form-control" value="0" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="tunjanganMakan">Tunjangan Makan</label>
                            <input type="number" name="tunjanganMakan" id="tunjanganMakan" class="form-control" 
                                value="{{ old('tunjanganMakan', 0) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="bonus">Bonus</label>
                            <input type="number" name="bonus" id="bonus" class="form-control" 
                                value="{{ old('bonus', 0) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="insentif">Insentif</label>
                            <input type="number" name="insentif" id="insentif" class="form-control" 
                                value="{{ old('insentif', 0) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="lembur">Lembur</label>
                            <input type="number" name="lembur" id="lembur" class="form-control" 
                                value="{{ old('lembur', 0) }}" required>
                        </div>
                    </div>

                    {{-- Komponen Potongan --}}
                    <h5 class="mt-4 mb-2 text-primary fw-bold">Potongan</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="pph21">PPh21</label>
                            <input type="number" name="pph21" id="pph21" class="form-control" value="{{ old('pph21', 0) }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="iuranKaryawan">Iuran Karyawan</label>
                            <input type="number" name="iuranKaryawan" id="iuranKaryawan" class="form-control" 
                                value="{{ old('iuranKaryawan', 0) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="iuranPerusahaan">Iuran Perusahaan</label>
                            <input type="number" name="iuranPerusahaan" id="iuranPerusahaan" class="form-control" 
                                value="{{ old('iuranPerusahaan', 0) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="totalPotongan">Total Potongan</label>
                            <input type="number" name="totalPotongan" id="totalPotongan" class="form-control" 
                                value="{{ old('totalPotongan') }}" readonly>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary w-100 py-2" style="border-radius: 10px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Update tunjangan transportasi sesuai jabatan
    document.getElementById('employee_id').addEventListener('change', function() {
        let select = this;
        let selectedOption = select.options[select.selectedIndex];
        let jabatan = selectedOption.getAttribute('data-jabatan') || '';
        jabatan = jabatan.trim().toLowerCase();

        let tunjangan = 10000; // default

        switch(jabatan) {
            case 'rektor':
                tunjangan = 50000;
                break;
            case 'wakil rektor':
                tunjangan = 25000;
                break;
            case 'staff':
            case 'dosen':
                tunjangan = 10000;
                break; 
            default:
                tunjangan = 10000;
        }

        document.getElementById('tunjanganTransportasi').value = tunjangan;
    });

    // Update nilai PTKP hidden ketika dropdown PTKP berubah
    document.getElementById('ptkp_id').addEventListener('change', function() {
        let select = this;
        let nilaiPtkp = 0;
        if(select.selectedIndex > 0) {
            nilaiPtkp = select.options[select.selectedIndex].getAttribute('data-nilai') || 0;
        }
        document.getElementById('ptkpValue').value = nilaiPtkp;
    });

    // Hitung total potongan otomatis
    const inputIds = ['pph21', 'iuranKaryawan', 'iuranPerusahaan'];
    inputIds.forEach(id => {
        document.getElementById(id).addEventListener('input', updateTotalPotongan);
    });

    function updateTotalPotongan() {
        const pph21 = parseFloat(document.getElementById('pph21').value) || 0;
        const iuranKaryawan = parseFloat(document.getElementById('iuranKaryawan').value) || 0;
        const iuranPerusahaan = parseFloat(document.getElementById('iuranPerusahaan').value) || 0;

        const totalPotongan = pph21 + iuranKaryawan + iuranPerusahaan;
        document.getElementById('totalPotongan').value = totalPotongan;
    }

    // Trigger initial update total potongan if fields have values
    updateTotalPotongan();
</script>
@endsection
