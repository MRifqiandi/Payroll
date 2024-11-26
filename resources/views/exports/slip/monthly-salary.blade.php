<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SLIP GAJI</title>

    <link href="{{ asset('pdf') }}/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('pdf') }}/style.bundle.css" rel="stylesheet" type="text/css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }

        .custom-hr {
            border: 0;
            height: 4px;
            background-color: black;
            margin: 20px 0;
        }
    </style>

    <style type="text/css" media="print">
        @page {
            size: auto;
            margin: 0;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
        }
    </style>
</head>

<body>

    <div class="container py-12 p-5 " style="width: 210mm !important;">
        <div id="content">
            <div class="row d-flex align-items-center w-100">
                <div class="col-1 text-start">
                    <img alt="Logo" src="{{ asset('itk.png') }}" class="h-100px" />
                </div>
                <div class="col-10  text-center">
                    <p class="fw-bold fs-6 mb-n1">KEMENTRIAN PENDIDIKAN, KEBUDAYAAN,</p>
                    <p class="fw-bold fs-6 mb-n1">RISET, DAN TEKNOLOGI</p>
                    <p class=" fs-6 mb-n1">INSTITUT TEKNOLOGI KALIMANTAN</p>
                    <p class="fs-7 mb-n1">Kampus ITK Karang Joang, Balikpapan 76127</p>
                    <p class="fs-7 mb-n1">Telp 0542-8530801,Fax. 0542-8530800</p>
                    <p class="fs-7 mb-n1">email : humas@itk.ac.id</p>

                </div>

            </div>

            <hr class="border-dark border-5 opacity-100">


            <div class="row align-items-center">
                <p class="text-center fs-6 fw-bold mb-n1">SURAT KETERANGAN PENGHASILAN PEGAWAI</p>
                <p class="text-center fs-6 fw-bold">BULAN: NOVEMBER 2024</p>
            </div>

            <div class="row align-items-start pt-2 ms-1">
                <p class="text-start fs-6 fw-bold mb-n1"><span class="me-4">A.</span>IDENTITAS PEGAWAI</p>
            </div>
            <div class="row align-items-start ms-1">
                <div class="col-6 d-flex justify-content-between">
                    <div class="flex-column">
                        <p class="text-start fs-6 mb-n1 ms-4 ps-3">1. Nama</p>
                        <p class="text-start fs-6 mb-n1 ms-4 ps-3">2. NIP/NIPPPK/NIPH</p>
                        <p class="text-start fs-6 mb-n1 ms-4 ps-3">3. Pangkat/Golongan</p>
                        <p class="text-start fs-6 mb-n1 ms-4 ps-3">4. Jabatan</p>
                    </div>
                    <div class="flex-column text-end">
                        <p class="text-end fs-6 mb-n1"><span class="me-1">:</span>Kucing Ayam</p>
                        <p class="text-end fs-6 mb-n1"><span class="me-1">:</span>xxxdawdada</p>
                        <p class="text-end fs-6 mb-n1"><span class="me-1">:</span>xxdadadx</p>
                        <p class="text-end fs-6 mb-n1"><span class="me-1">:</span>xx3434we4tsfgsfgx</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-start pt-4 ms-1">
                <p class="text-start fs-6 fw-bold mb-n1"><span class="me-4">B.</span>PENGHASILAN</p>
            </div>
            <div class="row align-items-start ms-1">
                <div class="col-12">
                    <div class="row">
                        <!-- Kolom Nama Penghasilan -->
                        <div class="col-5">
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">GAJI POKOK</p>
                            {{-- <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN ISTRI/SUAMI</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN ANAK</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN UMUM</p> --}}
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN TAMBAHAN UMUM</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN PAPUA</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN TERPENCIL</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN STRUKTUR</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN FUNGSI</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN LAIN</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN BULAT</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN BERAS</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNJANGAN PAJAK</p>
                        </div>
                        <!-- Kolom Satuan Rp -->
                        <div class="col-1 text-center ms-n2">
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            {{-- <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p> --}}
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                        </div>
                        <!-- Kolom Nominal -->
                        <div class="col-2 text-end">
                            <p class="text-end fs-6 mb-n1">3.571.000</p>
                            <p class="text-end fs-6 mb-n1">357.100</p>
                            <p class="text-end fs-6 mb-n1">71.420</p>
                            {{-- <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">-</p> --}}
                            <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">325t524r</p>
                            <p class="text-end fs-6 mb-n1">fsavx</p>
                            <p class="text-end fs-6 mb-n1">90</p>
                            <p class="text-end fs-6 mb-n1">217.260</p>
                            <p class="text-end fs-6 mb-n1">-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-start ms-1">
                <div class="col-12">
                    <div class="row">
                        <!-- Kolom Nama Penghasilan -->
                        <div class="col-8">
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3 fw-bold">PENGHASILAN KOTOR</p>
                        </div>
                        <!-- Kolom Rp dan Nominal -->
                        <div class="col-4">
                            <hr class="border-dark border-2 opacity-100 mt-n1">
                            <!-- Gunakan Flexbox untuk Rp dan Nominal -->
                            <div class="d-flex justify-content-between mt-n2 px-1">
                                <p class="fs-6 mb-n1 fw-bold mt-n2">Rp</p>
                                <p class="fs-6 mb-n1 fw-bold mt-n2">4.216.870.wqeqw</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-start pt-4 ms-1">
                <p class="text-start fs-6 fw-bold mb-n1"><span class="me-4">C.</span>POTONGAN POTONGAN</p>
            </div>
            <div class="row align-items-start ms-1">
                <div class="col-12">
                    <div class="row">
                        <!-- Kolom Nama Penghasilan -->
                        <div class="col-5">
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">POT. BERAS</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">IWP</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">POT. PPH</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">SEWA RUMAH</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TUNGGAKAN</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">UTANG</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">POT. BPJS </p>
                            {{-- <p class="text-start fs-6 mb-n1 ms-4 ps-3">BPJS LAIN</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3">TAPERUM</p> --}}
                        </div>
                        <!-- Kolom Satuan Rp -->
                        <div class="col-1 text-center ms-n2">
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p>
                            {{-- <p class="text-end fs-6 mb-n1">Rp</p>
                            <p class="text-end fs-6 mb-n1">Rp</p> --}}
                        </div>
                        <!-- Kolom Nominal -->
                        <div class="col-2 text-end">
                            <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">319.961</p>
                            <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">73.209</p>
                            {{-- <p class="text-end fs-6 mb-n1">-</p>
                            <p class="text-end fs-6 mb-n1">-</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-start ms-1">
                <div class="col-12">
                    <div class="row">
                        <!-- Kolom Nama Penghasilan -->
                        <div class="col-8">
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3 fw-bold">JUMLAH POTONGAN</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3 fw-bold">PENGHASILAN BERSIH</p>
                        </div>
                        <!-- Kolom Rp dan Nominal -->
                        <div class="col-4">
                            <div class="d-flex justify-content-between mb-2 px-1">
                                <p class="fs-6 mb-n1 mt-n2">Rp</p>
                                <p class="fs-6 mb-n1 mt-n2">393.170</p>
                            </div>
                            <hr class="border-dark border-2 opacity-100 mt-n1">
                            <!-- Gunakan Flexbox untuk Rp dan Nominal -->
                            <div class="d-flex justify-content-between mt-n2 px-1">
                                <p class="fs-6 mb-n1 fw-bold mt-n2">Rp</p>
                                <p class="fs-6 mb-n1 fw-bold mt-n2">3.823.700</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-start pt-4 ms-1">
                <p class="text-start fs-6 fw-bold mb-n1"><span class="me-4">D.</span>TUNJANGAN LAIN LAIN</p>
            </div>

            <div class="row align-items-start ms-1">
                <div class="col-12 pt-3">
                    <div class="row">
                        <!-- Kolom Nama Penghasilan -->
                        <div class="col-8">
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3 fw-bold">JUMLAH TUNJANGAN LAIN</p>
                            <p class="text-start fs-6 mb-n1 ms-4 ps-3 fw-bold">TOTAL PENERIMAAN</p>
                        </div>
                        <!-- Kolom Rp dan Nominal -->
                        <div class="col-4">
                            <div class="d-flex justify-content-between mb-2 px-1">
                                <p class="fs-6 mb-n1 mt-n2">Rp</p>
                                <p class="fs-6 mb-n1 mt-n2">-</p>
                            </div>
                            <hr class="border-dark border-2 opacity-100 mt-n1">
                            <!-- Gunakan Flexbox untuk Rp dan Nominal -->
                            <div class="d-flex justify-content-between mt-n2 px-1">
                                <p class="fs-6 mb-n1 fw-bold mt-n2">Rp</p>
                                <p class="fs-6 mb-n1 fw-bold mt-n2">3.823.700</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-start ms-1">
                <div class="col-12 pt-3">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-start fs-7 mb-n1 ms-4 ps-3">Terbilang</p>
                            <p class="text-start fw-bold fs-6 mb-n1 ms-4 ps-3"> Tiga Juta Delapan Ratus Dua Puluh Tiga
                                Ribu Tujuh Ratus Rupiah</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center pt-3">
                <p class="text-start fs-6 mb-n1">Demikian Surat Keterangan Penghasilan Pegawai ini dibuat untuk
                    dipergunakan sebagaimana mestinya.</p>
            </div>
            <div class="row justify-content-end pt-4 pe-15">
                <div class="col-auto text-start">
                    <p class="fs-6 mb-0">Balikpapan, 4 November 2024</p>
                    <p class="fs-6 mb-0">Petugas Pengelolaan Administrasi</p>
                    <p class="fs-6 mb-0">Belanja Pegawai (PPABP)</p>
                    <p class="fs-6 mb-0 pt-5">Dwi Harti Ningrum</p>
                    <p class="fs-6 mb-0">NIP 199609112022032020</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
