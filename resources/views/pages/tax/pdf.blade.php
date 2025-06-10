<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Potong PPh21</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 8px; border: 1px solid #ddd; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Bukti Potong PPh21</h2>
    <p><strong>Nama Karyawan:</strong> {{ $tax->employee->nama }}</p>
    <p><strong>Tanggal Laporan:</strong> {{ \Carbon\Carbon::parse($tax->tanggalLaporan)->format('d-m-Y') }}</p>

    <table>
        <tr><th>PTKP</th><td>{{ $tax->ptkp->kode_ptkp ?? '-' }} (Rp{{ number_format($tax->ptkp->nilai_ptkp ?? 0, 0, ',', '.') }})</td></tr>
        <tr><th>Penghasilan Neto Tahunan</th><td>Rp{{ number_format($tax->penghasilan_neto, 0, ',', '.') }}</td></tr>
        <tr><th>Biaya Jabatan</th><td>Rp{{ number_format($tax->biaya_jabatan, 0, ',', '.') }}</td></tr>
        <tr><th>Iuran Pensiun</th><td>Rp{{ number_format($tax->iuran_pensiun, 0, ',', '.') }}</td></tr>
        <tr><th>PKP</th><td>Rp{{ number_format($tax->penghasilan_kena_pajak, 0, ',', '.') }}</td></tr>
        <tr><th>PPh21 Tahunan</th><td>Rp{{ number_format($tax->pph21, 0, ',', '.') }}</td></tr>
    </table>

    <br><br>
    <p><i>Dicetak otomatis dari sistem pada {{ now()->format('d-m-Y H:i') }}</i></p>
</body>
</html>
