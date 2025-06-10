<!DOCTYPE html>
<html>
<head>
    <title>Data Gaji</title>
    <style>
        body { font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 4px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Data Gaji Seluruh Karyawan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Periode</th>
                <th>Gaji Pokok</th>
                <th>Tunj. Umum</th>
                <th>Tunj. Fungsional</th>
                <th>Tunj. Kinerja</th>
                <th>Tunj. Pembulatan</th>
                <th>Tunj. Istri/Suami</th>
                <th>Tunj. Anak</th>
                <th>Uang Makan</th>
                <th>Uang Lembur</th>
                <th>Gaji Kotor</th>
                <th>PPh21</th>
                <th>BPJS</th>
                <th>Potongan Lain</th>
                <th>Total Potongan</th>
                <th>Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $salary)
            <tr>
                <td>{{ $salary->id }}</td>
                <td>{{ $salary->employee->nama ?? '-' }}</td>
                <td>{{ $salary->periode_gaji }}</td>
                <td>{{ number_format($salary->gaji_pokok) }}</td>
                <td>{{ number_format($salary->tunjangan_umum) }}</td>
                <td>{{ number_format($salary->tunjangan_fungsional) }}</td>
                <td>{{ number_format($salary->tunjangan_kinerja) }}</td>
                <td>{{ number_format($salary->tunjangan_pembulatan) }}</td>
                <td>{{ number_format($salary->tunjangan_istri_suami) }}</td>
                <td>{{ number_format($salary->tunjangan_anak) }}</td>
                <td>{{ number_format($salary->uang_makan) }}</td>
                <td>{{ number_format($salary->uang_lembur) }}</td>
                <td>{{ number_format($salary->gaji_kotor) }}</td>
                <td>{{ number_format($salary->potongan_pph21) }}</td>
                <td>{{ number_format($salary->potongan_bpjs) }}</td>
                <td>{{ number_format($salary->potongan_lain) }}</td>
                <td>{{ number_format($salary->total_potongan) }}</td>
                <td>{{ number_format($salary->gaji_bersih) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
