@extends('layouts.admin.main') {{-- Ganti sesuai layout employee-mu --}}

@section('content')
<div class="card card-flush h-md-100">
    <div class="card-body pt-6">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center pb-3 flex-wrap gap-3">
            <h2 class="fw-bold text-primary m-0">📄 Daftar Gaji Saya</h2>
                       <a href="{{ route('salary.raise.user') }}" class="btn btn-primary shadow-sm text-white">
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
                <thead class="bg-light text-center align-middle">
                    <tr>
                        <th class="text-nowrap" style="min-width: 140px;">Periode Gaji</th>
                        <th>Gaji Pokok</th>
                        <th>Tunj. Umum</th>
                        <th>Tunj. Fungsional</th>
                        <th>Tunj. Pembulatan</th>
                        <th>Tunj. Beras</th>
                        <th>Tunj. Istri/Suami</th>
                        <th>Tunj. Anak</th>
                        <th>Tunj. Lain-Lain</th>
                        <th>Uang Makan</th>
                        <th>Uang Lembur</th>
                        <th>Gaji Kotor</th>
                        <th>PPh21</th>
                        <th>BPJS</th>
                        <th>IWP 8%</th>
                        <th>IWP 1%</th>
                        <th>Pot. Lain</th>
                        <th>Total Potongan</th>
                        <th>Gaji Bersih</th>
                        <th>Slip Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salaries as $salary)
                        <tr>
                            <td class="text-nowrap" style="min-width: 140px;">
                                {{ \Carbon\Carbon::parse($salary->periode_gaji)->translatedFormat('d-F-Y') }}
                            </td>

                            <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_umum, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_fungsional, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_pembulatan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_beras, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_istri_suami, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_anak, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->tunjangan_lain_lain, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->uang_makan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->uang_lembur, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->gaji_kotor, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_pph21, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_bpjs, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_iwp_8, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_iwp_1, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->potongan_lain, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->total_potongan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($salary->gaji_bersih, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('salary.slip', ['id' => $salary->id]) }}"
                                   class="btn btn-sm btn-danger" target="_blank"
                                   title="Download Slip Gaji">
                                    <i class="bi bi-download"></i> Slip
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="21" class="text-center text-muted">Tidak ada data gaji ditemukan.</td>
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
@endsection
