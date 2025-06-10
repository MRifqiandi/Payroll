@extends('layouts.admin.main')

@section('title', 'History Kenaikan Gaji')

@section('content')
    <div class="bg-white min-vh-100 py-4">
    <div class="d-flex justify-content-between align-items-center pb-3 gap-3">
<div class="container">
    <h1 class="mb-4 fw-bold text-primary">📈 Histori Kenaikan Gaji Saya</h1>

    @if($salaryRaises->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Karyawan</th>
                    <th>Gaji Lama</th>
                    <th>Gaji Baru</th>
                    <th>% Kenaikan</th>
                    <th>Alasan</th>
                    <th>Tanggal Kenaikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salaryRaises as $index => $raise)
                    <tr>
                        <td>{{ $salaryRaises->firstItem() + $index }}</td>
                        <td>{{ $raise->employee->nama ?? 'N/A' }}</td>
                        <td>Rp {{ number_format($raise->gajiLama, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($raise->gajiBaru, 0, ',', '.') }}</td>
                        <td>{{ number_format($raise->persentaseKenaikan, 2) }}%</td>
                        <td>{{ $raise->alasan }}</td>
                        <td>{{ \Carbon\Carbon::parse($raise->tanggalKenaikan)->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

                   <div class="mt-3">
            {{ $salaryRaises->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">Belum ada data kenaikan gaji.</div>
    @endif
</div>
</div>
</div>
@endsection
