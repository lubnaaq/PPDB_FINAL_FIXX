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
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
                            <a href="{{ route('user.daftar_ulang') }}" class="btn btn-primary btn-lg mt-3">
                                <i class="feather icon-file-text me-2"></i> Lanjut ke Daftar Ulang
                            </a>

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
                            <a href="/dashboard" class="btn btn-secondary mt-3">
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
        @media print {
            /* Sembunyikan elemen yang tidak perlu dicetak */
            .breadcrumb,
            .print-button,
            .btn-secondary,
            .btn-primary:not(.print-content),
            a[href*="daftar_ulang"],
            a[href*="dashboard"] {
                display: none !important;
            }

            /* Styling untuk halaman cetak */
            body {
                background: white;
                color: #333;
            }

            .pc-content {
                padding: 0;
            }

            .page-header-title {
                margin-bottom: 20px;
            }

            .card {
                border: none;
                box-shadow: none;
                page-break-inside: avoid;
            }

            .card-header {
                background-color: #f8f9fa;
                border-bottom: 2px solid #dee2e6;
                page-break-after: avoid;
            }

            .card-body {
                padding: 40px 20px;
            }

            /* Tampilkan tombol lanjut hanya saat cetak jika diperlukan */
            .print-content {
                display: block;
            }

            /* Hapus warna latar belakang */
            .alert {
                border: 1px solid #999;
                background-color: #f5f5f5 !important;
            }

            /* Pastikan ikon tercetak dengan baik */
            i.feather {
                font-size: 60px !important;
            }

            /* Margin dan padding untuk print */
            .row {
                margin-right: 0;
                margin-left: 0;
            }
        }

        .print-button {
            white-space: nowrap;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
@endsection
