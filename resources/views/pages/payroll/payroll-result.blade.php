@extends('layouts.admin.main')
@section('title', 'Data Gaji')

@section('content')
<div class="card card-flush h-md-100">
    <div class="card-body pt-6">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center pb-3 flex-wrap gap-3">
            <h2 class="fw-bold text-primary m-0">📄 Daftar Gaji Seluruh Karyawan</h2>

            <a href="{{ route('salary_raise.index') }}" class="btn btn-primary shadow-sm text-white">
                <i class="bi bi-clock-history me-1"></i> Riwayat Kenaikan Gaji
            </a>
        </div>

{{-- Filter Form --}}
<div class="card border shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">

            <div class="col-md-3">
                <label for="bulan" class="form-label">Bulan</label>
                <select name="bulan" id="bulan" class="form-select">
                    <option value="">Semua</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}"
                            {{ request('bulan') == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-3">
                <label for="tahun" class="form-label">Tahun</label>
                <select name="tahun" id="tahun" class="form-select">
                    <option value="">Semua</option>
                    @for ($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-3">
                <label for="jenis_kepegawaian" class="form-label">Jenis Pegawai</label>
                <select name="jenis_kepegawaian" id="jenis_kepegawaian" class="form-select">
                    <option value="">Semua</option>
                    <option value="PNS" {{ request('jenis_kepegawaian') == 'PNS' ? 'selected' : '' }}>PNS</option>
                    <option value="PPPK" {{ request('jenis_kepegawaian') == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-filter"></i> Filter
                </button>
                <a href="{{ route('payroll.result') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>

        </form>
    </div>
</div>


        {{-- Table Data Gaji --}}
        <div class="table-responsive mt-4">
            <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0">
                <thead class="bg-light text-center">
                    <tr>
                        <th title="Nama lengkap karyawan">Nama Karyawan</th>
                        <th title="Nama lengkap karyawan">Jenis Pegawai</th>
                        <th title="Nama lengkap karyawan">Periode Gaji</th>
                        <th title="PP Nomor 10 Tahun 2024(PNS) dan PP Nomor 11 Tahun 2024(PPPK)">Gaji Pokok</th>
                        <th title="PP Nomor 12 Tahun 2006">Tunj. Umum</th>
                        <th title="PP Nomor 65 Tahun 2007">Tunj. Fungsional</th>
                        <th title="Nama lengkap karyawan">Tunj. Pembulatan</th>
                        <th title="Peraturan Direktur Jenderal Perbendaharaan Nomor Per-3/PB/2015">Tunj. Beras</th>
                        <th title="PP Nomor 51 Tahun 1992">Tunj. Istri/Suami</th>
                        <th title="PP Nomor 51 Tahun 1992">Tunj. Anak</th>
                        <th title="PP Nomor 53 Tahun 2023">Tunj. Lain-Lain</th>
                        <th>Gaji Kotor</th>
                        <th title="PP Nomor 58 Tahun 2023">PPh21</th>
                        <th title="PP Nomor 64 Tahun 2020">BPJS</th>
                        <th title="Nama lengkap karyawan">IWP 8%</th>
                        <th title="Nama lengkap karyawan">IWP 1%</th>
                        <th title="Nama lengkap karyawan">Pot. Lain</th>
                        <th title="Nama lengkap karyawan">Total Potongan</th>
                        <th title="Nama lengkap karyawan">Gaji Bersih</th>
                        <th title="Nama lengkap karyawan">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php use Carbon\Carbon; @endphp
                    @forelse ($salaries as $salary)
                        @php
                            $isNew = Carbon::parse($salary->created_at)->diffInMinutes(now()) <= 60;
                            $isUpdated = !$isNew && Carbon::parse($salary->updated_at)->diffInMinutes(now()) <= 60;
                            $rowClass = $isNew ? 'table-success' : ($isUpdated ? 'table-warning' : '');
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <td>{{ $salary->employee->nama ?? '-' }} @if ($isNew)
                                    <span class="badge bg-success ms-1">Baru</span>
                                @elseif ($isUpdated)
                                    <span class="badge bg-warning text-dark ms-1">Diupdate</span>
                                @endif</td>
                            <td>{{ $salary->employee->jenisKepegawaian ?? '-' }}</td>
                            <td>{{ $salary->periode_gaji }}</td>
                            <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_umum, 0, ',', '.') }}</td>
                            <td >Rp {{ number_format($salary->tunjangan_fungsional, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_pembulatan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_beras, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_istri_suami, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_anak, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_lain_lain, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->gaji_kotor, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_pph21, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_bpjs, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_iwp_8, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_iwp_1, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_lain, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->total_potongan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->gaji_bersih, 0, ',', '.') }}</td>

                            <td class="text-center">
                                <a href="{{ route('payroll.slip.pdf', ['id' => $salary->id]) }}"
                                   class="btn btn-sm btn-outline-danger mb-1" title="Download PDF">
                                    <i class="bi bi-file-earmark-arrow-down"></i>
                                </a>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-primary btn-edit-salary mb-1"
                                        title="Edit Gaji"
                                        data-id="{{ $salary->id }}"
                                        data-employee-name="{{ $salary->employee->nama }}"
                                        data-periode-gaji="{{ \Carbon\Carbon::parse($salary->periode_gaji)->format('Y-m') }}"
                                        data-tunjangan-lain-lain="{{ $salary->tunjangan_lain_lain }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>


                                <form action="{{ route('payroll.destroy', $salary->id) }}" method="POST"
                                      style="display:inline-block;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="20" class="text-center text-muted">Belum ada data gaji.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $salaries->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

<!-- Modal Edit Gaji -->
<div class="modal fade" id="editSalaryModal" tabindex="-1" aria-labelledby="editSalaryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="editSalaryForm" method="POST" action="">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editSalaryModalLabel">Edit Data Gaji</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="salary_id" id="salary_id" />

          <div class="row g-3">
            <div class="col-md-6">
              <label for="employee_name" class="form-label">Nama Karyawan</label>
              <input type="text" id="employee_name" class="form-control" readonly>
            </div>

            <div class="col-md-6">
              <label for="periode_gaji" class="form-label">Periode Gaji</label>
              <input type="text" name="periode_gaji" id="periode_gaji" class="form-control" readonly>
            </div>

            <div class="col-md-6">
              <label for="tunjangan_lain_lain" class="form-label">Tunjangan Lain-Lain (Honorarium)</label>
              <input type="number" name="tunjangan_lain_lain" id="tunjangan_lain_lain" class="form-control" min="0" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- SweetAlert2 Delete Confirmation --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // cegah submit otomatis

            Swal.fire({
                title: 'Yakin ingin menghapus data gaji ini?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // lanjut submit form jika konfirmasi
                }
            });
        });
    });
});

$(document).on('click', '.btn-edit-salary', function() {
    let id = $(this).data('id');
    let nama = $(this).data('employee-name');
    let periode = $(this).data('periode-gaji');
    let tunjanganLain = $(this).data('tunjangan-lain-lain');

    $('#salary_id').val(id);
    $('#employee_name').val(nama);
    $('#periode_gaji').val(periode);
    $('#tunjangan_lain_lain').val(tunjanganLain);

    $('#editSalaryForm').attr('action', `/payroll/${id}/update-tunjangan`);


    $('#editSalaryModal').modal('show');
});

$('#editSalaryForm').submit(function(e) {
    e.preventDefault();

    let url = $(this).attr('action');
    let data = $(this).serialize();

    $.ajax({
        url: url,
        method: 'PUT',
        data: data,
       success: function(res) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: res.message,
            confirmButtonText: 'OK',
        }).then(() => {
            location.reload(); // reload halaman setelah konfirmasi
        });
    },
        error: function(xhr) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan data.',
            confirmButtonText: 'Tutup',
        });
    }

    });
});

</script>

@endsection
