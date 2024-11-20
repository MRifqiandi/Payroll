<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            line-height: 1.6;
        }
        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 5px 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h4 {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</h2>
        <h2>RISET DAN TEKNOLOGI</h2>
        <h3>INSTITUT TEKNOLOGI KALIMANTAN</h3>
        <p>Kampus ITK Karang Joang, Balikpapan 76127</p>
        <p>Telp: 0542-8530801, Fax: 0542-8530800</p>
        <p>Email: humas@itk.ac.id</p>
    </div>
    <div class="section">
        <h4>A. IDENTITAS PEGAWAI</h4>
        <p><strong>Nama:</strong> {{ $data["nama"] }}</p>
        <p><strong>NIP/NIPPPK/NIPH:</strong> {{ $data["nip"] }}</p>
        <p><strong>Pangkat/Golongan:</strong> {{ $data["pangkat"] }}</p>
        <p><strong>Jabatan:</strong> {{ $data["jabatan"] }}</p>
    </div>
    <div class="section">
        <h4>B. PENGHASILAN</h4>
        <table>
            <tr>
                <th>Jenis Penghasilan</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td>{{ $data["gaji_pokok"] }}</td>
            </tr>
            <tr>
                <td>Tunjangan Istri/Suami</td>
                <td>{{ $data["tunjangan_istri_suami"] }}</td>
            </tr>
            <tr>
                <td>Tunjangan Anak</td>
                <td>{{ $data["tunjangan_anak"] }}</td>
            </tr>
            <tr>
                <td>Tunjangan Umum</td>
                <td>{{ $data["tunjangan_umum"] }}</td>
            </tr>
            <tr>
                <td>Tunjangan Beras</td>
                <td>{{ $data["tunjangan_beras"] }}</td>
            </tr>
            <tr>
                <td>Tunjangan Pajak</td>
                <td>{{ $data["tunjangan_pajak"] }}</td>
            </tr>
            <tr>
                <td><strong>Penghasilan Kotor</strong></td>
                <td><strong>{{ $data["penghasilan_kotor"] }}</strong></td>
            </tr>
        </table>
    </div>
    <div class="section">
        <h4>C. POTONGAN-POTONGAN</h4>
        <table>
            <tr>
                <th>Jenis Potongan</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>IWP</td>
                <td>{{ $data["iwp"] }}</td>
            </tr>
            <tr>
                <td>POT. BPJS</td>
                <td>{{ $data["pot_bpjs"] }}</td>
            </tr>
            <tr>
                <td><strong>Jumlah Potongan</strong></td>
                <td><strong>{{ $data["jumlah_potongan"] }}</strong></td>
            </tr>
        </table>
        <p><strong>Penghasilan Bersih:</strong> {{ $data["penghasilan_bersih"] }}</p>
    </div>
    <div class="footer">
        <p>Balikpapan, {{ $data["tanggal"] }}</p>
        <p>{{ $data["nama_pembuat"] }}</p>
        <p>NIP {{ $data["nip_pembuat"] }}</p>
    </div>
</body>

</html>
