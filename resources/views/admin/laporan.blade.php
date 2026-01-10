@extends('layouts.dashboard')
@section('title', 'Laporan PPDB')
@section('content')
    <style>
        body {
            background-image:
                linear-gradient(rgba(249, 248, 248, 0.55), rgba(0, 0, 0, 0.64)),
                url('{{ asset('assets/images/user/image.png') }}');
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
            .col-xl-3,
            .col-md-8,
            .col-md-4,
            .col-md-6,
            #registrationChart,
            #genderChart,
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

            .print-header .logo {
                width: 80px;
                height: 80px;
                margin-bottom: 15px;
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
                padding: 8px !important;
                font-size: 10pt !important;
                text-align: left;
            }

            table th {
                background-color: #e0e0e0 !important;
                font-weight: bold;
                text-align: center;
            }

            .badge {
                border: 1px solid #333 !important;
                padding: 2px 6px !important;
                background-color: #f5f5f5 !important;
                color: #000 !important;
            }

            /* Signature section */
            .print-signature {
                display: block !important;
                margin-top: 50px;
                page-break-inside: avoid;
            }

            .print-signature-wrapper {
                display: flex;
                justify-content: space-between;
                width: 100%;
            }

            .signature-box {
                width: 45%;
                text-align: center;
            }

            .signature-box p {
                margin: 5px 0;
            }

            .signature-space {
                height: 80px;
                margin: 10px 0;
            }

            .signature-name {
                font-weight: bold;
                text-decoration: underline;
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

            /* Page settings */
            @page {
                size: A4;
                margin: 20mm;
            }

            /* Summary stats for print */
            .print-summary {
                display: block !important;
                margin: 20px 0;
                padding: 15px;
                border: 2px solid #000;
                background-color: #f9f9f9;
            }

            .print-summary h4 {
                margin: 0 0 10px 0;
                font-size: 12pt;
                font-weight: bold;
            }

            .print-summary-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }

            .print-summary-item {
                padding: 8px;
                border: 1px solid #666;
                text-align: center;
            }

            .print-summary-item strong {
                display: block;
                font-size: 16pt;
                margin-bottom: 5px;
            }

            .print-summary-item span {
                font-size: 9pt;
            }
        }

        /* Hide print elements on screen */
        .print-header,
        .print-info,
        .print-signature,
        .print-footer,
        .print-summary {
            display: none;
        }
    </style>
    <div class="pc-content">
        <!-- Print Header (Only visible when printing) -->
        <div class="print-header">
            <table style="width: 100%; border: none;">
                <tr style="border: none;">
                    <td style="width: 80px; border: none; vertical-align: top;">
                        <!-- Logo placeholder - Ganti dengan logo sekolah Anda -->
                        <img src="{{ asset('assets/images/cropped-ANT-LG.png') }}" alt="Logo"
                            style="width: 80px; height: auto;">
                    </td>
                    <td style="border: none; text-align: center; padding-left: 20px;">
                        <h2 style="margin: 0; font-size: 18pt; font-weight: bold;">SMK ANTARTIKA 1 SIDOARJO</h2>
                        <h3 style="margin: 5px 0; font-size: 14pt; font-weight: bold;">SISTEM PENERIMAAN PESERTA DIDIK BARU
                        </h3>
                        <p style="margin: 2px 0; font-size: 8pt;">Jl. Siwalan Panji, Bedrek, Siwalanpanji, Kec. Sidoarjo,
                            Kab. Sidoarjo, Jawa Timur 61252</p>
                        <p style="margin: 2px 0; font-size: 8pt;">Telp: (031) 8962851 | Email: info@smkantartika.sch.id |
                            Website: www.smkantartika.sch.id</p>
                    </td>
                    <td style="width: 80px; border: none;"></td>
                </tr>
            </table>
        </div>

        <!-- Print Info (Only visible when printing) -->
        <div class="print-info">
            <h3 style="text-align: center; margin: 20px 0; font-size: 14pt; font-weight: bold; text-decoration: underline;">
                LAPORAN PENERIMAAN PESERTA DIDIK BARU
            </h3>
            <h4 style="text-align: center; margin: 10px 0 20px 0; font-size: 12pt;">
                TAHUN AJARAN 2026/2027
            </h4>

            <table style="border: none; width: auto; margin-bottom: 20px;">
                <tr style="border: none;">
                    <td style="width: 150px; border: none; padding: 3px 0;">Tanggal Cetak</td>
                    <td style="width: 20px; border: none; padding: 3px 0;">:</td>
                    <td style="border: none; padding: 3px 0;">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none; padding: 3px 0;">Waktu Cetak</td>
                    <td style="border: none; padding: 3px 0;">:</td>
                    <td style="border: none; padding: 3px 0;">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none; padding: 3px 0;">Dicetak Oleh</td>
                    <td style="border: none; padding: 3px 0;">:</td>
                    <td style="border: none; padding: 3px 0;">{{ Auth::user()->name }}</td>
                </tr>
            </table>
        </div>

        <!-- Print Summary Stats (Only visible when printing) -->
        <div class="print-summary">
            <h4>RINGKASAN DATA PENDAFTARAN</h4>
            <div class="print-summary-grid">
                <div class="print-summary-item">
                    <strong>{{ $totalPendaftar }}</strong>
                    <span>Total Pendaftar</span>
                </div>
                <div class="print-summary-item">
                    <strong>{{ $sudahIsiBiodata }}</strong>
                    <span>Sudah Isi Biodata</span>
                </div>
                <div class="print-summary-item">
                    <strong>{{ $sudahUploadDokumen }}</strong>
                    <span>Sudah Upload Dokumen</span>
                </div>
                <div class="print-summary-item">
                    <strong>{{ $lulusSeleksi }}</strong>
                    <span>Lulus Seleksi</span>
                </div>
                <div class="print-summary-item">
                    <strong>{{ $sudahBayar }}</strong>
                    <span>Sudah Bayar</span>
                </div>
                <div class="print-summary-item">
                    <strong>{{ $pembayaranPending }}</strong>
                    <span>Pembayaran Pending</span>
                </div>
            </div>
        </div>

        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Laporan PPDB</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Laporan Penerimaan Peserta Didik Baru</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row mb-3">
            <!-- Statistik Utama -->
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Total Pendaftar</h6>
                                <h3 class="m-b-0 text-white"><span id="totalPendaftar">{{ $totalPendaftar }}</span></h3>
                            </div>
                            <div class="col-auto">
                                <i class="feather icon-users f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Sudah Isi Biodata</h6>
                                <h3 class="m-b-0 text-white"><span id="sudahIsiBiodata">{{ $sudahIsiBiodata }}</span></h3>
                            </div>
                            <div class="col-auto">
                                <i class="feather icon-file-text f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Sudah Upload Dokumen</h6>
                                <h3 class="m-b-0 text-white"><span id="sudahUploadDokumen">{{ $sudahUploadDokumen }}</span>
                                </h3>
                            </div>
                            <div class="col-auto">
                                <i class="feather icon-upload-cloud f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Lulus Seleksi</h6>
                                <h3 class="m-b-0 text-white"><span id="lulusSeleksi">{{ $lulusSeleksi }}</span></h3>
                            </div>
                            <div class="col-auto">
                                <i class="feather icon-check-circle f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Stats -->
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card bg-dark text-white h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Sudah Bayar</h6>
                                <h3 class="m-b-0 text-white"><span id="sudahBayar">{{ $sudahBayar }}</span></h3>
                            </div>
                            <div class="col-auto">
                                <i class="feather icon-credit-card f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                <div class="card bg-secondary text-white h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Pembayaran Pending</h6>
                                <h3 class="m-b-0 text-white"><span id="pembayaranPending">{{ $pembayaranPending }}</span>
                                </h3>
                            </div>
                            <div class="col-auto">
                                <i class="feather icon-clock f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Charts Row -->
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Statistik Pendaftaran Harian (7 Hari Terakhir)</h5>
                    </div>
                    <div class="card-body">
                        <div id="registrationChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Komposisi Gender</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div id="genderChart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Asal Sekolah -->
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Top 5 Asal Sekolah</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama Sekolah</th>
                                        <th class="text-end">Jumlah Pendaftar</th>
                                    </tr>
                                </thead>
                                <tbody id="asalSekolahBody">
                                    @forelse($asalSekolah as $sekolah)
                                        <tr>
                                            <td>{{ $sekolah->asal_sekolah }}</td>
                                            <td class="text-end">{{ $sekolah->total }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Belum ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Pembayaran Terbaru -->
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Pembayaran Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama Pendaftar</th>
                                        <th>Tanggal</th>
                                        <th>Metode</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="pembayaranBody">
                                    @forelse($dataPembayaran as $payment)
                                        <tr>
                                            <td>{{ $payment->user->name ?? 'User Deleted' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                                            <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($payment->status == 'verified')
                                                    <span class="badge bg-success">Verified</span>
                                                @elseif($payment->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada data pembayaran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Tabel Siswa Lulus -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Daftar Siswa Lulus Seleksi</h5>
                        <button class="btn btn-primary btn-sm" onclick="window.print()">
                            <i class="feather icon-printer me-2"></i> Cetak Laporan
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Asal Sekolah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="siswaLulusBody">
                                    @forelse($siswaLulus as $key => $siswa)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $siswa->nama_lengkap }}</td>
                                            <td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>{{ $siswa->asal_sekolah ?? '-' }}</td>
                                            <td><span class="badge bg-success">LULUS</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">Belum ada siswa yang dinyatakan
                                                lulus.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Signature Section (Only visible when printing) -->
        <div class="print-signature">
            <p style="margin: 20px 0 10px 0; text-align: justify; font-size: 10pt;">
                Demikian laporan ini dibuat dengan sebenarnya berdasarkan data yang telah terverifikasi dalam Sistem
                Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran 2026/2027.
            </p>

            <table style="width: 100%; border: none; margin-top: 40px;">
                <tr style="border: none;">
                    <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                        <p style="margin: 0;">Mengetahui,</p>
                        <p style="margin: 5px 0 0 0; font-weight: bold;">Ketua Panitia PPDB</p>
                        <div style="height: 80px;"></div>
                        <p style="margin: 0; font-weight: bold; text-decoration: underline;">_______________________</p>
                        <p style="margin: 5px 0 0 0; font-size: 10pt;">NIP. ___________________</p>
                    </td>
                    <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                        <p style="margin: 0;">Bandung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        <p style="margin: 5px 0 0 0; font-weight: bold;">Kepala Sekolah</p>
                        <div style="height: 80px;"></div>
                        <p style="margin: 0; font-weight: bold; text-decoration: underline;">_______________________</p>
                        <p style="margin: 5px 0 0 0; font-size: 10pt;">NIP. ___________________</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Print Footer (Only visible when printing) -->
        <div class="print-footer">
            <p style="margin: 0;">Dokumen ini dicetak secara otomatis dari Sistem PPDB SMK Negeri Unggulan</p>
            <p style="margin: 5px 0 0 0;">Halaman ini merupakan dokumen resmi dan sah tanpa memerlukan tanda tangan basah
            </p>
        </div>

        <!-- [ Main Content ] end -->
    </div>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initial chart data from server-side render
            var initialDates = @json($pendaftaranHarian->pluck('date'));
            var initialTotals = @json($pendaftaranHarian->pluck('total'));
            var initialGender = [{{ $jenisKelamin['L'] ?? 0 }}, {{ $jenisKelamin['P'] ?? 0 }}];

            // Registration Chart
            var regOptions = {
                series: [{
                    name: 'Pendaftar',
                    data: initialTotals
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: initialDates,
                    type: 'datetime'
                },
                tooltip: {
                    x: {
                        format: 'dd MMM yyyy'
                    }
                },
                colors: ['#4680ff']
            };
            var regChart = new ApexCharts(document.querySelector('#registrationChart'), regOptions);
            regChart.render();

            // Gender Chart
            var genderOptions = {
                series: initialGender,
                chart: {
                    width: 380,
                    type: 'pie'
                },
                labels: ['Laki-laki', 'Perempuan'],
                colors: ['#4680ff', '#ff5252'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            var genderChart = new ApexCharts(document.querySelector('#genderChart'), genderOptions);
            genderChart.render();

            // Real-time polling
            const DATA_URL = "{{ route('admin.laporan.data') }}";

            async function fetchAndUpdate() {
                try {
                    const res = await fetch(DATA_URL);
                    if (!res.ok) return;
                    const data = await res.json();

                    // Update stat cards
                    if (document.getElementById('totalPendaftar')) document.getElementById('totalPendaftar')
                        .textContent = data.totalPendaftar ?? 0;
                    if (document.getElementById('sudahIsiBiodata')) document.getElementById('sudahIsiBiodata')
                        .textContent = data.sudahIsiBiodata ?? 0;
                    if (document.getElementById('sudahUploadDokumen')) document.getElementById(
                        'sudahUploadDokumen').textContent = data.sudahUploadDokumen ?? 0;
                    if (document.getElementById('lulusSeleksi')) document.getElementById('lulusSeleksi')
                        .textContent = data.lulusSeleksi ?? 0;
                    if (document.getElementById('sudahBayar')) document.getElementById('sudahBayar')
                        .textContent = data.sudahBayar ?? 0;
                    if (document.getElementById('pembayaranPending')) document.getElementById(
                        'pembayaranPending').textContent = data.pembayaranPending ?? 0;

                    // Update registration chart
                    const dates = (data.pendaftaranHarian || []).map(d => d.date);
                    const totals = (data.pendaftaranHarian || []).map(d => d.total);
                    regChart.updateOptions({
                        xaxis: {
                            categories: dates
                        }
                    });
                    regChart.updateSeries([{
                        name: 'Pendaftar',
                        data: totals
                    }]);

                    // Update gender chart
                    const male = data.jenisKelamin && data.jenisKelamin.L ? data.jenisKelamin.L : 0;
                    const female = data.jenisKelamin && data.jenisKelamin.P ? data.jenisKelamin.P : 0;
                    genderChart.updateSeries([male, female]);

                    // Update asal sekolah table
                    const asalBody = document.getElementById('asalSekolahBody');
                    if (asalBody) {
                        asalBody.innerHTML = '';
                        if ((data.asalSekolah || []).length === 0) {
                            asalBody.innerHTML =
                                '<tr><td colspan="2" class="text-center">Belum ada data</td></tr>';
                        } else {
                            data.asalSekolah.forEach(s => {
                                const tr =
                                    `<tr><td>${s.asal_sekolah || '-'}</td><td class="text-end">${s.total || 0}</td></tr>`;
                                asalBody.insertAdjacentHTML('beforeend', tr);
                            });
                        }
                    }

                    // Update payment table
                    const paymentBody = document.getElementById('pembayaranBody');
                    if (paymentBody) {
                        paymentBody.innerHTML = '';
                        if ((data.dataPembayaran || []).length === 0) {
                            paymentBody.innerHTML =
                                '<tr><td colspan="5" class="text-center">Belum ada data pembayaran</td></tr>';
                        } else {
                            data.dataPembayaran.forEach(p => {
                                let statusBadge = '';
                                if (p.status === 'verified') {
                                    statusBadge = '<span class="badge bg-success">Verified</span>';
                                } else if (p.status === 'rejected') {
                                    statusBadge = '<span class="badge bg-danger">Rejected</span>';
                                } else {
                                    statusBadge =
                                        '<span class="badge bg-warning text-dark">Pending</span>';
                                }

                                const date = new Date(p.payment_date).toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric'
                                });
                                const amount = new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }).format(p.amount);
                                const method = (p.payment_method || '').replace('_', ' ').replace(
                                    /\b\w/g, l => l.toUpperCase());
                                const userName = p.user ? p.user.name : 'User Deleted';

                                const tr = `<tr>
                                    <td>${userName}</td>
                                    <td>${date}</td>
                                    <td>${method}</td>
                                    <td>${amount}</td>
                                    <td>${statusBadge}</td>
                                </tr>`;
                                paymentBody.insertAdjacentHTML('beforeend', tr);
                            });
                        }
                    }

                    // Update siswa lulus table
                    const siswaBody = document.getElementById('siswaLulusBody');
                    if (siswaBody) {
                        siswaBody.innerHTML = '';
                        if ((data.siswaLulus || []).length === 0) {
                            siswaBody.innerHTML =
                                '<tr><td colspan="5" class="text-center py-4">Belum ada siswa yang dinyatakan lulus.</td></tr>';
                        } else {
                            data.siswaLulus.forEach((s, i) => {
                                const jenis = s.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                                const tr =
                                    `<tr><td>${i+1}</td><td>${s.nama_lengkap}</td><td>${jenis}</td><td>${s.asal_sekolah || '-'}</td><td><span class="badge bg-success">LULUS</span></td></tr>`;
                                siswaBody.insertAdjacentHTML('beforeend', tr);
                            });
                        }
                    }

                } catch (err) {
                    console.error('Error fetching laporan data', err);
                }
            }

            // Poll every 10 seconds
            setInterval(fetchAndUpdate, 10000);
        });
    </script>
@endsection
