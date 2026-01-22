@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Profil Saya</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Profil Pengguna</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1"
                                    role="tab" aria-selected="true">
                                    <i class="ti ti-user me-2"></i>Profil
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab"
                                    aria-selected="false">
                                    <i class="ti ti-file-text me-2"></i>Data Pribadi
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Tab 1: Profil Singkat -->
                            <div class="tab-pane active show" id="profile-1" role="tabpanel"
                                aria-labelledby="profile-tab-1">
                                <div class="row">
                                    <div class="col-lg-4 col-xxl-3 text-center">
                                        <div class="card-body">
                                            <div class="chat-avtar d-inline-flex mx-auto">
                                                <img class="rounded-circle img-fluid wid-70"
                                                    src="{{ asset('assets/images/user/avatar-1.jpg') }}" alt="User image">
                                            </div>
                                            <h5 class="mb-0 mt-3">{{ auth()->user()->name }}</h5>
                                            <p class="text-muted text-sm">{{ auth()->user()->email }}</p>
                                            <hr class="my-3">
                                            <div class="d-inline-block">
                                                <span
                                                    class="badge bg-light-primary">{{ ucfirst(auth()->user()->role) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-xxl-9">
                                        <div class="card-body">
                                            <h5 class="mb-3">Detail Akun</h5>
                                            <div class="row mb-2">
                                                <div class="col-md-4 font-weight-bold">Nama Lengkap</div>
                                                <div class="col-md-8">{{ auth()->user()->name }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4 font-weight-bold">Email</div>
                                                <div class="col-md-8">{{ auth()->user()->email }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4 font-weight-bold">Bergabung Sejak</div>
                                                <div class="col-md-8">
                                                    {{ optional(auth()->user()->created_at)->format('d F Y') ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab 2: Data Pribadi (Biodata) -->
                            <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-body">
                                            <h5 class="mb-4">Informasi Biodata</h5>
                                            @php
                                                $biodata = auth()->user()->biodata;
                                            @endphp

                                            @if ($biodata)
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">NISN</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">{{ $biodata->nisn }}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">Nama Lengkap</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">{{ $biodata->nama_lengkap }}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">Jurusan</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">
                                                            {{ optional($biodata->jurusan)->nama ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">Kelas</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">
                                                            @if ($biodata->kelas)
                                                                <span
                                                                    class="badge bg-success">{{ $biodata->kelas->nama_kelas }}</span>
                                                            @else
                                                                <span class="text-muted fst-italic">Belum ditentukan</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">Jenis Kelamin</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">
                                                            {{ $biodata->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">Tempat, Tanggal
                                                        Lahir</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">{{ $biodata->tempat_lahir }},
                                                            {{ $biodata->tanggal_lahir ? \Carbon\Carbon::parse($biodata->tanggal_lahir)->format('d F Y') : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">Alamat</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">{{ $biodata->alamat }}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">Asal Sekolah</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">
                                                            {{ $biodata->asal_sekolah ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">No. Telepon</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">{{ $biodata->nomor_telepon }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <h5 class="mb-3 mt-4">Data Keluarga</h5>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label fw-bold">Status Orang Tua</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-plaintext">
                                                            {{ $biodata->status_orang_tua ?? '-' }}</p>
                                                    </div>
                                                </div>

                                                @if ($biodata->status_orang_tua == 'Lengkap' || $biodata->status_orang_tua == 'Piatu')
                                                    <!-- Data Ayah -->
                                                    <h6 class="text-secondary mt-3 mb-2">Data Ayah</h6>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">Nama Ayah</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->nama_ayah ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">NIK Ayah</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->nik_ayah ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">Pekerjaan</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->pekerjaan_ayah ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">No. HP Ayah</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->no_hp_ayah ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($biodata->status_orang_tua == 'Lengkap' || $biodata->status_orang_tua == 'Yatim')
                                                    <!-- Data Ibu -->
                                                    <h6 class="text-secondary mt-3 mb-2">Data Ibu</h6>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">Nama Ibu</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->nama_ibu ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">NIK Ibu</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->nik_ibu ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">Pekerjaan</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->pekerjaan_ibu ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">No. HP Ibu</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->no_hp_ibu ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($biodata->status_orang_tua == 'Yatim Piatu')
                                                    <!-- Data Wali -->
                                                    <h6 class="text-secondary mt-3 mb-2">Data Wali</h6>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">Nama Wali</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->nama_wali ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">NIK Wali</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->nik_wali ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">Hubungan</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                Data Wali Pengganti Orang Tua</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">Pekerjaan</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->pekerjaan_wali ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label class="col-md-3 col-form-label fw-bold">No. HP Wali</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-plaintext">
                                                                {{ $biodata->no_hp_wali ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="alert alert-warning" role="alert">
                                                    Anda belum mengisi biodata. Silakan isi biodata terlebih dahulu di menu
                                                    <a href="{{ route('user.biodata') }}" class="alert-link">Biodata</a>.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- 
                                                    <hr class="my-3">
                                                    <div
                                                        class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                                        <i class="ti ti-mail"></i>
                                                        <p class="mb-0">anshan@gmail.com</p>
                                                                <div class="text-muted d-inline-block me-2">
                                                                    <i class="fas fa-circle f-8 me-2"></i>
                                                                    Aktif 1 bulan lalu
                                                        <i class="ti ti-phone"></i>
                                                        <p class="mb-0">(+1-876) 8654 239 581</p>
                                                    </div>
                                                    <div
                                                        class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                                        <i class="ti ti-map-pin"></i>
                                                        <p class="mb-0">New York</p>
                                                    </div>
                                                    <div
                                                        class="d-inline-flex align-items-center justify-content-between w-100">
                                                        <i class="ti ti-link"></i>
                                                        <a href="#" class="link-primary">
                                                            <p class="mb-0">https://anshan.dh.url</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Keahlian</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                                        <p class="mb-0">Pemula</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 me-3">
                                                                <div class="progress progress-primary"
                                                                    style="height: 6px;">
                                                                    <div class="progress-bar" style="width: 30%;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <p class="mb-0 text-muted">30%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                                        <p class="mb-0">Peneliti UX</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 me-3">
                                                                <div class="progress progress-primary"
                                                                    style="height: 6px;">
                                                                    <div class="progress-bar" style="width: 80%;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <p class="mb-0 text-muted">80%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                                        <p class="mb-0">WordPress</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 me-3">
                                                                <div class="progress progress-primary"
                                                                    style="height: 6px;">
                                                                    <div class="progress-bar" style="width: 90%;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <p class="mb-0 text-muted">90%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                                        <p class="mb-0">HTML</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 me-3">
                                                                <div class="progress progress-primary"
                                                                    style="height: 6px;">
                                                                    <div class="progress-bar" style="width: 30%;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <p class="mb-0 text-muted">30%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                                        <p class="mb-0">Desain Grafis</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 me-3">
                                                                <div class="progress progress-primary"
                                                                    style="height: 6px;">
                                                                    <div class="progress-bar" style="width: 95%;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <p class="mb-0 text-muted">95%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                                        <p class="mb-0">Gaya Kode</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 me-3">
                                                                <div class="progress progress-primary"
                                                                    style="height: 6px;">
                                                                    <div class="progress-bar" style="width: 75%;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <p class="mb-0 text-muted">75%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-xxl-9">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Tentang Saya</h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0">Halo, saya Anshan Handgun, seorang desainer grafis kreatif
                                                    dan perancang pengalaman pengguna. Saya berfokus membuat produk digital
                                                    yang lebih indah dan mudah digunakan. Saya percaya kolaborasi yang baik
                                                    dan riset mendalam adalah kunci menghadirkan solusi terbaik.</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Detail Pribadi</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 pt-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Nama Lengkap</p>
                                                                <p class="mb-0">Anshan Handgun</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Nama Ayah</p>
                                                                <p class="mb-0">Deepen Handgun</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Nomor Telepon</p>
                                                                <p class="mb-0">(+1-876) 8654 239 581</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Kota</p>
                                                                <p class="mb-0">New York</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Email</p>
                                                                <p class="mb-0">anshan.dh81@gmail.com</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Kode Pos</p>
                                                                <p class="mb-0">956 754</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0 pb-0">
                                                        <p class="mb-1 text-muted">Alamat</p>
                                                        <p class="mb-0">Street 110-B Kalians Bag, Dewan, M.P. New York
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Pendidikan</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 pt-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Magister (Tahun)</p>
                                                                <p class="mb-0">2014-2017</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Institusi</p>
                                                                <p class="mb-0">-</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Sarjana (Tahun)</p>
                                                                <p class="mb-0">2011-2013</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Institusi</p>
                                                                <p class="mb-0">Imperial College London</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0 pb-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Sekolah (Tahun)</p>
                                                                <p class="mb-0">2009-2011</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Institusi</p>
                                                                <p class="mb-0">School of London, England</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Pengalaman Kerja</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 pt-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Senior</p>
                                                                <p class="mb-0">Senior UI/UX designer (Tahun)</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Tanggung Jawab</p>
                                                                <p class="mb-0">Menangani tugas terkait manajemen proyek
                                                                    bersama lebih dari 100 anggota tim di bawah
                                                                    koordinasi saya. Pengelolaan tim menjadi peran utama
                                                                    di perusahaan ini.</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Trainee sekaligus Project Manager
                                                                    (Tahun)</p>
                                                                <p class="mb-0">2017-2019</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Tanggung Jawab</p>
                                                                <p class="mb-0">Pengelolaan tim menjadi tanggung jawab
                                                                    utama pada posisi ini.</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0 pb-0">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Sekolah (Tahun)</p>
                                                                <p class="mb-0">2009-2011</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-1 text-muted">Institusi</p>
                                                                <p class="mb-0">School of London, England</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Informasi Pribadi</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center mb-3">
                                                        <div class="user-upload wid-75">
                                                            <img src="../assets/images/user/avatar-4.jpg" alt="img"
                                                                class="img-fluid">
                                                            <label for="uplfile" class="img-avtar-upload">
                                                                <i class="ti ti-camera f-24 mb-1"></i>
                                                                <span>Unggah</span>
                                                            </label>
                                                            <input type="file" id="uplfile" class="d-none">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Nama Depan</label>
                                                            <input type="text" class="form-control" value="Anshan">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Nama Belakang</label>
                                                            <input type="text" class="form-control" value="Handgun">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Negara</label>
                                                            <input type="text" class="form-control" value="New York">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Kode Pos</label>
                                                            <input type="text" class="form-control" value="956754">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Bio</label>
                                                            <textarea class="form-control">Halo, saya Anshan Handgun seorang desainer grafis kreatif dan perancang pengalaman pengguna. Saya senang mengubah ide menjadi antarmuka digital yang ramah dan efektif.</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Pengalaman</label>
                                                            <select class="form-control">
                                                                <option>Baru Mulai</option>
                                                                <option>2 tahun</option>
                                                                <option>3 tahun</option>
                                                                <option selected="">4 tahun</option>
                                                                <option>5 tahun</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Jejaring Sosial</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="flex-grow-1 me-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <div class="avtar avtar-xs btn-light-twitter">
                                                                    <i class="fab fa-twitter f-16"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-0">Twitter</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <button class="btn btn-link-danger">Hubungkan</button>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="flex-grow-1 me-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <div class="avtar avtar-xs btn-light-facebook">
                                                                    <i class="fab fa-facebook-f f-16"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-0">Facebook</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="text-facebook">Anshan Handgun</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 me-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <div class="avtar avtar-xs btn-light-linkedin">
                                                                    <i class="fab fa-linkedin-in f-16"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-0">Linkedin</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <button class="btn btn-link-danger">Hubungkan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Kontak</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Nomor Kontak</label>
                                                            <input type="text" class="form-control"
                                                                value="(+99) 9999 999 999">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                value="demo@sample.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">URL Portofolio</label>
                                                            <input type="text" class="form-control"
                                                                value="https://demo.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Alamat</label>
                                                            <textarea class="form-control">3379  Monroe Avenue, Fort Myers, Florida(33912)</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-end btn-page">
                                        <div class="btn btn-outline-secondary">Batal</div>
                                        <div class="btn btn-primary">Perbarui Profil</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Pengaturan Umum</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Nama Pengguna <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                value="Ashoka_Tano_16">
                                                            <small class="form-text text-muted">URL Profil Anda:
                                                                https://pc.com/Ashoka_Tano_16</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email Akun <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                value="demo@sample.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Bahasa</label>
                                                            <select class="form-control">
                                                                <option>Bahasa Indonesia</option>
                                                                <option>Bahasa Inggris</option>
                                                                <option>Bahasa Melayu</option>
                                                                <option>Bahasa India</option>
                                                                <option>Bahasa Jepang</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Metode Masuk</label>
                                                            <select class="form-control">
                                                                <option>Kata Sandi</option>
                                                                <option>Pengenalan Wajah</option>
                                                                <option>Sidik Jari</option>
                                                                <option>Kunci Fisik</option>
                                                                <option>PIN</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Pengaturan Lanjutan</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 pt-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <p class="mb-1">Penjelajahan Aman</p>
                                                                <p class="text-muted text-sm mb-0">Aktifkan koneksi aman (https) ketika diperlukan</p>
                                                            </div>
                                                            <div class="form-check form-switch p-0">
                                                                <input class="form-check-input h4 position-relative m-0"
                                                                    type="checkbox" role="switch" checked="">
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <p class="mb-1">Notifikasi Masuk</p>
                                                                <p class="text-muted text-sm mb-0">Beritahu saat ada percobaan masuk dari lokasi lain</p>
                                                            </div>
                                                            <div class="form-check form-switch p-0">
                                                                <input class="form-check-input h4 position-relative m-0"
                                                                    type="checkbox" role="switch" checked="">
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0 pb-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <p class="mb-1">Persetujuan Masuk</p>
                                                                <p class="text-muted text-sm mb-0">Tidak diperlukan persetujuan saat masuk dari perangkat yang dikenali.</p>
                                                            </div>
                                                            <div class="form-check form-switch p-0">
                                                                <input class="form-check-input h4 position-relative m-0"
                                                                    type="checkbox" role="switch" checked="">
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Perangkat Terdaftar</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 pt-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="me-2">
                                                                <p class="mb-2">Celt Desktop</p>
                                                                <p class="mb-0 text-muted">4351 Deans Lane</p>
                                                            </div>
                                                            <div class="">
                                                                <div class="text-success d-inline-block me-2">
                                                                    <i class="fas fa-circle f-8 me-2"></i>
                                                                    Aktif Saat Ini
                                                                </div>
                                                                <a href="#!" class="text-danger"><i
                                                                        class="feather icon-x-circle"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="me-2">
                                                                <p class="mb-2">Imco Tablet</p>
                                                                <p class="mb-0 text-muted">4185 Michigan Avenue</p>
                                                            </div>
                                                            <div class="">
                                                                <div class="text-muted d-inline-block me-2">
                                                                    <i class="fas fa-circle f-8 me-2"></i>
                                                                    Aktif 5 hari lalu
                                                                </div>
                                                                <a href="#!" class="text-danger"><i
                                                                        class="feather icon-x-circle"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0 pb-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="me-2">
                                                                <p class="mb-2">Albs Mobile</p>
                                                                <p class="mb-0 text-muted">3462 Fairfax Drive</p>
                                                            </div>
                                                            <div class="">
                                                                <div class="text-muted d-inline-block me-2">
                                                                    <i class="fas fa-circle f-8 me-2"></i>
                                                                    Aktif 1 bulan lalu
                                                                </div>
                                                                <a href="#!" class="text-danger"><i
                                                                        class="feather icon-x-circle"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Sesi Aktif</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item px-0 pt-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="me-2">
                                                                <p class="mb-2">Celt Desktop</p>
                                                                <p class="mb-0 text-muted">4351 Deans Lane</p>
                                                            </div>
                                                            <button class="btn btn-link-danger">Keluar</button>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item px-0 pb-0">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="me-2">
                                                                <p class="mb-2">Moon Tablet</p>
                                                                <p class="mb-0 text-muted">4185 Michigan Avenue</p>
                                                            </div>
                                                            <button class="btn btn-link-danger">Keluar</button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button class="btn btn-outline-dark ms-2">Bersihkan</button>
                                        <button class="btn btn-primary">Perbarui Profil</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Ubah Kata Sandi</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Kata Sandi Lama</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Kata Sandi Baru</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Konfirmasi Kata Sandi</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <h5>Kata sandi baru harus berisi:</h5>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><i class="ti ti-minus me-2"></i> Minimal 8 karakter</li>
                                                    <li class="list-group-item"><i class="ti ti-minus me-2"></i> Minimal 1 huruf kecil (a-z)
                                                    </li>
                                                    <li class="list-group-item"><i class="ti ti-minus me-2"></i> Minimal 1 huruf besar (A-Z)</li>
                                                    <li class="list-group-item"><i class="ti ti-minus me-2"></i> Minimal 1 angka (0-9)</li>
                                                    <li class="list-group-item"><i class="ti ti-minus me-2"></i> Minimal 1 karakter khusus</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end btn-page">
                                            <div class="btn btn-outline-secondary">Batal</div>
                                            <div class="btn btn-primary">Perbarui Profil</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Undang Anggota Tim</h5>
                                    </div>
                                    <div class="card-body">
                                            <h4>5/10 <small>anggota masih tersedia dalam paket Anda.</small></h4>
                                        <hr class="my-3">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                        <label class="form-label">Alamat Email</label>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="email" class="form-control">
                                                        </div>
                                                        <div class="col-auto">
                                                                <button class="btn btn-primary">Kirim</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-card">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ANGGOTA</th>
                                                        <th>PERAN</th>
                                                        <th class="text-end">STATUS</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-auto pe-0">
                                                                    <img src="../assets/images/user/avatar-1.jpg"
                                                                        alt="user-image" class="wid-40 rounded-circle">
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="mb-0">Addie Bass</h5>
                                                                    <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-primary">Pemilik</span></td>
                                                        <td class="text-end"><span class="badge bg-success">Bergabung</span>
                                                        </td>
                                                        <td class="text-end"><a href="#"
                                                                class="avtar avtar-s btn-link-secondary"><i
                                                                    class="ti ti-dots f-18"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-auto pe-0">
                                                                    <img src="../assets/images/user/avatar-4.jpg"
                                                                        alt="user-image" class="wid-40 rounded-circle">
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="mb-0">Agnes McGee</h5>
                                                                    <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-light-info">Manajer</span></td>
                                                        <td class="text-end"><a href="#"
                                                            class="btn btn-link-danger">Kirim Ulang</a> <span
                                                            class="badge bg-light-success">Diundang</span></td>
                                                        <td class="text-end"><a href="#"
                                                                class="avtar avtar-s btn-link-secondary"><i
                                                                    class="ti ti-dots f-18"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-auto pe-0">
                                                                    <img src="../assets/images/user/avatar-5.jpg"
                                                                        alt="user-image" class="wid-40 rounded  -circle">
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="mb-0">Agnes McGee</h5>
                                                                    <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-light-warning">Staf</span></td>
                                                        <td class="text-end"><span class="badge bg-success">Bergabung</span>
                                                        </td>
                                                        <td class="text-end"><a href="#"
                                                                class="avtar avtar-s btn-link-secondary"><i
                                                                    class="ti ti-dots f-18"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-auto pe-0">
                                                                    <img src="../assets/images/user/avatar-1.jpg"
                                                                        alt="user-image" class="wid-40 rounded-circle">
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="mb-0">Addie Bass</h5>
                                                                    <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-primary">Pemilik</span></td>
                                                        <td class="text-end"><span class="badge bg-success">Bergabung</span>
                                                        </td>
                                                        <td class="text-end"><a href="#"
                                                                class="avtar avtar-s btn-link-secondary"><i
                                                                    class="ti ti-dots f-18"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-auto pe-0">
                                                                    <img src="../assets/images/user/avatar-4.jpg"
                                                                        alt="user-image" class="wid-40 rounded-circle">
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="mb-0">Agnes McGee</h5>
                                                                    <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-light-info">Manajer</span></td>
                                                        <td class="text-end"><a href="#"
                                                            class="btn btn-link-danger">Kirim Ulang</a> <span
                                                            class="badge bg-light-success">Diundang</span></td>
                                                        <td class="text-end"><a href="#"
                                                                class="avtar avtar-s btn-link-secondary"><i
                                                                    class="ti ti-dots f-18"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-auto pe-0">
                                                                    <img src="../assets/images/user/avatar-5.jpg"
                                                                        alt="user-image" class="wid-40 rounded-circle">
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="mb-0">Agnes McGee</h5>
                                                                    <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-light-warning">Staf</span></td>
                                                        <td class="text-end"><span class="badge bg-success">Bergabung</span>
                                                        </td>
                                                        <td class="text-end"><a href="#"
                                                                class="avtar avtar-s btn-link-secondary"><i
                                                                    class="ti ti-dots f-18"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-auto pe-0">
                                                                    <img src="../assets/images/user/avatar-1.jpg"
                                                                        alt="user-image" class="wid-40 rounded-circle">
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="mb-0">Addie Bass</h5>
                                                                    <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-primary">Pemilik</span></td>
                                                        <td class="text-end"><span class="badge bg-success">Bergabung</span>
                                                        </td>
                                                        <td class="text-end"><a href="#"
                                                                class="avtar avtar-s btn-link-secondary"><i
                                                                    class="ti ti-dots f-18"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-auto pe-0">
                                                                    <img src="../assets/images/user/avatar-4.jpg"
                                                                        alt="user-image" class="wid-40 rounded-circle">
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="mb-0">Agnes McGee</h5>
                                                                    <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-light-info">Manajer</span></td>
                                                        <td class="text-end"><a href="#"
                                                            class="btn btn-link-danger">Kirim Ulang</a> <span
                                                            class="badge bg-light-success">Diundang</span></td>
                                                        <td class="text-end"><a href="#"
                                                                class="avtar avtar-s btn-link-secondary"><i
                                                                    class="ti ti-dots f-18"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-auto pe-0">
                                                                    <img src="../assets/images/user/avatar-5.jpg"
                                                                        alt="user-image" class="wid-40 rounded-circle">
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="mb-0">Agnes McGee</h5>
                                                                    <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-light-warning">Staf</span></td>
                                                        <td class="text-end"><span class="badge bg-success">Bergabung</span>
                                                        </td>
                                                        <td class="text-end"><a href="#"
                                                                class="avtar avtar-s btn-link-secondary"><i
                                                                    class="ti ti-dots f-18"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end btn-page">
                                        <div class="btn btn-link-danger">Batalkan</div>
                                        <div class="btn btn-primary">Perbarui Profil</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile-6" role="tabpanel" aria-labelledby="profile-tab-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Pengaturan Email</h5>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="mb-4">Atur Notifikasi Email</h6>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Notifikasi Email</p>
                                                    </div>
                                                    <div class="form-check form-switch p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch" checked="">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Kirim Salinan ke Email Pribadi</p>
                                                    </div>
                                                    <div class="form-check form-switch p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Pembaruan dari Sistem</h5>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="mb-4">Email apa yang ingin Anda terima?</h6>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Berita produk dan pembaruan fitur PCT-themes</p>
                                                    </div>
                                                    <div class="form-check p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch" checked="">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Tips memaksimalkan penggunaan PCT-themes
                                                        </p>
                                                    </div>
                                                    <div class="form-check p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch" checked="">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Ringkasan hal yang terlewat sejak terakhir masuk ke PCT-themes</p>
                                                    </div>
                                                    <div class="form-check  p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Berita produk dan layanan lainnya
                                                        </p>
                                                    </div>
                                                    <div class="form-check p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Tips dan dokumentasi produk bisnis</p>
                                                    </div>
                                                    <div class="form-check p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Email Terkait Aktivitas</h5>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="mb-4">Kapan kami mengirim email?</h6>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Ada notifikasi baru</p>
                                                    </div>
                                                    <div class="form-check form-switch p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch" checked="">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Saat Anda menerima pesan langsung</p>
                                                    </div>
                                                    <div class="form-check form-switch p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Saat seseorang menambahkan Anda sebagai koneksi</p>
                                                    </div>
                                                    <div class="form-check form-switch p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch" checked="">
                                                    </div>
                                                </div>
                                                <hr class="my-4">
                                                <h6 class="mb-4">Kapan email diprioritaskan?</h6>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Ketika ada pesanan baru</p>
                                                    </div>
                                                    <div class="form-check form-switch p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch" checked="">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Persetujuan keanggotaan baru</p>
                                                    </div>
                                                    <div class="form-check form-switch p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div>
                                                        <p class="text-muted mb-0">Pendaftaran anggota</p>
                                                    </div>
                                                    <div class="form-check form-switch p-0">
                                                        <input class="m-0 form-check-input h5 position-relative"
                                                            type="checkbox" role="switch" checked="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-end btn-page">
                                        <div class="btn btn-outline-secondary">Batal</div>
                                        <div class="btn btn-primary">Perbarui Profil</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
--}}
