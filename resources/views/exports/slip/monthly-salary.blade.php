@php
    $format = function ($value) {
        return \App\Utils::FORMAT_CURRENCY($value);
    };
@endphp

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style type="text/css">
        .custom-col-start {
            float: left;
            margin-right: 0px;
            margin-left: 20px;
            margin-top: 1px;
            width: 100px;
        }

        .custom-col-logo {
            float: left;
            margin-right: 0px;
            margin-left: 20px;
            margin-top: 2px;
            width: 100px;
        }

        .custom-col {
            float: left;
            width: calc(100% - 100px);
            line-height: 1.5;
            text-align: center;
            margin-top: -10px;
            margin-left: -70px;
        }

        .custom-fw-bold {
            font-weight: 600 !important;
        }

        .custom-fs-6 {
            font-size: 13px !important;
        }

        .custom-mb-n1 {
            margin-bottom: -1rem !important;
        }

        .custom-mb-0 {
            margin-bottom: -10px !important;
        }

        .custom-fs-7 {
            font-size: 10.5px !important;
        }

        .h-100px {
            height: 100px;
            width: auto;
        }

        .custom-hr {

            border: 0;
            height: 2px;
            background-color: black;
            margin: 20px 0;
            margin-top: 115px;
        }

        .sub-title {
            text-align: center;
        }

        .section-title {
            text-align: start;
            margin-left: 30px;
            padding-top: 15px
        }

        .footer-text {
            text-align: start;
            margin-left: 30px;
        }

        .bullets {

            padding-right: 20px;
        }

        /* Table 1 */
        .custom-table {
            border-collapse: collapse;
            margin-top: -14px;
            margin-left: 56px;
            border: none;
            margin-bottom: -1rem;

        }


        .custom-table th,
        .custom-table td {
            border: 1px solid black;
            padding-top: 0px;
            padding-bottom: 0px;
            padding-right: 145px;
            padding-left: 5px;
            border: none;
            text-align: start;
            font-size: 13px !important;


        }

        .custom-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Table 2 */

        .custom-table2 {

            margin-top: -14px;
            margin-left: 56px;
            border: none;
            margin-bottom: -1rem;


        }

        .custom-table2 th,
        .custom-table2 td {
            border: 1px solid black;
            padding-top: 0px;
            padding-bottom: 0px;
            padding-right: 60px;
            padding-left: 5px;
            border: none;
            text-align: start;
            font-size: 13px !important;


        }

        .pe-0 {
            padding-right: 0px !important;
        }

        .end {
            text-align: right !important;
            white-space: nowrap;
        }

        .start {
            text-align: left !important;
        }


        .custom-table2 th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .omae {
            margin-top: 16px;
            margin-left: 61px;
        }

        .container-horizontal {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container" style="max-width: 200mm; margin-top: -25px; max-height: 297mm !important;">
        <div id="content">
            <div class="custom-row">

                <div class="custom-col-logo">
                    <img alt="Logo" src="{{ public_path('itk.png') }}" style="height: 90px;" />
                </div>

                <div class="custom-col">
                    <p class="custom-fw-bold custom-fs-6 custom-mb-n1">KEMENTRIAN PENDIDIKAN, KEBUDAYAAN,</p>
                    <p class="custom-fw-bold custom-fs-6 custom-mb-n1">RISET, DAN TEKNOLOGI</p>
                    <p class="custom-fs-6 custom-mb-n1">INSTITUT TEKNOLOGI KALIMANTAN</p>
                    <p class="custom-fs-7 custom-mb-n1">Kampus ITK Karang Joang, Balikpapan 76127</p>
                    <p class="custom-fs-7 custom-mb-n1">Telp 0542-8530801, Fax. 0542-8530800</p>
                    <p class="custom-fs-7 custom-mb-n1">Email: humas@itk.ac.id</p>
                </div>
            </div>
            <hr class="custom-hr">

            <p class="sub-title custom-fs-6 custom-mb-0 custom-fw-bold">SURAT KETERANGAN PENGHASILAN PEGAWAI</p>
            <p class="sub-title custom-fs-6 custom-fw-bold">BULAN: {{ \App\Utils::NUMBER_TO_MONTH($data['bulan'] ?? null) }}
                {{ $data['tahun'] ?? null }}</p>

            <p class="section-title custom-fs-6 custom-fw-bold"><span class="bullets">A.</span>IDENTITAS PEGAWAI</p>

            <table class="custom-table">
                <tbody>
                    <tr>
                        <td>1. Nama</td>
                        <td>: {{ $user['name'] }}</td>
                    </tr>
                    <tr>
                        <td>2. NIP/NIPPPK/NIPH</td>
                        <td>: {{ $user['nip'] }}</td>
                    </tr>
                    <tr>
                        <td>3. Pangkat/Golongan</td>
                        <td>: {{ $user['rank'] }}</td>
                    </tr>
                    <tr>
                        <td>4. Jabatan</td>
                        <td>: {{ $user['position'] }}</td>
                    </tr>
                </tbody>
            </table>

            <p class="section-title custom-fs-6 custom-fw-bold"><span class="bullets">B.</span>PENGHASILAN</p>

            <table class="custom-table2">
                <tbody>
                    <tr>
                        <td>GAJI POKOK</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['gjpokok'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN ISTRI/SUAMI</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['tjistri'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN ANAK</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['tjanak'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN UMUM</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['x'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN TAMBAHAN UMUM</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['x'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN PAPUA</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['x'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN TERPENCIL</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['tjpencil'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN STRUKTUR</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['tjstruk'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN FUNGSI</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['tjfungs'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN LAIN</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['tjlain'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN BULAT</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['x'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN BERAS</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['tjberas'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNJANGAN PAJAK</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['tjpph'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2" style="padding: 0;">
                            <hr style="border: 0.3px solid black; margin: 0; width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">PENGHASILAN KOTOR</td>
                        <td style="padding-right: 20px;"></td>
                        <td style="width: 50px;"></td>
                        <td style="font-weight: bold; text-align: left;  padding-right: 0px;">Rp</td>
                        <td style="font-weight: bold; width: 165px; text-align: right; padding-right: 0px;">
                            {{ $format($data['x'] ?? null) }}
                        </td>
                    </tr>

                </tbody>
            </table>

            <p class="section-title custom-fs-6 custom-fw-bold"><span class="bullets">C.</span>POTONGAN POTONGAN</p>

            <table class="custom-table2">
                <tbody>
                    <tr>
                        <td style="width: 200px;">POT. BERAS</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['x'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>IWP</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['x'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>POT. PPH</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['potpph'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>SEWA RUMAH</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['potswrum'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TUNGGAKAN</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['x'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>UTANG</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['x'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>POT. BPJS</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['bpjs'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>BPJS LAIN</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['bpjs2'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>TAPERUM</td>
                        <td style="padding-right: 20px !important;">Rp</td>
                        <td class="end pe-0">{{ $format($data['x'] ?? null) }}</td>
                    </tr>
                    <tr>
                        <td>JUMLAH POTONGAN</td>
                        <td style="padding-right: 20px;"></td>
                        <td style="width: 50px;"></td>
                        <td style="text-align: left;  padding-right: 0px;">Rp</td>
                        <td style="width: 120px; text-align: right; padding-right: 0px;">
                            {{ $format($data['x'] ?? null) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2" style="padding: 0;">
                            <hr style="border: 0.3px solid black; margin: 0; width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">PENGHASILAN BERSIH</td>
                        <td style="padding-right: 20px;"></td>
                        <td style="width: 50px;"></td>
                        <td style="font-weight: bold; text-align: left;  padding-right: 0px;">Rp</td>
                        <td style="font-weight: bold; width: 165px; text-align: right; padding-right: 0px;">
                            {{ $format($data['x'] ?? null) }}
                        </td>
                    </tr>

                </tbody>
            </table>

            <p class="section-title custom-fs-6 custom-fw-bold"><span class="bullets">D.</span>TUNJANGAN LAIN LAIN</p>

            <table class="custom-table2">
                <tbody>
                    <tr>
                        <td style="width: 215px;">JUMLAH TUNJANGAN LAIN</td>
                        <td style="padding-right: 20px;"></td>
                        <td style="width: 50px;"></td>
                        <td style="text-align: left;  padding-right: 0px;">Rp</td>
                        <td style="width: 120px; text-align: right; padding-right: 0px;">
                            {{ $format($data['x'] ?? null) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2" style="padding: 0;">
                            <hr style="border: 0.3px solid black; margin: 0; width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">TOTAL PENERIMAAN</td>
                        <td style="padding-right: 20px;"></td>
                        <td style="width: 50px;"></td>
                        <td style="font-weight: bold; text-align: left;  padding-right: 0px;">Rp</td>
                        <td style="font-weight: bold; width: 165px; text-align: right; padding-right: 0px;">
                            {{ $format($data['x'] ?? null) }}
                        </td>
                    </tr>

                </tbody>
            </table>

            <p class="footer-text" style="font-size: 12.5px; padding-left: 33px; padding-top: 20px">Terbilang</p>
            <p class="footer-text custom-fw-bold" style="font-size: 13px; padding-left: 33px; margin-top: -12px">{{ \App\Utils::NUMBER_TO_TEXT(21492391) }} Rupiah</p>
            <p class="footer-text" style="font-size: 12.5px;  margin-top: -2px">Demikian Surat Keterangan Penghasilan
                Pegawai ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

            <div style="font-size: 12.5px; padding-left: 12.3cm; ">
                <p class="footer-text" style="">Balikpapan, {{ date('j F Y') }}</p>
                <p class="footer-text" style="margin-top: -12px">Petugas Pengelolaan Administrasi</p>
                <p class="footer-text" style="margin-top: -12px">Belanja Pegawai (PPABP)</p>
                <p class="footer-text" style="margin-top: 29px">Dwi Harti Ningrum</p>
                <p class="footer-text" style="margin-top: -12px">NIP 199609112022032020</p>
                <div>
                </div>


            </div>
        </div>

</html>
