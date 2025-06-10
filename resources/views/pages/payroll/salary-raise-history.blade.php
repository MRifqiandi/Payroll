@extends('layouts.admin.main')

@section('title', 'History Kenaikan Gaji')

@section('content')
    <div class="bg-white min-vh-100 py-4">
    <div class="d-flex justify-content-between align-items-center pb-3 gap-3">
<div class="container">
    <h1 class="mb-4 fw-bold text-primary">Histori Kenaikan Gaji</h1>

    <form method="GET" class="mb-4 d-flex gap-2 align-items-center">
        <label for="employee_id" class="me-2">Filter Karyawan:</label>
        <select name="employee_id" id="employee_id" class="form-select" style="max-width: 300px;">
            <option value="">-- Semua Karyawan --</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" @if(request('employee_id') == $employee->id) selected @endif>
                    {{ $employee->nama }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('salary_raise.index') }}" class="btn btn-secondary ms-2">Reset</a>
    </form>

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
