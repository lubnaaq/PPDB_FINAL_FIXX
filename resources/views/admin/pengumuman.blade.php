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
    </style>
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
                                            <td>{{ $student->user->dokumens->where('nama_dokumen', 'NISN')->first()->catatan_verifikasi ?? '-' }}</td> <!-- Placeholder for NISN value if not in biodata -->
                                            <td>-</td>
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
    </div>
@endsection
