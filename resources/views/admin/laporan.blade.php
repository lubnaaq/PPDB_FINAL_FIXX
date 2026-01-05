@extends('layouts.dashboard')
@section('title', 'Laporan PPDB')
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
    </style>
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
        <div class="row">
            <!-- Statistik Utama -->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white">
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
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white">
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
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Sudah Upload Dokumen</h6>
                                <h3 class="m-b-0 text-white"><span id="sudahUploadDokumen">{{ $sudahUploadDokumen }}</span></h3>
                            </div>
                            <div class="col-auto">
                                <i class="feather icon-upload-cloud f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white">
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
            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white">
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
            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-b-5 text-white">Pembayaran Pending</h6>
                                <h3 class="m-b-0 text-white"><span id="pembayaranPending">{{ $pembayaranPending }}</span></h3>
                            </div>
                            <div class="col-auto">
                                <i class="feather icon-clock f-30"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Statistik Pendaftaran Harian (7 Hari Terakhir)</h5>
                    </div>
                    <div class="card-body">
                        <div id="registrationChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Komposisi Gender</h5>
                    </div>
                    <div class="card-body">
                        <div id="genderChart"></div>
                    </div>
                </div>
            </div>

            <!-- Asal Sekolah -->
            <div class="col-md-6">
                <div class="card">
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Pembayaran Terbaru</h5>
                    </div>
                    <div class="card-body">
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
                                                @if($payment->status == 'verified')
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
                                        <th>Nilai Rata-rata</th> <!-- Placeholder -->
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
                                            <td>-</td>
                                            <td><span class="badge bg-success">LULUS</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">Belum ada siswa yang dinyatakan lulus.</td>
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
                series: [{ name: 'Pendaftar', data: initialTotals }],
                chart: { height: 350, type: 'area', toolbar: { show: false } },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth' },
                xaxis: { categories: initialDates, type: 'datetime' },
                tooltip: { x: { format: 'dd MMM yyyy' } },
                colors: ['#4680ff']
            };
            var regChart = new ApexCharts(document.querySelector('#registrationChart'), regOptions);
            regChart.render();

            // Gender Chart
            var genderOptions = {
                series: initialGender,
                chart: { width: 380, type: 'pie' },
                labels: ['Laki-laki', 'Perempuan'],
                colors: ['#4680ff', '#ff5252'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: { width: 200 },
                        legend: { position: 'bottom' }
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
                    if(document.getElementById('totalPendaftar')) document.getElementById('totalPendaftar').textContent = data.totalPendaftar ?? 0;
                    if(document.getElementById('sudahIsiBiodata')) document.getElementById('sudahIsiBiodata').textContent = data.sudahIsiBiodata ?? 0;
                    if(document.getElementById('sudahUploadDokumen')) document.getElementById('sudahUploadDokumen').textContent = data.sudahUploadDokumen ?? 0;
                    if(document.getElementById('lulusSeleksi')) document.getElementById('lulusSeleksi').textContent = data.lulusSeleksi ?? 0;
                    if(document.getElementById('sudahBayar')) document.getElementById('sudahBayar').textContent = data.sudahBayar ?? 0;
                    if(document.getElementById('pembayaranPending')) document.getElementById('pembayaranPending').textContent = data.pembayaranPending ?? 0;

                    // Update registration chart
                    const dates = (data.pendaftaranHarian || []).map(d => d.date);
                    const totals = (data.pendaftaranHarian || []).map(d => d.total);
                    regChart.updateOptions({ xaxis: { categories: dates } });
                    regChart.updateSeries([{ name: 'Pendaftar', data: totals }]);

                    // Update gender chart
                    const male = data.jenisKelamin && data.jenisKelamin.L ? data.jenisKelamin.L : 0;
                    const female = data.jenisKelamin && data.jenisKelamin.P ? data.jenisKelamin.P : 0;
                    genderChart.updateSeries([male, female]);

                    // Update asal sekolah table
                    const asalBody = document.getElementById('asalSekolahBody');
                    if (asalBody) {
                        asalBody.innerHTML = '';
                        if ((data.asalSekolah || []).length === 0) {
                            asalBody.innerHTML = '<tr><td colspan="2" class="text-center">Belum ada data</td></tr>';
                        } else {
                            data.asalSekolah.forEach(s => {
                                const tr = `<tr><td>${s.asal_sekolah || '-'}</td><td class="text-end">${s.total || 0}</td></tr>`;
                                asalBody.insertAdjacentHTML('beforeend', tr);
                            });
                        }
                    }

                    // Update payment table
                    const paymentBody = document.getElementById('pembayaranBody');
                    if (paymentBody) {
                        paymentBody.innerHTML = '';
                        if ((data.dataPembayaran || []).length === 0) {
                            paymentBody.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada data pembayaran</td></tr>';
                        } else {
                            data.dataPembayaran.forEach(p => {
                                let statusBadge = '';
                                if (p.status === 'verified') {
                                    statusBadge = '<span class="badge bg-success">Verified</span>';
                                } else if (p.status === 'rejected') {
                                    statusBadge = '<span class="badge bg-danger">Rejected</span>';
                                } else {
                                    statusBadge = '<span class="badge bg-warning text-dark">Pending</span>';
                                }
                                
                                const date = new Date(p.payment_date).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                                const amount = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(p.amount);
                                const method = (p.payment_method || '').replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
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
                            siswaBody.innerHTML = '<tr><td colspan="6" class="text-center py-4">Belum ada siswa yang dinyatakan lulus.</td></tr>';
                        } else {
                            data.siswaLulus.forEach((s, i) => {
                                const jenis = s.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                                const tr = `<tr><td>${i+1}</td><td>${s.nama_lengkap}</td><td>${jenis}</td><td>${s.asal_sekolah || '-'}</td><td>-</td><td><span class="badge bg-success">LULUS</span></td></tr>`;
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
