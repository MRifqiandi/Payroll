@extends('layouts.admin.main')
@section('title', 'Daftar Pegawai')

{{-- Modal Detail Pegawai --}}
@section('modal')
    @include('pages.employee.modal.detail')
    @include('pages.employee.modal.edit')
@endsection

@section('content')
<div class="card card-flush h-md-100">
    <div class="card-body pt-6">
        <div class="d-flex justify-content-between align-items-center pb-3 flex-wrap gap-3">
            <h2 class="fw-bold text-primary">Daftar Pegawai</h2>
            <a href="{{ route('employee.create') }}" class="btn btn-primary shadow-sm text-white">
                <i class="bi bi-person-plus"></i> Add Account
            </a>
        </div>

        {{-- Scroll Horizontal untuk Tabel --}}
        <div class="table-responsive">
            <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0 w-100" style="min-width: 1200px;">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                        <th class="w-50px text-center">NO</th>
                        <th style="min-width: 150px">NAMA</th>
                        <th style="min-width: 120px">NIK</th>
                        <th style="min-width: 200px">EMAIL</th>
                        <th style="min-width: 130px">TELEPON</th>
                        <th style="min-width: 150px">DEPARTEMEN</th>
                        <th style="min-width: 180px">JABATAN</th>
                        <th style="min-width: 100px">GOLONGAN</th>
                        <th style="min-width: 120px">STATUS</th>
                        <th style="min-width: 150px" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="fs-7">
                    @foreach ($employees as $emp)
                        <tr>
                            <td class="text-center">
                                {{ ($employees->currentPage() - 1) * $employees->perPage() + $loop->iteration }}
                            </td>
                            <td class="text-wrap">{{ $emp->nama }}</td>
                            <td>{{ $emp->nik }}</td>
                            <td class="text-wrap">{{ $emp->email }}</td>
                            <td>{{ $emp->telepon }}</td>
                            <td class="text-wrap">{{ $emp->departemen }}</td>
                            <td class="text-wrap">{{ $emp->jabatanFungsional->nama_jabatan_fungsional ?? '-' }}</td>
                            <td>{{ $emp->golongan }}</td>
                            <td>
                                <span class="badge
                                    @if($emp->statusKepegawaian == 'aktif') bg-success
                                    @elseif($emp->statusKepegawaian == 'tugas belajar') bg-warning
                                    @else bg-secondary @endif">
                                    {{ ucfirst($emp->statusKepegawaian) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-info btn-detail" data-emp='@json($emp)' title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary btn-edit" data-emp='@json($emp)' title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('employee.destroy', $emp->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $employees->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function formatDate(dateStr) {
        if (!dateStr) return '-';
        const date = new Date(dateStr);
        return date.toLocaleDateString('id-ID', {
            day: '2-digit', month: 'long', year: 'numeric'
        });
    }

    $(document).on('click', '.btn-detail', function () {
        const emp = $(this).data('emp');

        $('#detail_nama').text(emp.nama ?? '-');
        $('#detail_nik').text(emp.nik ?? '-');
        $('#detail_email').text(emp.email ?? '-');
        $('#detail_telepon').text(emp.telepon ?? '-');
        $('#detail_alamat').text(emp.alamat ?? '-');
        $('#detail_tanggalLahir').text(formatDate(emp.tanggalLahir));
        $('#detail_statusPernikahan').text(emp.statusPernikahan ?? '-');
        $('#detail_departemen').text(emp.departemen ?? '-');
        $('#detail_jabatan').text(emp.jabatan ?? '-');
        $('#detail_jabatan_fungsional_id').text(emp.jabatan_fungsional_id ?? '-');
        $('#detail_golongan').text(emp.golongan ?? '-');
        $('#detail_npwp').text(emp.npwp ?? '-');
        $('#detail_statusKepegawaian').text(emp.statusKepegawaian ?? '-');
        $('#detail_ptkp_id').text(emp.ptkp_id ?? '-');
        $('#detail_tanggalKeluar').text(formatDate(emp.tanggalKeluar));
        $('#detail_tanggal_kgb_terakhir').text(formatDate(emp.tanggal_kgb_terakhir));
        $('#detail_prediksi_kgb_berikutnya').text(formatDate(emp.prediksi_kgb_berikutnya));
        $('#detail_tanggal_naik_golongan_terakhir').text(formatDate(emp.tanggal_naik_golongan_terakhir));

        $('#modal_detail_employee').modal('show');
    });

    $(document).on('click', '.btn-edit', function () {
    const emp = $(this).data('emp');

    $('#edit_id').val(emp.id);
    $('#edit_nama').val(emp.nama ?? '');
    $('#edit_nik').val(emp.nik ?? '');
    $('#edit_email').val(emp.email ?? '');
    $('#edit_telepon').val(emp.telepon ?? '');
    $('#edit_alamat').val(emp.alamat ?? '');
    $('#edit_tanggalLahir').val(emp.tanggalLahir ?? '');
    $('#edit_tanggalMasuk').val(emp.tanggalMasuk ?? '');
    $('#edit_tanggalKeluar').val(emp.tanggalKeluar ?? '');
    $('#edit_statusPernikahan').val(emp.statusPernikahan ?? '');
    $('#edit_statusKepegawaian').val(emp.statusKepegawaian ?? '');
    // $('#edit_masaKerja').val(emp.masaKerja ?? '');
    $('#edit_jabatan').val(emp.jabatan ?? '');
    $('#edit_departemen').val(emp.departemen ?? '');
    $('#edit_golongan').val(emp.golongan ?? '');
    $('#edit_npwp').val(emp.npwp ?? '');
    $('#edit_ptkp_id').val(emp.ptkp_id ?? '');
    $('#edit_jabatan_fungsional_id').val(emp.jabatan_fungsional_id ?? '');
    $('#password').val(emp.password ?? '');

    $('#modal_edit_employee').modal('show');
});

$(document).on('submit', '.delete-form', function(e) {
    e.preventDefault();
    const form = this;

    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});


@if (session('success'))

    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        toast: true,
        position: 'top-end',
    });

@endif
</script>
@endsection
