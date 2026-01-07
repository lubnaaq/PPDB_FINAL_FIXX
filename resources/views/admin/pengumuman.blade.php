@extends('layouts.dashboard')
@section('title', 'Pengaturan Pengumuman')
@section('content')
    <style>
        body {
            background-image:
                linear-gradient(rgba(249, 248, 248, 0.55), rgba(0, 0, 0, 0.64)),
                url('{{ asset("assets/images/user/image.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Print Styles */
        @media print {
            /* Hide non-printable elements */
            body {
                background: white !important;
                background-image: none !important;
            }

            .breadcrumb,
            .page-header,
            .btn,
            .card-header button,
            .col-md-4,
            .card:first-child,
            .card:nth-child(2),
            .feather,
            nav,
            .pc-sidebar,
            .pc-header,
            .pc-footer {
                display: none !important;
            }

            .pc-content {
                padding: 0 !important;
                margin: 0 !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
                page-break-inside: avoid;
            }

            .card-header {
                display: none !important;
            }

            .card-body {
                padding: 0 !important;
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
            }

            .print-header h3 {
                margin: 5px 0;
                font-size: 16pt;
                font-weight: bold;
            }

            .print-header p {
                margin: 2px 0;
                font-size: 11pt;
            }

            /* Document info */
            .print-info {
                display: block !important;
                margin: 20px 0 30px 0;
            }

            .print-info table {
                width: 100%;
                margin-bottom: 10px;
            }

            .print-info td {
                padding: 5px;
                font-size: 11pt;
            }

            /* Table styling for print */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                page-break-inside: auto;
            }

            table thead {
                background-color: #f0f0f0 !important;
            }

            table th,
            table td {
                border: 1px solid #333 !important;
                padding: 10px !important;
                font-size: 11pt !important;
                text-align: left;
            }

            table th {
                background-color: #e0e0e0 !important;
                font-weight: bold;
                text-align: center;
            }

            table tr {
                page-break-inside: avoid;
            }

            /* Signature section */
            .print-signature {
                display: block !important;
                margin-top: 50px;
                page-break-inside: avoid;
            }

            .print-signature p {
                margin: 5px 0;
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

            .signature-space {
                height: 80px;
                display: block;
            }

            .signature-name {
                font-weight: bold;
                text-decoration: underline;
                margin-top: 10px;
            }

            /* Print footer */
            .print-footer {
                display: block !important;
                text-align: center;
                margin-top: 30px;
                font-size: 9pt;
                color: #666;
                border-top: 1px solid #ccc;
                padding-top: 10px;
            }

            @page {
                size: A4;
                margin: 20mm;
            }
        }

        /* Hide print elements on screen */
        .print-header,
        .print-info,
        .print-signature,
        .print-footer {
            display: none;
        }
    </style>
    <div class="pc-content">
        <!-- Print Header (Only visible when printing) -->
        <div class="print-header">
            <table style="width: 100%; border: none;">
                <tr style="border: none;">
                    <td style="width: 80px; border: none; vertical-align: top;">
                         <img src="https://smkantartika1sda.sch.id/wp-content/uploads/2025/05/cropped-ANT-LG.png" alt="Logo" style="width: 80px; height: auto;">
                    </td>
                    <td style="border: none; text-align: center; padding-left: 20px;">
                        <h2 style="margin: 0; font-size: 18pt; font-weight: bold;">SMK ANTARTIKA 1 SIDOARJO</h2>
                        <h3 style="margin: 5px 0; font-size: 10pt; font-weight: bold;">PENGUMUMAN HASIL SELEKSI PENERIMAAN SISWA BARU</h3>
                        <p style="margin: 2px 0; font-size: 8pt;">Jl. Siwalan Panji, Bedrek, Siwalanpanji, Kec. Sidoarjo, Kab. Sidoarjo, Jawa Timur 61252</p>
                        <p style="margin: 2px 0; font-size: 8pt;">Telp:  (031) 8962851 | Email: info@smkantartika.sch.id | Website: www.smkantartika.sch.id</p>
                    </td>
                    <td style="width: 80px; border: none;"></td>
                </tr>
            </table>
        </div>

        <!-- Print Info (Only visible when printing) -->
        <div class="print-info">
            <h3 style="text-align: center; margin: 20px 0 30px 0; font-size: 14pt; font-weight: bold; text-decoration: underline;">
                DAFTAR SISWA YANG DINYATAKAN LULUS SELEKSI
            </h3>
            
            <table style="border: none; width: auto; margin-bottom: 20px;">
                <tr style="border: none;">
                    <td style="width: 150px; border: none; padding: 3px 0;">Tahun Ajaran</td>
                    <td style="width: 20px; border: none; padding: 3px 0;">:</td>
                    <td style="border: none; padding: 3px 0;">2026/2027</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none; padding: 3px 0;">Tanggal Cetak</td>
                    <td style="border: none; padding: 3px 0;">:</td>
                    <td style="border: none; padding: 3px 0;">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none; padding: 3px 0;">Waktu Cetak</td>
                    <td style="border: none; padding: 3px 0;">:</td>
                    <td style="border: none; padding: 3px 0;">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none; padding: 3px 0;">Total Lulus</td>
                    <td style="border: none; padding: 3px 0;">:</td>
                    <td style="border: none; padding: 3px 0;">{{ count($lulusStudents) }} Siswa</td>
                </tr>
            </table>
        </div>

        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Pengaturan Pengumuman</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Pengaturan Pengumuman Hasil Seleksi</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Settings Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Status Pengumuman</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.pengumuman.update') }}" method="POST">
                            @csrf
                            <div class="mb-4 text-center">
                                <h6 class="mb-2">Status Saat Ini:</h6>
                                @if ($announcementOpen)
                                    <span class="badge bg-success fs-5 px-4 py-2">DIBUKA</span>
                                    <p class="text-muted mt-2">Siswa <strong>DAPAT</strong> melihat hasil seleksi.</p>
                                @else
                                    <span class="badge bg-danger fs-5 px-4 py-2">DITUTUP</span>
                                    <p class="text-muted mt-2">Siswa <strong>TIDAK DAPAT</strong> melihat hasil seleksi.</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ubah Status</label>
                                <select name="announcement_open" class="form-select">
                                    <option value="0" {{ !$announcementOpen ? 'selected' : '' }}>Tutup Pengumuman</option>
                                    <option value="1" {{ $announcementOpen ? 'selected' : '' }}>Buka Pengumuman</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pengumuman</label>
                                <input type="date" name="announcement_date" class="form-control" value="{{ $announcementDate }}">
                                <small class="text-muted">Tanggal yang ditampilkan ke siswa jika pengumuman ditutup.</small>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Summary Stats -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Ringkasan Seleksi</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Pendaftar
                                <span class="badge bg-primary rounded-pill">{{ $stats['total'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Lulus
                                <span class="badge bg-success rounded-pill">{{ $stats['lulus'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Tidak Lulus
                                <span class="badge bg-danger rounded-pill">{{ $stats['tidak_lulus'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Pending
                                <span class="badge bg-warning text-dark rounded-pill">{{ $stats['pending'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- List of Accepted Students -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Daftar Siswa Lulus</h5>
                        <button class="btn btn-sm btn-secondary" onclick="window.print()">
                            <i class="feather icon-printer"></i> Cetak
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>NISN</th>
                                        <th>Asal Sekolah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lulusStudents as $key => $student)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $student->nama_lengkap }}</td>
                                            <td>{{ $student->nisn ?? '-' }}</td>
                                            <td>{{ $student->asal_sekolah ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">Belum ada siswa yang dinyatakan lulus.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->

        <!-- Print Signature Section (Only visible when printing) -->
        <div class="print-signature">
            <p style="margin: 20px 0 10px 0; text-align: justify; font-size: 10pt; line-height: 1.6;">
                Dengan ini diumumkan bahwa siswa-siswa yang terdaftar dalam daftar di atas telah dinyatakan <strong>LULUS</strong> dalam Seleksi Penerimaan Peserta Didik Baru (PPDB) SMK Negeri Unggulan Tahun Ajaran 2026/2027 dan diharuskan untuk melakukan pendaftaran ulang sesuai dengan jadwal dan prosedur yang telah ditentukan.
            </p>
            
            <table class="signature-table" style="border: none; width: 100%; margin-top: 50px;">
                <tr style="border: none;">
                    <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                        <p style="margin: 0; font-size: 10pt;">Mengetahui,</p>
                        <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 10pt;">Ketua Panitia PPDB</p>
                        <div style="height: 80px;"></div>
                        <p style="margin: 0; font-weight: bold; text-decoration: underline; font-size: 10pt;">_______________________</p>
                        <p style="margin: 5px 0 0 0; font-size: 9pt;">NIP. ___________________</p>
                    </td>
                    <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                        <p style="margin: 0; font-size: 10pt;">Bandung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 10pt;">Kepala Sekolah</p>
                        <div style="height: 80px;"></div>
                        <p style="margin: 0; font-weight: bold; text-decoration: underline; font-size: 10pt;">_______________________</p>
                        <p style="margin: 5px 0 0 0; font-size: 9pt;">NIP. ___________________</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Print Footer (Only visible when printing) -->
        <div class="print-footer">
            <p style="margin: 0; font-size: 9pt;">Dokumen ini dicetak secara otomatis dari Sistem PPDB SMK Negeri Unggulan</p>
            <p style="margin: 5px 0 0 0; font-size: 9pt;">Halaman ini merupakan dokumen resmi dan sah tanpa memerlukan tanda tangan basah</p>
        </div>
    </div>
@endsection
