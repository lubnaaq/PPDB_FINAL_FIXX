@extends('layouts.dashboard')
@section('title', 'Data Semua Pendaftar')
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
    </style>
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Data Pendaftar</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Data Semua Pendaftar</h2>
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
                        <h5>Daftar Semua User Terdaftar</h5>
                    </div>
                    <div class="card-body">
                        <!-- Search -->
                        <form action="{{ route('admin.pendaftar') }}" method="GET" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari nama atau email..." value="{{ request('search') }}">
                                        <button class="btn btn-primary" type="submit"><i class="feather icon-search"></i>
                                            Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User Info</th>
                                        <th>Kelas</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status Biodata</th>
                                        <th>Dokumen</th>
                                        <th>Pembayaran</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $key => $user)
                                        <tr>
                                            <td>{{ $users->firstItem() + $key }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <!-- Avatar if needed -->
                                                    <div>
                                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                                        <small class="text-muted">{{ $user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($user->biodata && $user->biodata->kelas)
                                                    <span
                                                        class="badge bg-info">{{ $user->biodata->kelas->nama_kelas }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at ? $user->created_at->format('d M Y H:i') : '-' }}</td>
                                            <td>
                                                @if ($user->biodata)
                                                    <span class="badge bg-success">Sudah Isi</span>
                                                @else
                                                    <span class="badge bg-danger">Belum Isi</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->dokumens->count() > 0)
                                                    <span class="badge bg-success">{{ $user->dokumens->count() }} File
                                                        Uploaded</span>
                                                @else
                                                    <span class="badge bg-danger">Belum Upload</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $payment = $user->payments->sortByDesc('created_at')->first();
                                                @endphp
                                                @if ($payment)
                                                    @if ($payment->status == 'verified')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @elseif($payment->status == 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">Belum Bayar</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->biodata)
                                                    <!-- Could link to detail view if exists, e.g. details of biodata -->
                                                    <span class="text-muted">-</span>
                                                @else
                                                    <span class="text-muted text-small">Incomplete</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data pendaftar.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
