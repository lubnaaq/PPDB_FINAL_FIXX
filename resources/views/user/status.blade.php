@extends('layouts.dashboard')
@section('title', 'Status Seleksi')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Status Seleksi</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Status Pendaftaran & Seleksi</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- Status Pendaftaran -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Status Pendaftaran</h5>
                        <p class="text-muted mb-0">Informasi data pendaftaran Anda</p>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Kelengkapan Biodata</label>
                                    <span class="badge bg-success">{{ $biodataPercentage }}%</span>
                                </div>
                                <div class="progress" role="progressbar" aria-valuenow="{{ $biodataPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width: {{ $biodataPercentage }}%"></div>
                                </div>
                                <small class="text-muted d-block mt-2">
                                    @if ($biodataPercentage < 100)
                                        <i class="feather icon-info"></i> Lengkapi data pribadi Anda untuk melanjutkan
                                    @else
                                        <i class="feather icon-check-circle"></i> Semua data pribadi sudah lengkap
                                    @endif
                                </small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Kelengkapan Dokumen</label>
                                    <span class="badge {{ $dokumenPercentage >= 100 ? 'bg-success' : ($dokumenPercentage >= 50 ? 'bg-warning text-dark' : 'bg-danger') }}">{{ $dokumenPercentage }}%</span>
                                </div>
                                <div class="progress" role="progressbar" aria-valuenow="{{ $dokumenPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar {{ $dokumenPercentage >= 100 ? 'bg-success' : ($dokumenPercentage >= 50 ? 'bg-warning' : 'bg-danger') }}" style="width: {{ $dokumenPercentage }}%"></div>
                                </div>
                                <small class="text-muted d-block mt-2">
                                    @if ($dokumenPercentage === 0)
                                        <i class="feather icon-alert-triangle"></i> Belum ada dokumen yang diupload
                                    @elseif ($dokumenPercentage < 100)
                                        <i class="feather icon-info"></i> Upload {{ count($missingDocuments) }} dokumen lagi: <strong>{{ implode(', ', $missingDocuments) }}</strong>
                                    @else
                                        <i class="feather icon-check-circle"></i> Semua dokumen wajib sudah diupload
                                    @endif
                                </small>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-12">
                                <p class="mb-2"><strong>Status Berkas:</strong></p>
                                <span class="badge bg-{{ $statusBerkas['color'] }}">
                                    <i class="feather {{ $statusBerkas['icon'] }}"></i> {{ $statusBerkas['label'] }}
                                </span>
                                <small class="text-muted d-block mt-2">{{ $statusBerkas['description'] }}</small>
                            </div>
                        </div>

                        @if ($dokumenStats['total'] > 0)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="stats-container">
                                        <div class="stat-item">
                                            <div class="stat-value">{{ $dokumenStats['total'] }}</div>
                                            <div class="stat-label">Total Upload</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-value text-success">{{ $dokumenStats['disetujui'] }}</div>
                                            <div class="stat-label">Disetujui</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-value text-warning">{{ $dokumenStats['pending'] }}</div>
                                            <div class="stat-label">Pending</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-value text-danger">{{ $dokumenStats['ditolak'] }}</div>
                                            <div class="stat-label">Ditolak</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row mt-3">
                            <div class="col-12">
                                <small class="text-muted">
                                    <i class="feather icon-info"></i> Lengkapi semua data dan dokumen untuk proses seleksi lebih cepat
                                </small>
                            </div>
                        </div>

                        @if (count($missingDocuments) > 0)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6 class="mb-3">Dokumen yang Masih Diperlukan:</h6>
                                    <div class="checklist">
                                        @foreach ($requiredDocuments as $doc)
                                            <div class="checklist-item {{ in_array($doc, $uploadedDocuments) ? 'completed' : '' }}">
                                                <div class="checklist-icon">
                                                    @if (in_array($doc, $uploadedDocuments))
                                                        <i class="feather icon-check-circle text-success"></i>
                                                    @else
                                                        <i class="feather icon-circle text-muted"></i>
                                                    @endif
                                                </div>
                                                <div class="checklist-label">
                                                    {{ $doc }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Timeline Seleksi -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Timeline Seleksi</h5>
                        <p class="text-muted mb-0">Tahapan dan jadwal seleksi</p>
                    </div>
                    <div class="card-body">
                        <div class="timeline-item">
                            <div class="timeline-item-start">
                                <div class="timeline-icon bg-success text-white">
                                    <i class="feather icon-check"></i>
                                </div>
                            </div>
                            <div class="timeline-item-content">
                                <h6 class="mb-1">Pendaftaran</h6>
                                <p class="text-muted mb-0 small">3 Januari 2026</p>
                                <small class="text-success"><i class="feather icon-check-circle"></i> Selesai</small>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-item-start">
                                <div class="timeline-icon bg-warning text-dark">
                                    <i class="feather icon-clock"></i>
                                </div>
                            </div>
                            <div class="timeline-item-content">
                                <h6 class="mb-1">Verifikasi Berkas</h6>
                                <p class="text-muted mb-0 small">3 - 7 Januari 2026</p>
                                <small class="text-warning"><i class="feather icon-clock"></i> Sedang Berlangsung</small>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-item-start">
                                <div class="timeline-icon bg-secondary">
                                    <i class="feather icon-arrow-right"></i>
                                </div>
                            </div>
                           
                            <div class="timeline-item-content">
                                <h6 class="mb-1">Pengumuman Hasil</h6>
                                <p class="text-muted mb-0 small">15 Januari 2026</p>
                                <small class="text-muted"><i class="feather icon-arrow-right"></i> Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dokumen Verifikasi -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Status Verifikasi Dokumen</h5>
                        <p class="text-muted mb-0">Riwayat verifikasi berkas Anda</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Dokumen</th>
                                        <th>Tipe File</th>
                                        <th>Ukuran</th>
                                        <th>Tanggal Upload</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dokumens as $key => $dokumen)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><strong>{{ $dokumen->nama_dokumen }}</strong></td>
                                            <td><span class="badge bg-secondary">{{ strtoupper($dokumen->file_type) }}</span></td>
                                            <td>{{ $dokumen->created_at->format('d M Y H:i') }}</td>
                                            <td>
                                                @if ($dokumen->status_verifikasi === 'pending')
                                                    <span class="badge bg-warning text-dark"><i class="feather icon-clock"></i> Pending</span>
                                                @elseif ($dokumen->status_verifikasi === 'disetujui')
                                                    <span class="badge bg-success"><i class="feather icon-check-circle"></i> Disetujui</span>
                                                @else
                                                    <span class="badge bg-danger"><i class="feather icon-x-circle"></i> Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $dokumen->catatan_verifikasi ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="feather icon-inbox"></i> Belum ada dokumen yang diupload. <a href="{{ route('user.dokumen') }}">Upload dokumen sekarang</a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengumuman -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Pengumuman Penting</h5>
                        <p class="text-muted mb-0">Informasi terkini tentang seleksi</p>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            <h6 class="alert-heading"><i class="feather icon-info"></i> Pengumuman</h6>
                            <p class="mb-0">Verifikasi berkas berlangsung hingga 7 Januari 2026. Pastikan semua dokumen sudah Anda upload sebelum batas waktu.</p>
                        </div>

                        <div class="alert alert-warning" role="alert">
                            <h6 class="alert-heading"><i class="feather icon-alert-triangle"></i> Perhatian</h6>
                            <p class="mb-0">Jika ada dokumen yang ditolak, Anda dapat melakukan upload ulang maksimal 2 kali.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <style>
        .timeline-item {
            display: flex;
            margin-bottom: 20px;
            position: relative;
        }

        .timeline-item-start {
            position: relative;
            min-width: 50px;
            text-align: center;
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 18px;
        }

        .timeline-item-start::after {
            content: '';
            position: absolute;
            left: 19px;
            top: 40px;
            width: 2px;
            height: 30px;
            background-color: #121111ff;
        }

        .timeline-item:last-child .timeline-item-start::after {
            display: none;
        }

        .timeline-item-content {
            flex: 1;
            padding-left: 20px;
            padding-top: 5px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            background-color: #ffffffff;
            border: 1px solid #0e0e0fff;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .checklist {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .checklist-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 6px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .checklist-item.completed {
            background-color: #f0f9f5;
            border-color: #28a745;
        }

        .checklist-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 30px;
            font-size: 18px;
            margin-right: 10px;
        }

        .checklist-label {
            flex: 1;
            font-weight: 500;
            color: #333;
        }

        .checklist-item.completed .checklist-label {
            color: #28a745;
            text-decoration: line-through;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .stat-item {
                padding: 10px;
            }

            .stat-value {
                font-size: 18px;
            }
        }
    </style>
@endsection
