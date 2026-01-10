@extends('layouts.dashboard')
@section('title', 'Daftar Ulang')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Daftar Ulang</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Daftar Ulang</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Informasi Daftar Ulang</h5>
                    </div>
                    <div class="card-body">
                        <div class="print-container">
                            <!-- Print Header (Only visible when printing) -->
                            <div class="print-header">
                                <table style="width: 100%; border: none;">
                                    <tr style="border: none;">
                                        <td style="width: 80px; border: none; vertical-align: top;">
                                            <img src="https://smkantartika1sda.sch.id/wp-content/uploads/2025/05/cropped-ANT-LG.png"
                                                alt="Logo" style="width: 80px; height: auto;">
                                        </td>
                                        <td style="border: none; text-align: center; padding-left: 20px;">
                                            <h2 style="margin: 0; font-size: 18pt; font-weight: bold;">SMK ANTARTIKA 1
                                                SIDOARJO</h2>
                                            <h3 style="margin: 5px 0; font-size: 10pt; font-weight: bold;">SURAT
                                                PEMBERITAHUAN DAFTAR ULANG</h3>
                                            <p style="margin: 2px 0; font-size: 8pt;">Jl. Siwalan Panji, Bedrek,
                                                Siwalanpanji, Kec. Sidoarjo, Kab. Sidoarjo, Jawa Timur 61252</p>
                                            <p style="margin: 2px 0; font-size: 8pt;">Telp: (031) 8962851 | Email:
                                                info@smkantartika1.sch.id | Website: www.smkantartika1.sch.id</p>
                                        </td>
                                        <td style="width: 80px; border: none;"></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Print Info (Only visible when printing) -->
                            <div class="print-info">
                                <h3
                                    style="text-align: center; margin: 20px 0 30px 0; font-size: 16pt; font-weight: bold; text-decoration: underline;">
                                    PEMBERITAHUAN DAFTAR ULANG
                                </h3>

                                <!-- Metadata Table -->
                                <table style="border: none; width: auto; margin: 0 auto 20px auto;">
                                    <tr style="border: none;">
                                        <td style="width: 150px; border: none; padding: 3px 0;">Nomor Surat</td>
                                        <td style="width: 20px; border: none; padding: 3px 0;">:</td>
                                        <td style="border: none; padding: 3px 0;">
                                            421.5/DU/{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}/{{ date('Y') }}
                                        </td>
                                    </tr>
                                    <tr style="border: none;">
                                        <td style="width: 150px; border: none; padding: 3px 0;">Tahun Ajaran</td>
                                        <td style="width: 20px; border: none; padding: 3px 0;">:</td>
                                        <td style="border: none; padding: 3px 0;">{{ date('Y') }}/{{ date('Y') + 1 }}
                                        </td>
                                    </tr>
                                </table>

                                <p style="margin: 20px 0 10px 0; text-align: justify; font-size: 11pt; line-height: 1.6;">
                                    Berdasarkan hasil seleksi Penerimaan Peserta Didik Baru (PPDB), kami sampaikan kepada
                                    calon peserta didik berikut:
                                </p>

                                <table style="border: none; width: 100%; margin: 10px 0 20px 20px;">
                                    <tr style="border: none;">
                                        <td style="width: 200px; border: none; padding: 5px 0;">Nama Lengkap</td>
                                        <td style="width: 20px; border: none; padding: 5px 0;">:</td>
                                        <td style="border: none; padding: 5px 0; font-weight: bold;">
                                            {{ strtoupper(Auth::user()->name) }}</td>
                                    </tr>
                                    <tr style="border: none;">
                                        <td style="border: none; padding: 5px 0;">Nomor Pendaftaran</td>
                                        <td style="border: none; padding: 5px 0;">:</td>
                                        <td style="border: none; padding: 5px 0;">
                                            {{ str_pad(Auth::user()->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    </tr>
                                    <tr style="border: none;">
                                        <td style="border: none; padding: 5px 0;">Kompetensi Keahlian</td>
                                        <td style="border: none; padding: 5px 0;">:</td>
                                        <td style="border: none; padding: 5px 0;">
                                            <strong>{{ Auth::user()->biodata->jurusan->nama_jurusan ?? '-' }}</strong></td>
                                    </tr>
                                </table>

                                <p style="margin: 20px 0 10px 0; text-align: justify; font-size: 11pt; line-height: 1.6;">
                                    Diwajibkan untuk melakukan <strong>DAFTAR ULANG</strong> dengan rincian jadwal sebagai
                                    berikut:
                                </p>

                                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                                    <thead style="background-color: #f0f0f0;">
                                        <tr>
                                            <th style="border: 1px solid #333; padding: 8px; text-align: center;">Kegiatan
                                            </th>
                                            <th style="border: 1px solid #333; padding: 8px; text-align: center;">Tanggal
                                            </th>
                                            <th style="border: 1px solid #333; padding: 8px; text-align: center;">Waktu</th>
                                            <th style="border: 1px solid #333; padding: 8px; text-align: center;">Tempat
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($userGelombang))
                                            @if (stripos($userGelombang->nama, '1') !== false)
                                                <tr>
                                                    <td style="border: 1px solid #333; padding: 8px;">Daftar Ulang Gelombang
                                                        1</td>
                                                    <td style="border: 1px solid #333; padding: 8px; text-align: center;">10
                                                        - 12 Juli {{ date('Y') }}</td>
                                                    <td style="border: 1px solid #333; padding: 8px; text-align: center;">
                                                        08.00 - 14.00 WIB</td>
                                                    <td style="border: 1px solid #333; padding: 8px; text-align: center;">
                                                        Ruang Tata Usaha</td>
                                                </tr>
                                            @elseif(stripos($userGelombang->nama, '2') !== false)
                                                <tr>
                                                    <td style="border: 1px solid #333; padding: 8px;">Daftar Ulang Gelombang
                                                        2</td>
                                                    <td style="border: 1px solid #333; padding: 8px; text-align: center;">15
                                                        - 17 Juli {{ date('Y') }}</td>
                                                    <td style="border: 1px solid #333; padding: 8px; text-align: center;">
                                                        08.00 - 14.00 WIB</td>
                                                    <td style="border: 1px solid #333; padding: 8px; text-align: center;">
                                                        Ruang Tata Usaha</td>
                                                </tr>
                                            @else
                                                {{-- Fallback default --}}
                                                <tr>
                                                    <td style="border: 1px solid #333; padding: 8px;">Daftar Ulang Gelombang
                                                        1</td>
                                                    <td style="border: 1px solid #333; padding: 8px; text-align: center;">10
                                                        - 12 Juli {{ date('Y') }}</td>
                                                    <td style="border: 1px solid #333; padding: 8px; text-align: center;">
                                                        08.00 - 14.00 WIB</td>
                                                    <td style="border: 1px solid #333; padding: 8px; text-align: center;">
                                                        Ruang Tata Usaha</td>
                                                </tr>
                                            @endif
                                        @else
                                            {{-- Show all if undecided --}}
                                            <tr>
                                                <td style="border: 1px solid #333; padding: 8px;">Daftar Ulang Gelombang 1
                                                </td>
                                                <td style="border: 1px solid #333; padding: 8px; text-align: center;">10 -
                                                    12 Juli {{ date('Y') }}</td>
                                                <td style="border: 1px solid #333; padding: 8px; text-align: center;">08.00
                                                    - 14.00 WIB</td>
                                                <td style="border: 1px solid #333; padding: 8px; text-align: center;">Ruang
                                                    Tata Usaha</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #333; padding: 8px;">Daftar Ulang Gelombang 2
                                                </td>
                                                <td style="border: 1px solid #333; padding: 8px; text-align: center;">15 -
                                                    17 Juli {{ date('Y') }}</td>
                                                <td style="border: 1px solid #333; padding: 8px; text-align: center;">08.00
                                                    - 14.00 WIB</td>
                                                <td style="border: 1px solid #333; padding: 8px; text-align: center;">Ruang
                                                    Tata Usaha</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <p style="margin: 15px 0 5px 0; font-weight: bold; font-size: 11pt;">Berkas yang wajib
                                    dibawa:</p>
                                <ul style="margin: 0; padding-left: 20px;">
                                    <li>Bukti Tanda Terima Pendaftaran (Cetak dari Website)</li>
                                    <li>Ijazah / Surat Keterangan Lulus (Asli & Fotokopi Legalisir)</li>
                                    <li>Kartu Keluarga (Asli & Fotokopi)</li>
                                    <li>Akta Kelahiran (Asli & Fotokopi)</li>
                                    <li>Pas Foto Berwarna 3x4 (4 Lembar)</li>
                                    <li>Surat Pernyataan Siswa & Orang Tua (Materai 10.000)</li>
                                </ul>
                            </div>

                            <!-- Print Signature Section (Only visible when printing) -->
                            <div class="print-signature">
                                <table class="signature-table" style="border: none; width: 100%; margin-top: 50px;">
                                    <tr style="border: none;">
                                        <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                                            <!-- Spacer for left side if needed -->
                                        </td>
                                        <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                                            <p style="margin: 0; font-size: 11pt;">Sidoarjo,
                                                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                                            <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 11pt;">Kepala Sekolah
                                            </p>

                                            <!-- Signature Space / Image -->
                                            <div
                                                style="height: 80px; position: relative; display: flex; justify-content: center; align-items: flex-end;">
                                                <img src="{{ asset('assets/images/user/WhatsApp_Image_2026-01-05_at_20.02.09-removebg-preview.png') }}"
                                                    alt="TTD"
                                                    style="max-height: 80px; opacity: 0.9; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);">
                                            </div>

                                            @php
                                                $setting = \App\Models\Setting::first();
                                            @endphp
                                            <p
                                                style="margin: 0; font-weight: bold; text-decoration: underline; font-size: 11pt;">
                                                {{ $setting->kepala_sekolah ?? 'AKHMAD NASIRUDIN' }}</p>
                                            <p style="margin: 5px 0 0 0; font-size: 11pt;">NIP.
                                                {{ $setting->nip_kepala_sekolah ?? '-' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Print Footer (Only visible when printing) -->
                            <div class="print-footer">
                                <p style="margin: 0; font-size: 8pt;">Dokumen ini dicetak secara otomatis dari Sistem PPDB
                                    SMK Antartika 1 Sidoarjo</p>
                                <p style="margin: 2px 0 0 0; font-size: 8pt;">Harap membawa dokumen ini saat melakukan
                                    daftar ulang.</p>
                            </div>
                        </div>

                        <div class="screen-only">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">Perhatian!</h4>
                                <p>Halaman ini memuat informasi mengenai prosedur daftar ulang bagi calon siswa yang telah
                                    dinyatakan <strong>LULUS</strong> seleksi PPDB.</p>
                                <hr>
                                <p class="mb-0">Pastikan Anda memantau status kelulusan Anda di menu
                                    <strong>Pengumuman</strong> atau <strong>Status</strong> sebelum melakukan daftar ulang.
                                </p>
                            </div>

                            <h5 class="mt-4">Jadwal Daftar Ulang</h5>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kegiatan</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Tempat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($userGelombang))
                                        @if (stripos($userGelombang->nama, '1') !== false)
                                            <tr>
                                                <td>Daftar Ulang Gelombang 1</td>
                                                <td>10 - 12 Juli {{ date('Y') }}</td>
                                                <td>08.00 - 14.00 WIB</td>
                                                <td>Ruang Tata Usaha SMK</td>
                                            </tr>
                                        @elseif(stripos($userGelombang->nama, '2') !== false)
                                            <tr>
                                                <td>Daftar Ulang Gelombang 2</td>
                                                <td>15 - 17 Juli {{ date('Y') }}</td>
                                                <td>08.00 - 14.00 WIB</td>
                                                <td>Ruang Tata Usaha SMK</td>
                                            </tr>
                                        @else
                                            {{-- Fallback --}}
                                            <tr>
                                                <td>Daftar Ulang Gelombang 1</td>
                                                <td>10 - 12 Juli {{ date('Y') }}</td>
                                                <td>08.00 - 14.00 WIB</td>
                                                <td>Ruang Tata Usaha SMK</td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr>
                                            <td>Daftar Ulang Gelombang 1</td>
                                            <td>10 - 12 Juli {{ date('Y') }}</td>
                                            <td>08.00 - 14.00 WIB</td>
                                            <td>Ruang Tata Usaha SMK</td>
                                        </tr>
                                        <tr>
                                            <td>Daftar Ulang Gelombang 2</td>
                                            <td>15 - 17 Juli {{ date('Y') }}</td>
                                            <td>08.00 - 14.00 WIB</td>
                                            <td>Ruang Tata Usaha SMK</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <h5 class="mt-4">Berkas yang Harus Dibawa</h5>
                            <p>Calon siswa wajib datang ke sekolah dengan membawa berkas-berkas asli dan fotokopi sebagai
                                berikut:</p>
                            <ul class="list-group mb-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    1. Bukti Tanda Terima Pendaftaran (Cetak dari Website)
                                    <span class="badge bg-primary rounded-pill">1 Lembar</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    2. Ijazah / Surat Keterangan Lulus (Asli & Fotokopi Legalisir)
                                    <span class="badge bg-primary rounded-pill">2 Lembar</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    3. Kartu Keluarga (Asli & Fotokopi)
                                    <span class="badge bg-primary rounded-pill">2 Lembar</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    4. Akta Kelahiran (Asli & Fotokopi)
                                    <span class="badge bg-primary rounded-pill">2 Lembar</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    5. Pas Foto Berwarna 3x4 (Background Merah/Biru)
                                    <span class="badge bg-primary rounded-pill">4 Lembar</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    6. Surat Pernyataan Siswa & Orang Tua (Materai 10.000)
                                    <span class="badge bg-primary rounded-pill">1 Lembar</span>
                                </li>
                            </ul>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button" onclick="window.print()">
                                    <i class="feather icon-printer me-2"></i> Cetak Informasi Ini
                            </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <style>
        /* Default: Hide print container on screen */
        .print-container {
            display: none;
        }

        /* Print Styles matching admin/pengumuman.blade.php */
        @media print {

            /* Hide non-printable elements */
            body {
                background: white !important;
                background-image: none !important;
                padding: 0 !important;
                margin: 0 !important;
                color: #000 !important;
            }

            .breadcrumb,
            .page-header,
            .btn,
            .card-header,
            .screen-only,
            .pc-sidebar,
            .pc-header,
            .pc-footer,
            .card-footer,
            nav {
                display: none !important;
            }

            .pc-content {
                padding: 0 !important;
                margin: 0 !important;
            }

            /* Make sure the print container is visible */
            .print-container {
                display: block !important;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 9999;
                background: white;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .card-body {
                padding: 0 !important;
                margin: 0 !important;
            }

            /* Show print header */
            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 3px solid #000;
            }

            .print-header h2 {
                margin: 5px 0;
                font-size: 18pt;
                font-weight: bold;
                text-transform: uppercase;
                color: #000;
            }

            .print-header h3 {
                margin: 5px 0;
                font-size: 16pt;
                font-weight: bold;
                color: #000;
            }

            .print-header p {
                margin: 2px 0;
                font-size: 11pt;
                color: #000;
            }

            /* Document info */
            .print-info {
                display: block !important;
                margin: 20px 0 30px 0;
                color: #000;
            }

            .print-info table {
                width: 100%;
                margin-bottom: 10px;
            }

            .print-info td {
                padding: 5px;
                font-size: 11pt;
            }

            /* Signature section */
            .print-signature {
                display: block !important;
                margin-top: 50px;
                page-break-inside: avoid;
            }

            .print-signature p {
                margin: 5px 0;
                color: #000;
            }

            .signature-table {
                width: 100%;
                border: none;
                margin-top: 40px;
            }

            .signature-table td {
                border: none !important;
                padding: 0 !important;
                text-align: center;
                vertical-align: top;
                padding-top: 0 !important;
            }

            /* Print footer */
            .print-footer {
                display: block !important;
                text-align: center;
                margin-top: 50px;
                font-size: 9pt;
                color: #666;
                border-top: 1px solid #ccc;
                padding-top: 10px;
                position: fixed;
                bottom: 20px;
                left: 0;
                right: 0;
            }

            @page {
                size: A4;
                margin: 20mm;
            }
        }
    </style>
@endsection
