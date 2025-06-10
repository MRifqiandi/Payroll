<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Bukti Potongan BPJS</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #222; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        td, th { vertical-align: top; padding: 6px 8px; border-bottom: 1px solid #ddd; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .section-title { font-weight: bold; margin-top: 20px; margin-bottom: 10px; font-size: 14px; }
        hr { border: 1px solid black; margin-top: 5px; margin-bottom: 15px; }
        .signature { margin-top: 60px; }
        img.logo { height: 80px; }
    </style>
</head>
<body>
    <table>
        <tr>
            <td style="width: 90px;">
                <img src="{{ public_path('itk.png') }}" alt="Logo" class="logo">
            </td>
            <td class="text-center" style="font-size: 13px;">
                <strong>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,<br>
                RISET, DAN TEKNOLOGI</strong><br>
                <strong>INSTITUT TEKNOLOGI KALIMANTAN</strong><br>
                <span style="font-size: 11px;">
                    Kampus ITK Karang Joang, Balikpapan 76127<br>
                    Telp. 0542-8530801, Fax. 0542-8530800<br>
                    Email: humas@itk.ac.id
                </span>
            </td>
        </tr>
    </table>

    <hr>

    <h4 class="text-center">BUKTI POTONGAN BPJS KARYAWAN</h4>
    <h5 class="text-center">PERIODE: {{ strtoupper(\Carbon\Carbon::parse($bpjs->periode)->translatedFormat('F Y')) }}</h5>

    <p class="section-title">A. IDENTITAS KARYAWAN</p>
    <table>
        <tr><td style="width: 180px;">Nama Karyawan</td><td>: {{ $bpjs->employee->nama }}</td></tr>
        <tr><td>Periode Potongan</td><td>: {{ \Carbon\Carbon::parse($bpjs->periode)->translatedFormat('F Y') }}</td></tr>
    </table>

    <p class="section-title">B. RINCIAN POTONGAN BPJS</p>
    <table>
        <tr><td>Iuran Perusahaan</td><td class="text-right">Rp {{ number_format($bpjs->iuran_perusahaan, 0, ',', '.') }}</td></tr>
        <tr><td>Iuran Peserta</td><td class="text-right">Rp {{ number_format($bpjs->iuran_peserta, 0, ',', '.') }}</td></tr>
        <tr><td><strong>Total Iuran</strong></td><td class="text-right"><strong>Rp {{ number_format($bpjs->iuran_total, 0, ',', '.') }}</strong></td></tr>
    </table>

    <div class="signature text-right">
        Balikpapan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
        Petugas Administrasi SIM GAJI<br><br><br>
        <strong>(_____________________)</strong>
    </div>
</body>
</html>
