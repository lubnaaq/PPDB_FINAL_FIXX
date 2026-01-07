@extends('layouts.dashboard')
@section('title', 'Seleksi Penerimaan')
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Seleksi Penerimaan</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Seleksi Penerimaan Siswa Baru</h2>
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
                        <h5>Daftar Calon Siswa</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Filter & Search -->
                        <form action="{{ route('admin.seleksi') }}" method="GET" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                        <option value="tidak_lulus" {{ request('status') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau nomor telepon..." value="{{ request('search') }}">
                                        <button class="btn btn-primary" type="submit"><i class="feather icon-search"></i> Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Asal Sekolah</th>
                                        <th>Kelengkapan Dokumen</th>
                                        <th>Status Seleksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($biodatas as $key => $biodata)
                                        <tr>
                                            <td>{{ $biodatas->firstItem() + $key }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-0">{{ $biodata->nama_lengkap }}</h6>
                                                        <small class="text-muted">{{ $biodata->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $biodata->asal_sekolah ?? '-' }}</td>
                                            <td>
                                                @php
                                                    $totalDocs = $biodata->user->dokumens->count();
                                                    $approvedDocs = $biodata->user->dokumens->where('status_verifikasi', 'disetujui')->count();
                                                    // Asumsi 6 dokumen wajib
                                                    $percentage = min(round(($approvedDocs / 6) * 100), 100);
                                                @endphp
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                        <div class="progress-bar bg-{{ $percentage == 100 ? 'success' : 'warning' }}" role="progressbar" style="width: {{ $percentage }}%"></div>
                                                    </div>
                                                    <span class="text-muted small">{{ $approvedDocs }}/6</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($biodata->status_seleksi == 'lulus')
                                                    <span class="badge bg-success">LULUS</span>
                                                @elseif ($biodata->status_seleksi == 'tidak_lulus')
                                                    <span class="badge bg-danger">TIDAK LULUS</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">PENDING</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $biodata->id }}">
                                                    <i class="feather icon-edit"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Update Status -->
                                        <div class="modal fade" id="updateStatusModal{{ $biodata->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Status Seleksi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.seleksi.update', $biodata->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <p>Update status seleksi untuk calon siswa <strong>{{ $biodata->nama_lengkap }}</strong>?</p>
                                                            <div class="mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select name="status_seleksi" class="form-select">
                                                                    <option value="pending" {{ $biodata->status_seleksi == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                    <option value="lulus" {{ $biodata->status_seleksi == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                                                    <option value="tidak_lulus" {{ $biodata->status_seleksi == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $biodatas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection
