
@extends('layouts.dashboard')
@section('title', 'Hasil Pengumuman')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Hasil Pengumuman</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Hasil Pengumuman Seleksi</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        <h5>Status Kelulusan</h5>
                    </div>
                    <div class="card-body">
                        <div class="screen-only">
                            {{-- 
                                Status Kelulusan diambil dari Controller
                                Values: 'LULUS', 'TIDAK LULUS', 'PENDING', 'BELUM_DIBUKA'
                            --}}

                            @if ($status_kelulusan == 'LULUS')
                                <div class="mb-4">
                                    <i class="feather icon-check-circle text-success" style="font-size: 80px;"></i>
                                </div>
                                <h3 class="text-success mb-3">SELAMAT! ANDA DINYATAKAN LULUS</h3>
                                <p class="lead">
                                    Selamat <strong>{{ Auth::user()->name }}</strong>, Anda telah dinyatakan <strong>LULUS</strong> seleksi penerimaan siswa baru di SMK Kami.
                                </p>
                                <div class="alert alert-success mt-4" role="alert">
                                    <h5 class="alert-heading">Langkah Selanjutnya</h5>
                                    <p>Silakan melakukan <strong>Daftar Ulang</strong> pada menu yang tersedia atau klik tombol di bawah ini.</p>
                                </div>
                                <div class="d-flex justify-content-center gap-2 mt-3 no-print">
                                    <button onclick="window.print()" class="btn btn-outline-success btn-lg">
                                        <i class="feather icon-printer me-2"></i> Cetak Bukti Lulus
                                    </button>
                                    <a href="{{ route('user.daftar_ulang') }}" class="btn btn-primary btn-lg">
                                        <i class="feather icon-file-text me-2"></i> Lanjut ke Daftar Ulang
                                    </a>
                                </div>

                            @elseif ($status_kelulusan == 'TIDAK LULUS')
                                <div class="mb-4">
                                    <i class="feather icon-x-circle text-danger" style="font-size: 80px;"></i>
                                </div>
                                <h3 class="text-danger mb-3">MOHON MAAF</h3>
                                <p class="lead">
                                    Mohon maaf <strong>{{ Auth::user()->name }}</strong>, Anda dinyatakan <strong>TIDAK LULUS</strong> dalam seleksi penerimaan siswa baru tahun ini.
                                </p>
                                <p class="text-muted">
                                    Jangan patah semangat, tetap terus belajar dan mencoba di kesempatan lainnya.
                                </p>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">
                                    <i class="feather icon-home me-2"></i> Kembali ke Dashboard
                                </a>

                            @elseif ($status_kelulusan == 'PENDING')
                                 <div class="mb-4">
                                    <i class="feather icon-clock text-info" style="font-size: 80px;"></i>
                                </div>
                                <h3 class="text-info mb-3">HASIL BELUM TERSEDIA</h3>
                                <p class="lead">
                                    Hasil seleksi Anda sedang dalam proses penentuan akhir.
                                </p>
                                <p class="text-muted">
                                    Silakan cek kembali halaman ini secara berkala.
                                </p>
                                <a href="/dashboard" class="btn btn-secondary mt-3">
                                    <i class="feather icon-arrow-left me-2"></i> Kembali
                                </a>

                            @else
                                {{-- BELUM_DIBUKA --}}
                                <div class="mb-4">
                                    <i class="feather icon-lock text-warning" style="font-size: 80px;"></i>
                                </div>
                                <h3 class="text-warning mb-3">PENGUMUMAN BELUM DIBUKA</h3>
                                <p class="lead">
                                    Hasil seleksi penerimaan siswa baru belum diumumkan secara resmi.
                                </p>
                                <p class="text-muted">
                                    Silakan cek kembali halaman ini sesuai dengan jadwal pengumuman yang telah ditentukan.
                                </p>
                                @if(isset($announcementDate))
                                <div class="alert alert-info mt-4" role="alert">
                                    <strong>Jadwal Pengumuman:</strong> {{ \Carbon\Carbon::parse($announcementDate)->translatedFormat('d F Y') }}
                                </div>
                                @endif
                                <a href="/dashboard" class="btn btn-secondary mt-3">
                                    <i class="feather icon-arrow-left me-2"></i> Kembali
                                </a>
                            @endif
                        </div>

                        <!-- Print Format -->
                        <div class="print-container" style="display: none;">
                            <!-- Print Header -->
                            <div class="print-header">
                                <table style="width: 100%; border: none;">
                                    <tr style="border: none;">
                                        <td style="width: 80px; border: none; vertical-align: top;">
                                            <img src="https://smkantartika1sda.sch.id/wp-content/uploads/2025/05/cropped-ANT-LG.png" alt="Logo" style="width: 80px; height: auto;">
                                        </td>
                                        <td style="border: none; text-align: center; padding-left: 20px;">
                                            <h2 style="margin: 0; font-size: 18pt; font-weight: bold;">SMK ANTARTIKA 1 SIDOARJO</h2>
                                            <h3 style="margin: 5px 0; font-size: 10pt; font-weight: bold;">SURAT KETERANGAN LULUS SELEKSI PENERIMAAN SISWA BARU</h3>
                                            <p style="margin: 2px 0; font-size: 8pt;">Jl. Siwalan Panji, Bedrek, Siwalanpanji, Kec. Sidoarjo, Kab. Sidoarjo, Jawa Timur 61252</p>
                                            <p style="margin: 2px 0; font-size: 8pt;">Telp:  (031) 8962851 | Email: info@smkantartika1.sch.id | Website: www.smkantartika1.sch.id</p>
                                        </td>
                                        <td style="width: 80px; border: none;"></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Print Info -->
                            <div class="print-info">
                                <h3 style="text-align: center; margin: 20px 0 30px 0; font-size: 16pt; font-weight: bold; text-decoration: underline;">
                                    SURAT KETERANGAN LULUS SELEKSI
                                </h3>

                                <table style="border: none; width: auto; margin: 0 auto 20px auto;">
                                    <tr style="border: none;">
                                        <td style="width: 150px; border: none; padding: 3px 0;">Nomor Surat</td>
                                        <td style="width: 20px; border: none; padding: 3px 0;">:</td>
                                        <td style="border: none; padding: 3px 0;">421.5/{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}/PPDB/{{ date('Y') }}</td>
                                    </tr>
                                    <tr style="border: none;">
                                        <td style="width: 150px; border: none; padding: 3px 0;">Tahun Ajaran</td>
                                        <td style="width: 20px; border: none; padding: 3px 0;">:</td>
                                        <td style="border: none; padding: 3px 0;">{{ date('Y') }}/{{ date('Y')+1 }}</td>
                                    </tr>
                                    <tr style="border: none;">
                                        <td style="border: none; padding: 3px 0;">Tanggal Cetak</td>
                                        <td style="border: none; padding: 3px 0;">:</td>
                                        <td style="border: none; padding: 3px 0;">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                                    </tr>
                                </table>

                                <p style="margin: 20px 0 10px 0; text-align: justify; font-size: 11pt; line-height: 1.6;">
                                    Berdasarkan hasil seleksi Penerimaan Peserta Didik Baru (PPDB) SMK Antartika 1 Sidoarjo Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}, dengan ini Kepala Sekolah menerangkan bahwa:
                                </p>
                                
                                <table style="border: none; width: 100%; margin: 20px 0 20px 20px;">
                                    <tr style="border: none;">
                                        <td style="width: 200px; border: none; padding: 5px 0;">Nama Lengkap</td>
                                        <td style="width: 20px; border: none; padding: 5px 0;">:</td>
                                        <td style="border: none; padding: 5px 0; font-weight: bold;">{{ strtoupper(Auth::user()->name) }}</td>
                                    </tr>
                                    <tr style="border: none;">
                                        <td style="border: none; padding: 5px 0;">Nomor Pendaftaran</td>
                                        <td style="border: none; padding: 5px 0;">:</td>
                                        <td style="border: none; padding: 5px 0;">{{ str_pad(Auth::user()->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    </tr>
                                    <tr style="border: none;">
                                        <td style="border: none; padding: 5px 0;">Asal Sekolah</td>
                                        <td style="border: none; padding: 5px 0;">:</td>
                                        <td style="border: none; padding: 5px 0;">{{ Auth::user()->biodata->asal_sekolah ?? '-' }}</td>
                                    </tr>
                                    <tr style="border: none;">
                                        <td style="border: none; padding: 5px 0;">Kompetensi Keahlian</td>
                                        <td style="border: none; padding: 5px 0;">:</td>
                                        <td style="border: none; padding: 5px 0;"><strong>{{ Auth::user()->biodata->jurusan->nama_jurusan ?? '-' }}</strong></td>
                                    </tr>
                                </table>

                                <p style="margin: 20px 0 10px 0; text-align: justify; font-size: 11pt; line-height: 1.6;">
                                    Berdasarkan hasil rapat Pleno Panitia PPDB pada tanggal {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}, peserta didik dengan data tersebut di atas dinyatakan:
                                </p>

                                <div style="text-align: center; margin: 30px 0;">
                                    <span style="border: 3px double #000; padding: 10px 40px; font-size: 24pt; font-weight: bold; letter-spacing: 5px;">
                                        @if($status_kelulusan == 'LULUS')
                                            LULUS
                                        @elseif($status_kelulusan == 'TIDAK LULUS')
                                            TIDAK LULUS
                                        @else
                                            MENUNGGU
                                        @endif
                                    </span>
                                </div>

                                <p style="margin: 20px 0 10px 0; text-align: justify; font-size: 11pt; line-height: 1.6;">
                                    Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya. Bagi peserta didik yang dinyatakan lulus dimohon untuk segera melakukan daftar ulang sesuai jadwal yang telah ditentukan.
                                </p>
                            </div>

                            <!-- Print Signature -->
                            <div class="print-signature">
                                <table class="signature-table" style="border: none; width: 100%; margin-top: 50px;">
                                    <tr style="border: none;">
                                        <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                                            <!-- Spacer -->
                                        </td>
                                        <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                                            <p style="margin: 0; font-size: 11pt;">Sidoarjo, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                                            <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 11pt;">Kepala Sekolah</p>
                                            
                                            <div style="height: 80px; position: relative; display: flex; justify-content: center; align-items: flex-end;">
                                                <img src="{{ asset('assets/images/user/WhatsApp_Image_2026-01-05_at_20.02.09-removebg-preview.png') }}"
                                                alt="TTD" style="max-height: 80px; opacity: 0.9; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);">
                                            </div>

                                            @php
                                                $setting = \App\Models\Setting::first();
                                            @endphp
                                            <p style="margin: 0; font-weight: bold; text-decoration: underline; font-size: 11pt;">{{ $setting->kepala_sekolah ?? 'AKHMAD NASIRUDIN' }}</p>
                                            <p style="margin: 5px 0 0 0; font-size: 11pt;">NIP. {{ $setting->nip_kepala_sekolah ?? '-' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Print Footer -->
                            <div class="print-footer">
                                <p style="margin: 0; font-size: 8pt;">Dokumen ini dicetak secara otomatis dari Sistem PPDB SMK Antartika 1 Sidoarjo</p>
                                <p style="margin: 2px 0 0 0; font-size: 8pt;">Halaman ini merupakan dokumen resmi dan sah. Validasi dokumen dapat dilakukan dengan menghubungi panitia PPDB.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                        <span>Panitia PPDB SMK Tahun 2026</span>
                        <button class="btn btn-outline-primary print-button" onclick="window.print()">
                            <i class="feather icon-printer me-2"></i> Cetak
                        </button>
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
@endsection
