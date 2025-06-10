@extends('layouts.admin.main')
@section('title', 'Generate Gaji')


@section('content')
<div class="bg-white min-vh-100 py-4">
    <div class="container">
        <h2 class="fw-bold text-primary">Generate Gaji Otomatis</h2>

        <form id="generateSalaryForm" class="mb-2">
            @csrf
            <div class="mb-3">
                <label for="employee_id" class="form-label">Pilih Karyawan</label>
                <select class="form-control" name="employee_id" id="employee_id" required>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}" data-ptkp="{{ $emp->ptkp ? $emp->ptkp->nilai_ptkp : 0 }}">
                            {{ $emp->nama }} - {{ $emp->ptkp ? $emp->ptkp->kode_ptkp : 'Tidak Ada PTKP' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="periode_gaji" class="form-label">Periode Gaji</label>
                <input type="month" id="periode_gaji" name="periode_gaji" class="form-control"
                    value="{{ $periodeGaji ?? '' }}" required />
            </div>

            <!-- Hapus seluruh blok Metode Tunjangan Kinerja dan input tunjangan manual -->

            <button type="submit" class="btn btn-primary">Generate Gaji</button>
        </form>

        <button id="generateAllBtn" type="button" class="btn btn-success ">Generate Gaji Semua Karyawan</button>

        <hr>

        <h3>Hasil Perhitungan Gaji</h3>
        <div class="card border-2" style="border-radius: 10px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered" id="salaryResultTable" style="{{ count($salaries ?? []) ? '' : 'display:none;' }}">
                        <thead>
                            <tr>
                                <th>ID Gaji</th>
                                <th>Nama Karyawan</th>
                                <th>Periode Gaji</th>
                                <th>Gaji Pokok</th>
                                <th>Tunjangan Umum</th>
                                <th>Tunjangan Fungsional</th>
                                <th>Tunjangan Istri/Suami</th>
                                <th>Tunjangan Anak</th>
                                <th>Uang Makan</th>
                                <th>Uang Lembur</th>
                                <th>Gaji Kotor</th>
                                <th>Potongan PPh21</th>
                                <th>Potongan BPJS</th>
                                <th>Potongan Lain</th>
                                <th>Total Potongan</th>
                                <th>Gaji Bersih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($salaries as $salary)
                                <tr>
                                    <td>{{ $salary->id }}</td>
                                    <td>{{ $salary->employee->nama ?? '-' }}</td>
                                    <td>{{ $salary->periode_gaji }}</td>
                                    <td>{{ $salary->gaji_pokok }}</td>
                                    <td>{{ $salary->tunjangan_umum }}</td>
                                    <td>{{ $salary->tunjangan_fungsional }}</td>
                                    <td>{{ $salary->tunjangan_istri_suami }}</td>
                                    <td>{{ $salary->tunjangan_anak }}</td>
                                    <td>{{ $salary->uang_makan }}</td>
                                    <td>{{ $salary->uang_lembur }}</td>
                                    <td>{{ $salary->gaji_kotor }}</td>
                                    <td>{{ $salary->potongan_pph21 }}</td>
                                    <td>{{ $salary->potongan_bpjs }}</td>
                                    <td>{{ $salary->potongan_lain }}</td>
                                    <td>{{ $salary->total_potongan }}</td>
                                    <td>{{ $salary->gaji_bersih }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="16" class="text-center">Belum ada data gaji untuk periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 dan Script -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Hapus semua logika terkait metode_tunjangan_kinerja dan tunjangan_kinerja

// Submit form generate per pegawai
document.getElementById('generateSalaryForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);
    const employeeId = formData.get('employee_id');
    const periodeGaji = formData.get('periode_gaji');

    fetch('{{ url("/payroll/check-existing-salary") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            employee_id: employeeId,
            periode_gaji: periodeGaji
        })
    })
    .then(response => response.json())
    .then(res => {
        if (res.exists) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Gaji Sudah Ada',
                text: 'Data gaji untuk periode ini akan diperbarui. Lanjutkan?',
                showCancelButton: true,
                confirmButtonText: 'Ya, lanjutkan',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) submitForm(formData);
            });
        } else {
            submitForm(formData);
        }
    });

    function submitForm(formData) {
        fetch('{{ url("/payroll/hitung-gaji") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(res => {
            if (res.data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Generate gaji berhasil disimpan.',
                    timer: 2500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
                window.location.href = '?periode_gaji=' + res.data.periode_gaji;
            } else {
                Swal.fire('Gagal', 'Gagal mendapatkan data gaji.', 'error');
            }
        });
    }
});

document.getElementById('generateAllBtn').addEventListener('click', function () {
    const periodeGaji = document.getElementById('periode_gaji').value;

    if (!periodeGaji) {
        Swal.fire('Peringatan', 'Periode gaji harus dipilih dulu.', 'warning');
        return;
    }

    fetch('{{ url("/payroll/check-existing-salary-all") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            periode_gaji: periodeGaji
        })
    })
    .then(response => response.json())
    .then(res => {
        if (res.exists) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Gaji Sudah Ada',
                html: '<p>Data gaji untuk beberapa karyawan pada periode ini akan <b>ditimpa</b>. Lanjutkan proses generate ulang?</p>',
                showCancelButton: true,
                confirmButtonText: 'Ya, lanjutkan',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    generateSemuaKaryawan(periodeGaji);
                }
            });
        } else {
            Swal.fire({
                icon: 'question',
                title: 'Yakin Generate Gaji Semua Karyawan?',
                html: '<p>Proses ini mungkin memakan waktu.</p>',
                showCancelButton: true,
                confirmButtonText: 'Ya, Generate Sekarang',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    generateSemuaKaryawan(periodeGaji);
                }
            });
        }
    });
});

// Fungsi generate semua karyawan tanpa parameter tunjangan kinerja
function generateSemuaKaryawan(periodeGaji) {
    fetch('{{ url("/payroll/hitung-gaji-semua") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            periode_gaji: periodeGaji,
            form_type: 'semua'
        })
    })
    .then(response => response.json())
    .then(res => {
        if (res.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Generate gaji semua karyawan selesai.',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
            window.location.href = '?periode_gaji=' + periodeGaji;
        } else {
            Swal.fire('Gagal', res.message || 'Gagal generate gaji semua.', 'error');
        }
    });
}
</script>
@endsection
