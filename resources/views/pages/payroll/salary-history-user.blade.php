@extends('layouts.admin.main')

@section('content')
<div class="bg-white min-vh-100 py-4">
    <div class="container">
        <h2 class="fw-bold text-primary">Riwayat Gaji Saya</h2>

        <form method="GET" action="{{ route('salary.history.user') }}" class="row gy-2 gx-3 align-items-center mb-4">
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
                <a href="{{ route('salary.history.user') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="card border-2" style="border-radius: 10px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle table-hover m-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Bulan</th>
                                <th>Gaji Pokok</th>
                                <th>Tunjangan Transportasi</th>
                                <th>Tunjangan Makan</th>
                                <th>Tunjangan Kesehatan</th>
                                <th>Tukin</th>
                                <th>Total Tunjangan</th>
                                <th>Bonus</th>
                                <th>Insentif</th>
                                <th>Lembur</th>
                                <th>Gaji Kotor</th>
                                <th>Total Potongan</th>
                                <th>Total Gaji</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($salaryHistory as $salary)
                                @php
                                    $totalTunjangan = $salary->tunjanganTransportasi + $salary->tunjanganMakan + $salary->tunjanganKesehatan + $salary->tukin;
                                    $gajiKotor = $salary->gajiPokok + $totalTunjangan + $salary->bonus + $salary->insentif + $salary->lembur;
                                @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($salary->periodeGaji)->translatedFormat('F Y') }}</td>
                                    <td>{{ number_format($salary->gajiPokok, 0, ',', '.') }}</td>
                                    <td>{{ number_format($salary->tunjanganTransportasi, 0, ',', '.') }}</td>
                                    <td>{{ number_format($salary->tunjanganMakan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($salary->tunjanganKesehatan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($salary->tukin, 0, ',', '.') }}</td>
                                    <td>{{ number_format($totalTunjangan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($salary->bonus, 0, ',', '.') }}</td>
                                    <td>{{ number_format($salary->insentif, 0, ',', '.') }}</td>
                                    <td>{{ number_format($salary->lembur, 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiKotor, 0, ',', '.') }}</td>
                                    <td>{{ number_format($salary->totalPotongan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($salary->totalGaji, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($salary->created_at)->format('d F Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="text-muted">Tidak ada riwayat gaji.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {{ $salaryHistory->links('pagination::bootstrap-5') }}
        </div>

        <hr class="my-5">

        <h2 class="fw-bold text-primary">Riwayat Perubahan Gaji Saya</h2>

        <form method="GET" action="{{ route('salary.history.user') }}" class="row gy-2 gx-3 align-items-center mb-4">
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
                <a href="{{ route('salary.history.user') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="table-responsive mt-3">
            @forelse($salaryLogs->sortByDesc('updated_at') as $log)
                <table class="table table-bordered table-striped table-hover mb-4">
                    <thead class="table-light text-center">
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
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($log->updated_at)->format('d M Y H:i') }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $log->field)) }}</td>
                            <td class="text-end">{{ number_format($log->old_value, 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($log->new_value, 0, ',', '.') }}</td>
                            <td class="text-center">
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
                    </tbody>
                </table>
            @empty
                <h4 class="text-muted text-center">Tidak ada riwayat perubahan gaji.</h4>
            @endforelse
        </div>
    </div>
</div>
@endsection
