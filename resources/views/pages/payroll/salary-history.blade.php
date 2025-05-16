@extends('layouts.admin.main')

@section('content')
<div class="bg-white min-vh-100 py-4">
    <div class="container">
        <h2 class="fw-bold text-primary">Riwayat Gaji Karyawan</h2>
        <form method="GET" action="{{ route('salary.history') }}" class="row gy-2 gx-3 align-items-center mb-4">
            <div class="col-md-3">
                <input type="text" name="search_nama" class="form-control" placeholder="Cari nama karyawan..." value="{{ request('search_nama') }}">
            </div>
            <div class="col-md-2">
                <select name="filter_bulan" class="form-select">
                    <option value="">-- Bulan --</option>
                    @foreach(range(1, 12) as $bulan)
                        <option value="{{ $bulan }}" {{ request('filter_bulan') == $bulan ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="filter_tahun" class="form-select">
                    <option value="">-- Tahun --</option>
                    @foreach(range(date('Y'), date('Y') - 10) as $tahun)
                        <option value="{{ $tahun }}" {{ request('filter_tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('salary.history') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle table-hover m-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Karyawan</th>
                        <th>Bulan</th>
                        <th>Gaji Pokok</th>
                        <th>Tunjangan Transportasi</th>
                        <th>Tunjangan Makan</th>
                        <th>Tunjangan Kesehatan</th>
                        <th>Bonus</th>
                        <th>Insentif</th>
                        <th>Lembur</th>
                        <th>Total Potongan</th>
                        <th>Total Gaji</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                    <tbody class="text-center">
                        @forelse($salaryHistory as $salary)
                        <tr>
                            <td>{{ $salary->employee->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($salary->created_at)->format('F Y') }}</td>
                            <td>{{ number_format($salary->gajiPokok, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->tunjanganTransportasi, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->tunjanganMakan, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->tunjanganKesehatan, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->bonus, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->insentif, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->lembur, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->totalPotongan, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->totalGaji, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($salary->created_at)->format('d F Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-muted">Tidak ada riwayat gaji</td>
                        </tr>
                        @endforelse
                    </tbody>

            </table>
        </div>
        <div class="mt-3">
            {{ $salaryHistory->links('pagination::bootstrap-5') }}
        </div>


        <hr class="my-5">

        <h2 class="fw-bold text-primary">Riwayat Perubahan Gaji</h2>

        <form method="GET" action="{{ route('salary.history') }}" class="row gy-2 gx-3 align-items-center mb-4">
            <div class="col-md-3">
                <input type="text" name="nama" class="form-control" placeholder="Cari nama karyawan..." value="{{ request('nama') }}">
            </div>
            <div class="col-md-2">
                <select name="bulan" class="form-select">
                    <option value="">-- Bulan --</option>
                    @foreach(range(1, 12) as $bulan)
                        <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="tahun" class="form-select">
                    <option value="">-- Tahun --</option>
                    @foreach(range(date('Y'), date('Y') - 10) as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('salary.history') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="table-responsive mt-3">
            @forelse($salaryLogs->groupBy('employee_id') as $employeeId => $logs)
            <div class="mb-4 border rounded p-3 shadow-sm">
                <h3 class="mb-3 text-success fw-bold">{{ $logs->first()->employee->nama }}</h3>
                <table class="table table-bordered table-striped table-hover m-0">
                    <thead class="table-light">
                        <tr>
                            <th>Waktu</th>
                            <th>Komponen</th>
                            <th>Nilai Lama</th>
                            <th>Nilai Baru</th>
                            <th>Perubahan</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs->sortByDesc('updated_at') as $log)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($log->updated_at)->format('d M Y H:i') }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $log->field)) }}</td>
                            <td>{{ number_format($log->old_value, 0, ',', '.') }}</td>
                            <td>{{ number_format($log->new_value, 0, ',', '.') }}</td>
                            <td>
                                @if($log->new_value > $log->old_value)
                                    <span class="badge bg-success">Naik</span>
                                @elseif($log->new_value < $log->old_value)
                                    <span class="badge bg-danger">Turun</span>
                                @else
                                    <span class="badge bg-secondary">Tetap</span>
                                @endif
                            </td>
                            <td>{{ $log->alasan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @empty
            <h4 class="text-muted text-center">Tidak ada riwayat perubahan gaji.</h4>
            @endforelse
        </div>
    </div>
</div>
@endsection
