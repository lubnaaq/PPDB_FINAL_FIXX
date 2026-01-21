@extends('layouts.dashboard')
@section('title', 'Dashboard Admin')
@section('content')
    <style>
        /* BACKGROUND HALAMAN */
        body {
            margin: 0;
            background-image:
                linear-gradient(rgba(249, 248, 248, 0.55), rgba(0, 0, 0, 0.64)),
                url('assets/images/user/image.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .dashboard-wrapper {
            padding: 40px 30px;
        }

        .shadow-soft {
            box-shadow: 0 10px 40px rgba(0, 0, 0, .15);
            border-radius: 16px;
            border: none;
            transition: all 0.3s ease;
        }

        .shadow-soft:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, .25);
        }

        /* Stat Cards dengan Gradient */
        .stat-card {
            background: linear-gradient(135deg, var(--grad-start) 0%, var(--grad-end) 100%);
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, .1);
            border-radius: 50%;
            transition: all 0.5s ease;
        }

        .stat-card:hover::before {
            top: -20%;
            right: -10%;
        }

        .stat-card .card-body {
            position: relative;
            z-index: 1;
        }

        .stat-icon {
            font-size: 2rem;
            opacity: 0.7;
            margin-top: 10px;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 15px 0;
            animation: slideIn 0.6s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Update indicator */
        .update-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #4CAF50;
            margin-left: 8px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .card-update-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #4CAF50;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            display: none;
            z-index: 10;
        }

        .stat-card.updated .card-update-badge {
            display: block;
            animation: slideInUpdate 0.5s ease;
        }

        @keyframes slideInUpdate {
            from {
                transform: translateX(20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .stat-card.updated {
            box-shadow: 0 0 20px rgba(76, 175, 80, 0.5);
        }

        /* Real-time status */
        .realtime-status {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 12px 16px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            z-index: 100;
        }

        .realtime-status.online {
            background: #f0f9ff;
            border-left: 4px solid #4680ff;
        }

        .realtime-status.offline {
            background: #fef2f2;
            border-left: 4px solid #dc3545;
        }

        .realtime-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #4CAF50;
            animation: pulse 1s infinite;
        }

        .realtime-dot.offline {
            background: #dc3545;
            animation: none;
        }

        .card {
            border: 1px solid rgba(255, 255, 255, .1);
        }

        .card-header {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-bottom: 2px solid rgba(102, 126, 234, 0.2);
            padding: 1.5rem;
            position: relative;
        }

        .card-header h5 {
            margin: 0;
            color: #333;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .apexcharts-legend {
            justify-content: center;
        }

        /* Hide PNG/SVG export for selected charts */
        .csv-only-toolbar .apexcharts-menu-item.exportSVG,
        .csv-only-toolbar .apexcharts-menu-item.exportPNG {
            display: none !important;
        }

        /* Last update info */
        .last-update {
            position: absolute;
            bottom: 5px;
            right: 10px;
            font-size: 9px;
            color: rgba(255, 255, 255, .6);
        }
    </style>

    <div class="pc-content">
        <div class="dashboard-wrapper">

            <!-- Real-time Status Indicator -->
            <div class="realtime-status online" id="realtimeStatus">
                <div class="realtime-dot" id="realtimeDot"></div>
                <span id="realtimeText">Live Update: Aktif</span>
            </div>

            <div class="row mb-3">

                <!-- Statistik Utama dengan Gradient -->
                <div class="col-md-6 col-xl-3 mb-3">
                    <a href="{{ route('admin.pendaftar') }}" class="card shadow-soft stat-card h-100" id="cardTotalPendaftar"
                        style="--grad-start: #4680ff; --grad-end: #2e5ce6;">
                        <div class="card-update-badge">UPDATED</div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small>Total Pendaftar</small>
                                    <h3 class="stat-value" id="dashTotalPendaftar">0</h3>
                                </div>
                                <div class="stat-icon"><i class="feather icon-users"></i></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3 mb-3">
                    <div class="card shadow-soft stat-card h-100" id="cardSudahIsiBiodata"
                        style="--grad-start: #28a745; --grad-end: #1e7e34;">
                        <div class="card-update-badge">UPDATED</div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small>Sudah Isi Biodata</small>
                                    <h3 class="stat-value" id="dashSudahIsiBiodata">0</h3>
                                </div>
                                <div class="stat-icon"><i class="feather icon-check-circle"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3 mb-3">
                    <a href="{{ route('admin.verifikasi') }}" class="card shadow-soft stat-card h-100"
                        id="cardSudahUploadDokumen" style="--grad-start: #ffc107; --grad-end: #ff9800;">
                        <div class="card-update-badge">UPDATED</div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small>Sudah Upload Dokumen</small>
                                    <h3 class="stat-value" id="dashSudahUploadDokumen">0</h3>
                                </div>
                                <div class="stat-icon"><i class="feather icon-upload-cloud"></i></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3 mb-3">
                    <a href="{{ route('admin.seleksi') }}" class="card shadow-soft stat-card h-100" id="cardLulusSeleksi"
                        style="--grad-start: #17a2b8; --grad-end: #138496;">
                        <div class="card-update-badge">UPDATED</div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small>Lulus Seleksi</small>
                                    <h3 class="stat-value" id="dashLulusSeleksi">0</h3>
                                </div>
                                <div class="stat-icon"><i class="feather icon-award"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Diagram: Pendaftaran Harian -->
                <div class="col-md-12 col-xl-8 mb-3">
                    <div class="card shadow-soft h-100">
                        <div class="card-header">
                            <h5><i class="feather icon-trending-up me-2" style="color: #4680ff;"></i>Statistik Pendaftaran
                                Harian (7 Hari)</h5>
                        </div>
                        <div class="card-body">
                            <div id="dashRegistrationChart"></div>
                        </div>
                    </div>
                </div>

                <!-- Diagram: Komposisi Gender -->
                <div class="col-md-12 col-xl-4 mb-3">
                    <div class="card shadow-soft h-100">
                        <div class="card-header">
                            <h5><i class="feather icon-pie-chart me-2" style="color: #ff5252;"></i>Komposisi Gender</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <div id="dashGenderChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Diagram: Status Verifikasi -->
                <div class="col-md-12 col-xl-6 mb-3">
                    <div class="card shadow-soft h-100">
                        <div class="card-header">
                            <h5><i class="feather icon-check me-2" style="color: #28a745;"></i>Status Verifikasi Dokumen
                            </h5>
                        </div>
                        <div class="card-body">
                            <div id="dashStatusVerifikasiChart" class="csv-only-toolbar"></div>
                        </div>
                    </div>
                </div>

                <!-- Diagram: Status Seleksi -->
                <div class="col-md-12 col-xl-6 mb-3">
                    <div class="card shadow-soft h-100">
                        <div class="card-header">
                            <h5><i class="feather icon-filter me-2" style="color: #ffc107;"></i>Status Seleksi Biodata</h5>
                        </div>
                        <div class="card-body">
                            <div id="dashStatusSeleksiChart" class="csv-only-toolbar"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- ApexCharts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            // Global chart variables
            var dashRegistrationChart = null;
            var dashGenderChart = null;
            var dashStatusVerifikasiChart = null;
            var dashStatusSeleksiChart = null;
            let updateInterval = null;

            document.addEventListener('DOMContentLoaded', function() {
                const DATA_URL = "{{ route('admin.laporan.data') }}";
                console.log('Dashboard initialized with DATA_URL:', DATA_URL);

                // Store previous values for change detection
                let previousValues = {
                    totalPendaftar: 0,
                    sudahIsiBiodata: 0,
                    sudahUploadDokumen: 0,
                    lulusSeleksi: 0
                };

                async function initAndUpdateCharts() {
                    console.log('Fetching dashboard data...');
                    try {
                        const res = await fetch(DATA_URL);
                        if (!res.ok) {
                            updateRealtimeStatus(false);
                            return;
                        }
                        updateRealtimeStatus(true);

                        const data = await res.json();

                        // Update stat cards dengan animasi dan change detection
                        const statElements = {
                            'dashTotalPendaftar': data.totalPendaftar ?? 0,
                            'dashSudahIsiBiodata': data.sudahIsiBiodata ?? 0,
                            'dashSudahUploadDokumen': data.sudahUploadDokumen ?? 0,
                            'dashLulusSeleksi': data.lulusSeleksi ?? 0
                        };

                        for (const [id, value] of Object.entries(statElements)) {
                            const elem = document.getElementById(id);
                            const cardId = 'card' + id.replace('dash', '');
                            const card = document.getElementById(cardId);

                            if (elem) {
                                const oldValue = parseInt(elem.textContent) || 0;
                                if (oldValue !== value) {
                                    animateValue(elem, oldValue, value, 600);
                                    // Show update badge
                                    if (card) {
                                        card.classList.add('updated');
                                        setTimeout(() => card.classList.remove('updated'), 3000);
                                    }
                                }
                            }
                        }

                        // Pendaftaran Harian Chart
                        const dates = (data.pendaftaranHarian || []).map(d => d.date);
                        const totals = (data.pendaftaranHarian || []).map(d => d.total);

                        if (!dashRegistrationChart) {
                            const regOptions = {
                                series: [{
                                    name: 'Pendaftar',
                                    data: totals
                                }],
                                chart: {
                                    height: 320,
                                    type: 'area',
                                    toolbar: {
                                        show: false
                                    },
                                    animations: {
                                        enabled: true,
                                        easing: 'easeinout',
                                        speed: 800
                                    }
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    curve: 'smooth',
                                    width: 3
                                },
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: 0.45,
                                        opacityTo: 0.05,
                                        stops: [20, 100, 100, 100]
                                    }
                                },
                                xaxis: {
                                    categories: dates,
                                    type: 'datetime'
                                },
                                tooltip: {
                                    x: {
                                        format: 'dd MMM yyyy'
                                    },
                                    theme: 'dark'
                                },
                                colors: ['#4680ff']
                            };
                            dashRegistrationChart = new ApexCharts(document.querySelector('#dashRegistrationChart'),
                                regOptions);
                            dashRegistrationChart.render();
                        } else {
                            dashRegistrationChart.updateOptions({
                                xaxis: {
                                    categories: dates
                                }
                            });
                            dashRegistrationChart.updateSeries([{
                                name: 'Pendaftar',
                                data: totals
                            }], true);
                        }

                        // Gender Chart dengan animasi
                        const male = data.jenisKelamin && data.jenisKelamin.L ? data.jenisKelamin.L : 0;
                        const female = data.jenisKelamin && data.jenisKelamin.P ? data.jenisKelamin.P : 0;

                        if (!dashGenderChart) {
                            const genderOptions = {
                                series: [male, female],
                                chart: {
                                    type: 'pie',
                                    height: 320,
                                    animations: {
                                        enabled: true,
                                        easing: 'easeinout',
                                        speed: 800
                                    }
                                },
                                labels: ['Laki-laki', 'Perempuan'],
                                colors: ['#4680ff', '#ff5252'],
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            size: '65%',
                                            labels: {
                                                show: true,
                                                name: {
                                                    show: true
                                                },
                                                value: {
                                                    show: true
                                                }
                                            }
                                        }
                                    }
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: (val) => val.toFixed(1) + '%'
                                },
                                tooltip: {
                                    theme: 'dark'
                                }
                            };
                            dashGenderChart = new ApexCharts(document.querySelector('#dashGenderChart'),
                                genderOptions);
                            dashGenderChart.render();
                        } else {
                            dashGenderChart.updateSeries([male, female], true);
                        }

                        // Status Verifikasi Chart
                        if (data.statusVerifikasi) {
                            const verifikasiLabels = Object.keys(data.statusVerifikasi);
                            const verifikasiTotals = Object.values(data.statusVerifikasi);

                            if (!dashStatusVerifikasiChart) {
                                const verifikasiOptions = {
                                    series: [{
                                        data: verifikasiTotals
                                    }],
                                    chart: {
                                        type: 'bar',
                                        height: 320,
                                        animations: {
                                            enabled: true,
                                            easing: 'easeinout',
                                            speed: 800
                                        }
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: true,
                                            borderRadius: 6,
                                            dataLabels: {
                                                position: 'top'
                                            }
                                        }
                                    },
                                    dataLabels: {
                                        enabled: true,
                                        offsetX: 0
                                    },
                                    xaxis: {
                                        categories: verifikasiLabels
                                    },
                                    colors: ['#28a745', '#ffc107', '#dc3545'],
                                    tooltip: {
                                        theme: 'dark'
                                    }
                                };
                                dashStatusVerifikasiChart = new ApexCharts(document.querySelector(
                                    '#dashStatusVerifikasiChart'), verifikasiOptions);
                                dashStatusVerifikasiChart.render();
                            } else {
                                dashStatusVerifikasiChart.updateOptions({
                                    xaxis: {
                                        categories: verifikasiLabels
                                    }
                                });
                                dashStatusVerifikasiChart.updateSeries([{
                                    data: verifikasiTotals
                                }], true);
                            }
                        }

                        // Status Seleksi Chart
                        if (data.statusSeleksi) {
                            const seleksiLabels = Object.keys(data.statusSeleksi);
                            const seleksiTotals = Object.values(data.statusSeleksi);

                            if (!dashStatusSeleksiChart) {
                                const seleksiOptions = {
                                    series: [{
                                        data: seleksiTotals
                                    }],
                                    chart: {
                                        type: 'bar',
                                        height: 320,
                                        animations: {
                                            enabled: true,
                                            easing: 'easeinout',
                                            speed: 800
                                        }
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: true,
                                            borderRadius: 6,
                                            dataLabels: {
                                                position: 'top'
                                            }
                                        }
                                    },
                                    dataLabels: {
                                        enabled: true,
                                        offsetX: 0
                                    },
                                    xaxis: {
                                        categories: seleksiLabels
                                    },
                                    colors: ['#4680ff', '#28a745', '#dc3545'],
                                    tooltip: {
                                        theme: 'dark'
                                    }
                                };
                                dashStatusSeleksiChart = new ApexCharts(document.querySelector(
                                    '#dashStatusSeleksiChart'), seleksiOptions);
                                dashStatusSeleksiChart.render();
                            } else {
                                dashStatusSeleksiChart.updateOptions({
                                    xaxis: {
                                        categories: seleksiLabels
                                    }
                                });
                                dashStatusSeleksiChart.updateSeries([{
                                    data: seleksiTotals
                                }], true);
                            }
                        }

                    } catch (err) {
                        console.error('Error fetching dashboard data', err);
                        updateRealtimeStatus(false);
                    }
                }

                // Update real-time status indicator
                function updateRealtimeStatus(isOnline) {
                    const status = document.getElementById('realtimeStatus');
                    const dot = document.getElementById('realtimeDot');
                    const text = document.getElementById('realtimeText');

                    if (isOnline) {
                        status.classList.remove('offline');
                        status.classList.add('online');
                        dot.classList.remove('offline');
                        text.textContent = '🟢 Live Update: Aktif';
                    } else {
                        status.classList.remove('online');
                        status.classList.add('offline');
                        dot.classList.add('offline');
                        text.textContent = '🔴 Live Update: Offline';
                    }
                }

                // Fungsi animasi angka
                function animateValue(elem, start, end, duration) {
                    let range = end - start;
                    let increment = end > start ? 1 : -1;
                    let current = start;
                    let stepTime = Math.abs(Math.floor(duration / range));
                    let timer = setInterval(() => {
                        current += increment;
                        elem.textContent = current;
                        if (current === end) {
                            clearInterval(timer);
                        }
                    }, stepTime);
                }

                // Initial load
                initAndUpdateCharts();

                // Poll every 10 seconds untuk update lebih cepat
                updateInterval = setInterval(initAndUpdateCharts, 10000);

                // Optional: Stop polling when page is hidden
                document.addEventListener('visibilitychange', () => {
                    if (document.hidden) {
                        clearInterval(updateInterval);
                    } else {
                        initAndUpdateCharts();
                        updateInterval = setInterval(initAndUpdateCharts, 10000);
                    }
                });
            });
        </script>
    @endsection
