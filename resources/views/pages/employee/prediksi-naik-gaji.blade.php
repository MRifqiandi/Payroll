@extends('layouts.admin.main')

@section('content')
<div class="card card-flush h-md-100">
    <div class="card-body pt-6">
        <div class="d-flex justify-content-between align-items-center mb-4 gap-3">
            <h2 class="text-primary fw-bold mb-0">Prediksi Kenaikan Gaji Berkala</h2>
            <button id="btn-update-prediksi" class="btn btn-primary">
                Update Prediksi KGB Manual
            </button>
        </div>
                <!-- Informasi tambahan -->
        <div class="alert alert-info mb-4">
            <strong>Informasi:</strong> Prediksi kenaikan gaji berkala (KGB) juga diperbarui secara <strong>otomatis setiap hari pada pukul 00:00</strong>.
        </div>

        <!-- Alert Box -->
        <div id="alert-message" class="alert alert-success" style="display:none; transition: opacity 0.5s ease;"></div>
<div class="table-responsive mt-4">
            <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Golongan</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal KGB Terakhir</th>
                    <th>Prediksi KGB Berikutnya</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $emp)
                    <tr>
                        <td>{{ $emp->nama }}</td>
                        <td>{{ $emp->golongan }}</td>
                        <td>{{ $emp->tanggalMasuk }}</td>
                        <td>{{ $emp->tanggal_kgb_terakhir ?? '-' }}</td>
                        <td>{{ $emp->prediksi_kgb_berikutnya ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
            <div class="mt-3">
            {{ $employees->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
</div>

<script>
document.getElementById('btn-update-prediksi').addEventListener('click', function () {
    const btn = this;
    const alertBox = document.getElementById('alert-message');

    btn.disabled = true;
    btn.textContent = 'Memperbarui...';
    alertBox.style.display = 'none';
    alertBox.style.opacity = 1;

    fetch("{{ route('kgb.update-prediksi.manual') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        btn.disabled = false;
        btn.textContent = 'Update Prediksi KGB Manual';

        alertBox.textContent = data.message || 'Prediksi berhasil diperbarui.';
        alertBox.style.display = 'block';
        alertBox.style.opacity = 1;

        setTimeout(() => {
            alertBox.style.opacity = 0;
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 500); // tunggu sampai animasi selesai
        }, 4000); // tampil selama 4 detik
    })
    .catch(error => {
        btn.disabled = false;
        btn.textContent = 'Update Prediksi KGB Manual';
        alert('Gagal memperbarui prediksi KGB.');
        console.error(error);
    });
});
</script>
@endsection
