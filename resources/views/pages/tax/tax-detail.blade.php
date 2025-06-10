@extends('layouts.admin.main')
@section('title', 'Pajak Pph21')

@section('content')
<div class="card card-flush h-md-100">
    <div class="card-body pt-6">
    <h2 class="fw-bold text-primary mb-4">Riwayat Perhitungan PPh21</h2>

   <div class="table-responsive mt-4">
            <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0">
        <thead class="table-light">
            <tr>
                <th>Nama Karyawan</th>
                <th>PTKP</th>
                <th>Penghasilan Neto Tahunan</th>
                <th>Biaya Jabatan</th>
                <th>Iuran Pensiun</th>
                <th>PKP</th>
                <th>PPh21 Tahunan</th>
                <th>Tanggal Laporan</th>
                <th>Bukti Potong</th>
            </tr>
        </thead>
        <tbody>
            @forelse($taxes as $tax)
            <tr>
                <td>{{ $tax->employee->nama }}</td>
                 <td>
                    @if ($tax->ptkp)
                        {{ $tax->ptkp->kode_ptkp }} (Rp{{ number_format($tax->ptkp->nilai_ptkp, 0, ',', '.') }})
                    @else
                        <span class="text-muted">- (Rp0)</span>
                    @endif
                </td>
                <td>Rp {{ number_format($tax->penghasilan_neto, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($tax->biaya_jabatan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($tax->iuran_pensiun, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($tax->penghasilan_kena_pajak, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($tax->pph21, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($tax->tanggalLaporan)->format('d-m-Y') }}</td>
                <td class="text-center">

                    <a href="{{ route('tax.exportBuktiPotongPDF', $tax->id) }}"
                    class="btn btn-sm btn-outline-danger btn-download-pdf"
                    title="Download Bukti Potong (PDF)">
                        <i class="bi bi-file-earmark-arrow-down"></i>
                    </a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('tax.destroy', $tax->id) }}"
                        method="POST"
                        style="display:inline-block;"
                        class="delete-form">
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
                <td colspan="9" class="text-center text-muted">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
        <div class="mt-3">
        {{ $taxes->links('pagination::bootstrap-5') }}
    </div>
</div>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data bukti potong akan dihapus permanen!",
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
    document.querySelectorAll('.btn-download-pdf').forEach(button => {
  button.addEventListener('click', function(){
    this.disabled = true;
  });
});

</script>

@endsection
