    @extends('layouts.admin.main')
    @section('title', 'Payroll')

    @section('content')
    <div class="bg-white min-vh-100 py-4">
    <div class="d-flex justify-content-between align-items-center pb-3 gap-3">
    <div class="container">

    <div class="d-flex justify-content-between align-items-center pb-3 gap-3">
        <h2 class="fw-bold text-primary">📄 Data Penggajian</h2>
        <div>
        <a href="{{ route('salary.create') }}" class="btn btn-primary shadow-sm text-white">
            <i class="bi bi-plus-circle me-1"></i>Buat Gaji
        </a>
        <a href="{{ route('salary.history') }}" class="btn btn-info shadow-sm text-white">
            <i class="bi bi-clock-history me-1"></i>Riwayat Gaji
        </a>
        <a href="{{ route('salary.raise.history') }}" class="btn btn-info shadow-sm text-white">
            <i class="bi bi-clock-history me-1"></i>Riwayat Kenaikan Gaji
        </a>
        </div>
    </div>

    <form method="GET" action="{{ route('salary.index') }}" class="d-flex pb-2 align-items-center">
        <div class="input-group" style="position: relative;">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Karyawan" value="{{ request('search') }}" style="padding-left: 3.5em; padding-right: 3.5em; border-radius: 1.5rem; border: 1px solid rgba(204, 204, 204, 0.5); height: 50px;">
            <i class="fa fa-search" aria-hidden="true" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); padding-left: 1.2rem;"></i>
            <!-- Tombol X untuk menghapus pencarian -->
            <button type="button" onclick="clearSearch()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #007bff; cursor: pointer; background-color: transparent; border: none;">
        <i class="fa fa-times" aria-hidden="true"></i>
    </button>

        </div>
    </form>
    @if (session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('warning'))
    <div id="warning-alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('info'))
    <div id="info-alert" class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

        <div class="card border-2" style="border-radius: 10px;">
        <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle table-hover m-0" id="salary-table">
                <thead class="table-light">
                    <tr>
                        <th>Nama Karyawan</th>
                        <th>Periode</th>
                        <th>Gaji Pokok</th>
                        <th>Tunj. Transportasi</th>
                        <th>Tunj. Makan</th>
                        <th>Tunj. Kesehatan</th>
                        <th>Bonus</th>
                        <th>Insentif</th>
                        <th>Lembur</th>
                        <th>Total Potongan</th>
                        <th>Total Gaji</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salaries as $salary)
                    <tr>
                        <td>{{ $salary->employee->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($salary->periodeGaji)->translatedFormat('F Y') }}</td>
                        <td>Rp {{ number_format($salary->gajiPokok, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->tunjanganTransportasi, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->tunjanganMakan, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->tunjanganKesehatan, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->bonus, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->insentif, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->lembur, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->totalPotongan, 2, ',', '.') }}</td>
                        <td><strong>Rp {{ number_format($salary->totalGaji, 2, ',', '.') }}</strong></td>
                        <td>
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-primary rounded-pill dropdown-toggle" type="button" id="dropdownMenu{{ $salary->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow rounded" aria-labelledby="dropdownMenu{{ $salary->id }}">
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#detailModal{{ $salary->id }}">
                        <i class="bi bi-info-circle me-2 text-primary"></i> Detail
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#editModal{{ $salary->id }}">
                        <i class="bi bi-pencil-square me-2 text-warning"></i> Edit
                    </button>
                </li>
                <li>
                <form action="{{ route('salary.destroy', $salary->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>

                </li>
            </ul>
        </div>
    </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

    <!-- Modal Edit Data Gaji -->
    @foreach ($salaries as $salary)
    <div class="modal fade" id="editModal{{ $salary->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $salary->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel{{ $salary->id }}">Edit Data Gaji: {{ $salary->employee->nama }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('salary.update', $salary->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Untuk update -->
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $salary->employee->nama }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="gajiPokok" class="form-label">Gaji Pokok</label>
                            <input type="number" class="form-control" id="gajiPokok" name="gajiPokok" value="{{ $salary->gajiPokok }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tunjanganTransportasi" class="form-label">Tunjangan Transportasi</label>
                            <input type="number" class="form-control" id="tunjanganTransportasi" name="tunjanganTransportasi" value="{{ $salary->tunjanganTransportasi }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tunjanganMakan" class="form-label">Tunjangan Makan</label>
                            <input type="number" class="form-control" id="tunjanganMakan" name="tunjanganMakan" value="{{ $salary->tunjanganMakan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tunjanganKesehatan" class="form-label">Tunjangan Kesehatan</label>
                            <input type="number" class="form-control" id="tunjanganKesehatan" name="tunjanganKesehatan" value="{{ $salary->tunjanganKesehatan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="bonus" class="form-label">Bonus</label>
                            <input type="number" class="form-control" id="bonus" name="bonus" value="{{ $salary->bonus }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="insentif" class="form-label">Insentif</label>
                            <input type="number" class="form-control" id="insentif" name="insentif" value="{{ $salary->insentif }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="lembur" class="form-label">Lembur</label>
                            <input type="number" class="form-control" id="lembur" name="lembur" value="{{ $salary->lembur }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="pph21" class="form-label">PPH 21</label>
                            <input type="number" class="form-control" id="pph21" name="pph21" value="{{ $salary->pph21 }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="iuranKaryawan" class="form-label">Iuran Karyawan</label>
                            <input type="number" class="form-control" id="iuranKaryawan" name="iuranKaryawan" value="{{ $salary->iuranKaryawan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="iuranPerusahaan" class="form-label">Iuran Perusahaan</label>
                            <input type="number" class="form-control" id="iuranPerusahaan" name="iuranPerusahaan" value="{{ $salary->iuranPerusahaan }}" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


            <!-- Tempatkan semua modal detail di sini -->
    @foreach ($salaries as $salary)
    <div class="modal fade" id="detailModal{{ $salary->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $salary->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="detailModalLabel{{ $salary->id }}">Detail Gaji: {{ $salary->employee->nama }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr><th>Gaji Pokok</th><td>Rp {{ number_format($salary->gajiPokok, 2, ',', '.') }}</td></tr>
                        <tr><th>Tunjangan Transportasi</th><td>Rp {{ number_format($salary->tunjanganTransportasi, 2, ',', '.') }}</td></tr>
                        <tr><th>Tunjangan Makan</th><td>Rp {{ number_format($salary->tunjanganMakan, 2, ',', '.') }}</td></tr>
                        <tr><th>Tunjangan Kesehatan</th><td>Rp {{ number_format($salary->tunjanganKesehatan, 2, ',', '.') }}</td></tr>
                        <tr><th>Bonus</th><td>Rp {{ number_format($salary->bonus, 2, ',', '.') }}</td></tr>
                        <tr><th>Insentif</th><td>Rp {{ number_format($salary->insentif, 2, ',', '.') }}</td></tr>
                        <tr><th>Lembur</th><td>Rp {{ number_format($salary->lembur, 2, ',', '.') }}</td></tr>
                        <tr><th>Total Potongan</th><td>Rp {{ number_format($salary->totalPotongan, 2, ',', '.') }}</td></tr>
                        <tr><th><strong>Total Gaji</strong></th><td><strong>Rp {{ number_format($salary->totalGaji, 2, ',', '.') }}</strong></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    </div>
        </div>
        </div>
    </div>
    </div>


    <script>

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector('input[name="search"]');
    const salaryTable = document.getElementById('salary-table');
    const rows = salaryTable.getElementsByTagName('tr');

    searchInput.addEventListener('input', function () {
        const filter = searchInput.value.toLowerCase();

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            const employeeName = cells[0] ? cells[0].textContent.toLowerCase() : '';

            if (employeeName.indexOf(filter) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
});

    setTimeout(function () {
        ['success', 'warning', 'info'].forEach(function (type) {
            const alert = document.getElementById(`${type}-alert`);
            if (alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        });
    }, 4000);

    function clearSearch() {
    const input = document.querySelector('input[name="search"]');
    input.value = '';
}
    </script>


    @endsection
