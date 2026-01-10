@extends('layouts.dashboard')
@section('title', 'Pilih Jurusan')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Pilih Jurusan</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Pilih Jurusan</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (!$isVerified)
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading"><i class="feather icon-alert-triangle"></i> Akun Belum Terverifikasi</h4>
                        <p>Silakan verifikasi email Anda terlebih dahulu untuk dapat memilih jurusan.</p>
                        <hr>
                        <p class="mb-0"><a href="{{ route('dashboard') }}" class="alert-link">Klik di sini untuk mengirim
                                ulang email verifikasi</a> (jika tersedia di Dashboard).</p>
                    </div>
                @endif

                @if (!$hasBiodata)
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading"><i class="feather icon-file-text"></i> Biodata Belum Lengkap</h4>
                        <p>Anda belum mengisi biodata diri. Mohon lengkapi biodata Anda terlebih dahulu sebelum memilih
                            jurusan.</p>
                        <hr>
                        <p class="mb-0"><a href="{{ route('user.biodata') }}" class="alert-link">Isi Biodata Sekarang</a>
                        </p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Jurusan Tersedia</h5>
                        <p class="text-muted mb-0">Silakan pilih salah satu jurusan yang Anda minati.</p>
                    </div>
                    <div class="card-body">
                        <form id="jurusanForm" action="{{ route('user.jurusan.store') }}" method="POST">
                            @csrf
                            <fieldset {{ !$isVerified || !$hasBiodata ? 'disabled' : '' }}>
                                <div class="row">
                                    @forelse($jurusans as $jurusan)
                                        <div class="col-md-6 col-xl-4 mb-4">
                                            <div
                                                class="card h-100 border {{ $selectedJurusanId == $jurusan->id ? 'border-primary bg-light-primary' : '' }}">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                                        <h5 class="card-title">{{ $jurusan->nama }}</h5>
                                                        @if ($selectedJurusanId == $jurusan->id)
                                                            <div class="d-flex flex-column align-items-end">
                                                                <span class="badge bg-primary mb-1">Dipilih</span>
                                                                @if (isset($biodata) && $biodata->kelas)
                                                                    <span class="badge bg-success">Kelas:
                                                                        {{ $biodata->kelas->nama_kelas }}</span>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{ $jurusan->kode }}</h6>
                                                    <p class="card-text">{{ $jurusan->deskripsi }}</p>

                                                    <div class="mt-3 mb-3">
                                                        <h6 class="mb-2">Biaya Pendidikan:</h6>
                                                        <ul class="list-group list-group-flush small">
                                                            @if (isset($userGelombang))
                                                                @php
                                                                    $price = 0;
                                                                    if (stripos($userGelombang->nama, '1') !== false) {
                                                                        $price = $jurusan->harga_gelombang_1;
                                                                    } elseif (
                                                                        stripos($userGelombang->nama, '2') !== false
                                                                    ) {
                                                                        $price = $jurusan->harga_gelombang_2;
                                                                    } else {
                                                                        // Default fallback
                                                                        $price = $jurusan->harga_gelombang_1;
                                                                    }
                                                                @endphp
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between align-items-center px-0 py-1 bg-transparent">
                                                                    <span>{{ $userGelombang->nama }} <span
                                                                            class="badge bg-success ms-1"
                                                                            style="font-size: 0.7em;">User
                                                                            Area</span></span>
                                                                    <span class="fw-bold text-primary">Rp
                                                                        {{ number_format($price, 0, ',', '.') }}</span>
                                                                </li>
                                                            @else
                                                                {{-- Fallback original view if no wave determined --}}
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between align-items-center px-0 py-1 bg-transparent">
                                                                    Gelombang 1
                                                                    <span class="fw-bold text-primary">Rp
                                                                        {{ number_format($jurusan->harga_gelombang_1, 0, ',', '.') }}</span>
                                                                </li>
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between align-items-center px-0 py-1 bg-transparent">
                                                                    Gelombang 2
                                                                    <span class="fw-bold text-danger">Rp
                                                                        {{ number_format($jurusan->harga_gelombang_2, 0, ',', '.') }}</span>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>

                                                    <div class="mt-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="jurusan_id"
                                                                id="jurusan_{{ $jurusan->id }}"
                                                                value="{{ $jurusan->id }}"
                                                                {{ $selectedJurusanId == $jurusan->id ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="jurusan_{{ $jurusan->id }}">
                                                                Pilih Jurusan Ini
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer bg-transparent border-top-0">
                                                    <small class="text-muted">Kuota: {{ $jurusan->kuota }} Siswa</small>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">Belum ada data jurusan.</div>
                                        </div>
                                    @endforelse
                                </div>
                            </fieldset>
                        </form>

                        @if ($jurusans->count() > 0)
                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    @if ($selectedJurusanId)
                                        @if (isset($hasPayment) && $hasPayment)
                                            <div class="d-inline-block me-2">
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                                    title="Anda sudah melakukan pembayaran, tidak dapat membatalkan jurusan.">
                                                    <button type="button" class="btn btn-danger" disabled>
                                                        <i class="feather icon-x me-2"></i> Batalkan Pilihan
                                                    </button>
                                                </span>
                                            </div>
                                        @else
                                            <form id="cancelJurusanForm" action="{{ route('user.jurusan.cancel') }}"
                                                method="POST" style="display: inline-block; margin-right: 10px;">
                                                @csrf
                                                <fieldset {{ !$isVerified || !$hasBiodata ? 'disabled' : '' }}>
                                                    <button type="button" class="btn btn-danger" id="btnCancelJurusan">
                                                        <i class="feather icon-x me-2"></i> Batalkan Pilihan
                                                    </button>
                                                </fieldset>
                                            </form>
                                        @endif
                                    @endif
                                    <button type="submit" form="jurusanForm" class="btn btn-primary"
                                        {{ !$isVerified || !$hasBiodata ? 'disabled' : '' }}>
                                        <i class="feather icon-check me-2"></i> Simpan Pilihan
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnCancel = document.getElementById('btnCancelJurusan');
            if (btnCancel) {
                btnCancel.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Batalkan Pilihan Jurusan?',
                        text: "Anda akan kehilangan kuota pada jurusan yang sudah dipilih sebelumnya.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Batalkan!',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('cancelJurusanForm').submit();
                        }
                    });
                });
            }
        });
    </script>
@endsection
