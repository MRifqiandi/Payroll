@extends('layouts.admin.main')

@section('content')
<div class="bg-white min-vh-100 py-4" style="border-radius: 0.5rem;">
    <div class="container-fluid justify-content-center align-items-center pt-md-1 pt-lg-3">

    <h2 class="mb-2 text-center fw-bold text-primary">Form Input Penggajian</h2>

    <!-- Form untuk memilih karyawan -->
    <div class="form-group">
        <label for="employee_id">Pilih Karyawan:</label>
        <select name="employee_id" id="employee_id" class="form-control" required>
            <option value="">Pilih Karyawan</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                    {{ $employee->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Tabel Riwayat Kenaikan Gaji -->
    <table class="table table-bordered table-striped mt-3" id="salaryRaiseTable">
        <thead>
            <tr>
                <th>Tanggal Kenaikan</th>
                <th>Gaji Lama</th>
                <th>Gaji Baru</th>
                <th>Persentase Kenaikan</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            <tr id="emptyRow">
                <td colspan="5" class="text-center">Pilih karyawan untuk melihat riwayat kenaikan gaji.</td>
            </tr>
        </tbody>
    </table>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Ketika memilih karyawan dari dropdown
        $('#employee_id').change(function() {
            var employeeId = $(this).val();

            if (employeeId) {
                // Kirim request AJAX untuk mendapatkan data kenaikan gaji
                $.ajax({
                    url: "{{ route('salary.raise.history') }}",
                    method: "GET",
                    data: { employee_id: employeeId },
                    success: function(response) {
                        // Menghapus row kosong jika ada
                        $('#salaryRaiseTable tbody').empty();

                        if (response.salaryRaises.length > 0) {
                            // Loop melalui data kenaikan gaji dan menampilkan ke tabel
                            response.salaryRaises.forEach(function(salaryRaise) {
                                $('#salaryRaiseTable tbody').append(
                                    '<tr>' +
                                        '<td>' + salaryRaise.tanggalKenaikan + '</td>' +
                                        '<td>Rp ' + formatRupiah(salaryRaise.gajiLama) + '</td>' +
                                        '<td>Rp ' + formatRupiah(salaryRaise.gajiBaru) + '</td>' +
                                        '<td>' + salaryRaise.persentaseKenaikan + '%</td>' +
                                        '<td>' + salaryRaise.alasan + '</td>' +
                                    '</tr>'
                                );
                            });
                        } else {
                            $('#salaryRaiseTable tbody').append(
                                '<tr><td colspan="5" class="text-center">Tidak ada riwayat kenaikan gaji untuk karyawan ini.</td></tr>'
                            );
                        }
                    }
                });
            } else {
                // Jika tidak ada pilihan karyawan, tampilkan row kosong
                $('#salaryRaiseTable tbody').empty();
                $('#salaryRaiseTable tbody').append(
                    '<tr><td colspan="5" class="text-center">Pilih karyawan untuk melihat riwayat kenaikan gaji.</td></tr>'
                );
            }
        });

        // Fungsi untuk format angka Rupiah
        function formatRupiah(angka) {
            var number_string = angka.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }
    });
</script>
@endsection
