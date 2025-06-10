<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Slip Penghasilan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { vertical-align: top; padding: 4px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .section-title { font-weight: bold; margin-top: 20px; }
        .signature { margin-top: 60px; }
    </style>
</head>
<body>
      <table>
        <tr>
            <td style="width: 80px;">
                <img src="{{ public_path('itk.png') }}" height="100">
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

    <hr style="border: 1px solid black; margin-top: 5px; margin-bottom: 15px;">


    <h4 class="text-center">SURAT KETERANGAN PENGHASILAN PEGAWAI</h4>
    <h5 class="text-center">BULAN: {{ strtoupper(\Carbon\Carbon::parse($salary->periode_gaji)->translatedFormat('F Y')) }}</h5>

    <p class="section-title">A. IDENTITAS PEGAWAI</p>
    <table>
        <tr><td>1. Nama</td><td>: {{ $salary->employee->nama }}</td></tr>
        <tr><td>2. NIP/NIPPPK/NIPH</td><td>: {{ $salary->employee->nip ?? '-' }}</td></tr>
        <tr><td>3. Pangkat/Golongan</td><td>: {{ $salary->employee->golongan ?? '-' }}</td></tr>
        <tr><td>4. Jabatan</td><td>: {{ $salary->employee->jabatan ?? '-' }}</td></tr>
    </table>

    <p class="section-title">B. PENGHASILAN</p>
    <table>
        <tr><td>Gaji Pokok</td><td class="text-right">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td></tr>
        <tr><td>Tunjangan Umum</td><td class="text-right">Rp {{ number_format($salary->tunjangan_umum, 0, ',', '.') }}</td></tr>
        <tr><td>Tunjangan Fungsional</td><td class="text-right">Rp {{ number_format($salary->tunjangan_fungsional, 0, ',', '.') }}</td></tr>
        <tr><td>Tunjangan Kinerja</td><td class="text-right">Rp {{ number_format($salary->tunjangan_kinerja, 0, ',', '.') }}</td></tr>
        <tr><td>Tunjangan Pembulatan</td><td class="text-right">Rp {{ number_format($salary->tunjangan_pembulatan, 0, ',', '.') }}</td></tr>
        <tr><td>Tunjangan Beras</td><td class="text-right">Rp {{ number_format($salary->tunjangan_beras, 0, ',', '.') }}</td></tr>
        <tr><td>Tunjangan Istri/Suami</td><td class="text-right">Rp {{ number_format($salary->tunjangan_istri_suami, 0, ',', '.') }}</td></tr>
        <tr><td>Tunjangan Anak</td><td class="text-right">Rp {{ number_format($salary->tunjangan_anak, 0, ',', '.') }}</td></tr>
        <tr><td>Uang Makan</td><td class="text-right">Rp {{ number_format($salary->uang_makan, 0, ',', '.') }}</td></tr>
        <tr><td>Uang Lembur</td><td class="text-right">Rp {{ number_format($salary->uang_lembur, 0, ',', '.') }}</td></tr>
        <tr><td><strong>Gaji Kotor</strong></td><td class="text-right"><strong>Rp {{ number_format($salary->gaji_kotor, 0, ',', '.') }}</strong></td></tr>
    </table>

    <p class="section-title">C. POTONGAN</p>
    <table>
        <tr><td>Potongan PPh21</td><td class="text-right">Rp {{ number_format($salary->potongan_pph21, 0, ',', '.') }}</td></tr>
        <tr><td>Potongan BPJS</td><td class="text-right">Rp {{ number_format($salary->potongan_bpjs, 0, ',', '.') }}</td></tr>
        <tr><td>Potongan Lain-lain</td><td class="text-right">Rp {{ number_format($salary->potongan_lain, 0, ',', '.') }}</td></tr>
        <tr><td><strong>Total Potongan</strong></td><td class="text-right"><strong>Rp {{ number_format($salary->total_potongan, 0, ',', '.') }}</strong></td></tr>
    </table>

    <p class="section-title">D. PENGHASILAN BERSIH</p>
    <table>
        <tr><td>Total Diterima</td><td class="text-right">Rp {{ number_format($salary->gaji_bersih, 0, ',', '.') }}</td></tr>
    </table>

    <p class="fw-bold">Terbilang: {{ ucwords(terbilang($salary->gaji_bersih)) }} Rupiah</p>

    <div class="signature">
        <div class="text-right">
            Balikpapan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
            Petugas Pengelolaan Administrasi<br>
            Belanja Pegawai (PPABP)<br><br><br>
            <strong>Dwi Harti Ningrum</strong><br>
            NIP 199609112022032020
        </div>
    </div>
</body>
</html>
