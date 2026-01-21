@extends('layouts.dashboard')
@section('title', 'Isi Biodata')
@section('content')
    <div class="pc-content">
        @if ($is_verified_user)
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Isi Biodata</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Isi Biodata</h2>
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
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h5>Form Biodata Diri</h5>
                            <p class="text-muted mb-0">Silakan lengkapi data diri Anda dengan benar</p>
                        </div>
                        <div class="card-body">
                            <div class="print-container">
                                <!-- Print Header (Only visible when printing) -->
                                <div class="print-header">
                                    <table style="width: 100%; border: none;">
                                        <tr style="border: none;">
                                            <td style="width: 80px; border: none; vertical-align: top;">
                                                <img src="https://smkantartika1sda.sch.id/wp-content/uploads/2025/05/cropped-ANT-LG.png"
                                                    alt="Logo" style="width: 80px; height: auto;">
                                            </td>
                                            <td style="border: none; text-align: center; padding-left: 20px;">
                                                <h2 style="margin: 0; font-size: 18pt; font-weight: bold;">SMK ANTARTIKA 1
                                                    SIDOARJO</h2>
                                                <h3 style="margin: 5px 0; font-size: 10pt; font-weight: bold;">TANDA TERIMA
                                                    PENDAFTARAN PESERTA DIDIK BARU</h3>
                                                <p style="margin: 2px 0; font-size: 8pt;">Jl. Siwalan Panji, Bedrek,
                                                    Siwalanpanji, Kec. Sidoarjo, Kab. Sidoarjo, Jawa Timur 61252</p>
                                                <p style="margin: 2px 0; font-size: 8pt;">Telp: (031) 8962851 | Email:
                                                    info@smkantartika1.sch.id | Website: www.smkantartika1.sch.id</p>
                                            </td>
                                            <td style="width: 80px; border: none;"></td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Print Info (Only visible when printing) -->
                                <div class="print-info">
                                    <h3
                                        style="text-align: center; margin: 20px 0 30px 0; font-size: 16pt; font-weight: bold; text-decoration: underline;">
                                        BUKTI PENDAFTARAN
                                    </h3>

                                    <table style="border: none; width: auto; margin: 0 auto 20px auto;">
                                        <tr style="border: none;">
                                            <td style="width: 150px; border: none; padding: 3px 0;">Nomor Pendaftaran</td>
                                            <td style="width: 20px; border: none; padding: 3px 0;">:</td>
                                            <td style="border: none; padding: 3px 0; font-weight: bold; font-size: 12pt;">
                                                {{ str_pad(Auth::user()->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        </tr>
                                        <tr style="border: none;">
                                            <td style="width: 150px; border: none; padding: 3px 0;">Tanggal Daftar</td>
                                            <td style="width: 20px; border: none; padding: 3px 0;">:</td>
                                            <td style="border: none; padding: 3px 0;">
                                                {{ \Carbon\Carbon::parse(Auth::user()->created_at)->translatedFormat('d F Y') }}
                                            </td>
                                        </tr>
                                    </table>

                                    <p
                                        style="margin: 20px 0 10px 0; text-align: justify; font-size: 11pt; line-height: 1.6;">
                                        Telah diterima data pendaftaran Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran
                                        {{ date('Y') }}/{{ date('Y') + 1 }} dari calon siswa:
                                    </p>

                                    <table style="border: none; width: 100%; margin: 10px 0 20px 20px;">
                                        <tr style="border: none;">
                                            <td style="width: 200px; border: none; padding: 5px 0;">Nama Lengkap</td>
                                            <td style="width: 20px; border: none; padding: 5px 0;">:</td>
                                            <td style="border: none; padding: 5px 0; font-weight: bold;">
                                                {{ strtoupper(Auth::user()->name) }}</td>
                                        </tr>
                                        <tr style="border: none;">
                                            <td style="border: none; padding: 5px 0;">Jenis Kelamin</td>
                                            <td style="border: none; padding: 5px 0;">:</td>
                                            <td style="border: none; padding: 5px 0;">
                                                @if (optional($biodata)->jenis_kelamin == 'L')
                                                    Laki-laki
                                                @elseif(optional($biodata)->jenis_kelamin == 'P')
                                                    Perempuan
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr style="border: none;">
                                            <td style="border: none; padding: 5px 0;">Tempat, Tanggal Lahir</td>
                                            <td style="border: none; padding: 5px 0;">:</td>
                                            <td style="border: none; padding: 5px 0;">
                                                {{ optional($biodata)->tempat_lahir ?? '-' }},
                                                {{ optional($biodata)->tanggal_lahir ? \Carbon\Carbon::parse($biodata->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                                            </td>
                                        </tr>
                                        <tr style="border: none;">
                                            <td style="border: none; padding: 5px 0;">Asal Sekolah</td>
                                            <td style="border: none; padding: 5px 0;">:</td>
                                            <td style="border: none; padding: 5px 0;">
                                                {{ optional($biodata)->asal_sekolah ?? '-' }}</td>
                                        </tr>
                                        <tr style="border: none;">
                                            <td style="border: none; padding: 5px 0;">Pilihan Jurusan</td>
                                            <td style="border: none; padding: 5px 0;">:</td>
                                            <td style="border: none; padding: 5px 0;">
                                                <strong>{{ optional(optional($biodata)->jurusan)->nama ?? '-' }}</strong>
                                            </td>
                                        </tr>
                                        <tr style="border: none;">
                                            <td style="border: none; padding: 5px 0;">Alamat</td>
                                            <td style="border: none; padding: 5px 0;">:</td>
                                            <td style="border: none; padding: 5px 0;">
                                                {{ optional($biodata)->alamat ?? '-' }}</td>
                                        </tr>
                                    </table>

                                    <div style="border: 2px dashed #000; padding: 15px; margin: 30px 0;">
                                        <p style="margin: 0; font-weight: bold; text-align: center;">CATATAN PENTING:</p>
                                        <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                                            <li>Simpan tanda terima ini sebagai bukti pendaftaran yang sah.</li>
                                            <li>Cek secara berkala status seleksi Anda melalui menu
                                                <strong>Pengumuman</strong> di dashboard.
                                            </li>
                                            <li>Dokumen ini wajib dibawa saat melakukan <strong>Daftar Ulang</strong> jika
                                                dinyatakan Lulus.</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Print Signature Section (Only visible when printing) -->
                                <div class="print-signature">
                                    <table class="signature-table" style="border: none; width: 100%; margin-top: 30px;">
                                        <tr style="border: none;">
                                            <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                                                <p style="margin: 0 0 60px 0; font-weight: bold;">Tanda Tangan Pendaftar
                                                </p>
                                                <p style="margin: 0; font-weight: bold; text-decoration: underline;">
                                                    {{ strtoupper(Auth::user()->name) }}</p>
                                            </td>
                                            <td style="width: 50%; border: none; text-align: center; vertical-align: top;">
                                                <p style="margin: 0; font-size: 11pt;">Sidoarjo,
                                                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                                                <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 11pt;">Panitia
                                                    PPDB</p>

                                                <!-- Signature Space / Image -->
                                                <div
                                                    style="height: 80px; position: relative; display: flex; justify-content: center; align-items: flex-end;">
                                                    <!-- Optional: Panitia Signature -->
                                                </div>

                                                <p
                                                    style="margin: 0; font-weight: bold; text-decoration: underline; font-size: 11pt;">
                                                    Panitia Penerimaan</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Print Footer (Only visible when printing) -->
                                <div class="print-footer">
                                    <p style="margin: 0; font-size: 8pt;">Dokumen ini dicetak secara otomatis dari Sistem
                                        PPDB SMK Antartika 1 Sidoarjo</p>
                                    <p style="margin: 2px 0 0 0; font-size: 8pt;">Dicetak pada:
                                        {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            <div class="screen-only">
                                <form id="biodataForm" action="{{ route('biodata.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <!-- Informasi Pribadi -->
                                    <h6 class="mb-3 text-primary">Informasi Pribadi</h6>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Nama Lengkap <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nama_lengkap" required
                                                    placeholder="Masukkan nama lengkap"
                                                    value="{{ old('nama_lengkap', $biodata->nama_lengkap ?? '') }}"
                                                    {{ !empty($biodata->nama_lengkap) ? 'readonly' : '' }}>
                                                @if (!empty($biodata->nama_lengkap))
                                                    <small class="text-muted d-block mt-1">Nama tidak dapat diubah setelah
                                                        disimpan</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" required
                                                    readonly placeholder="contoh@email.com"
                                                    value="{{ auth()->user()->email }}">
                                                <small class="text-muted d-block mt-1">Email tidak dapat diubah (sesuai
                                                    akun registrasi)</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">No. Telepon/HP <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" name="nomor_telepon" required
                                                    placeholder="Nomor telepon" inputmode="numeric" pattern="[0-9]*"
                                                    maxlength="20"
                                                    value="{{ old('nomor_telepon', $biodata->nomor_telepon ?? '') }}">
                                                <small class="text-muted d-block mt-1">Hanya angka (0-9) yang
                                                    diizinkan</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Jenis Kelamin <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="jenis_kelamin" required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="L"
                                                        {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                                                        Laki-laki</option>
                                                    <option value="P"
                                                        {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Tempat Lahir <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="tempat_lahir" required
                                                    placeholder="Kota kelahiran"
                                                    value="{{ old('tempat_lahir', $biodata->tempat_lahir ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Tanggal Lahir <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="tanggal_lahir" required
                                                    value="{{ old('tanggal_lahir', isset($biodata->tanggal_lahir) && $biodata->tanggal_lahir ? \Illuminate\Support\Carbon::parse($biodata->tanggal_lahir)->format('Y-m-d') : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Agama <span class="text-danger">*</span></label>
                                                <select class="form-select" name="agama" required>
                                                    <option value="">Pilih Agama</option>
                                                    <option value="Islam"
                                                        {{ old('agama', $biodata->agama ?? '') == 'Islam' ? 'selected' : '' }}>
                                                        Islam</option>
                                                    <option value="Kristen"
                                                        {{ old('agama', $biodata->agama ?? '') == 'Kristen' ? 'selected' : '' }}>
                                                        Kristen</option>
                                                    <option value="Katolik"
                                                        {{ old('agama', $biodata->agama ?? '') == 'Katolik' ? 'selected' : '' }}>
                                                        Katolik</option>
                                                    <option value="Hindu"
                                                        {{ old('agama', $biodata->agama ?? '') == 'Hindu' ? 'selected' : '' }}>
                                                        Hindu</option>
                                                    <option value="Buddha"
                                                        {{ old('agama', $biodata->agama ?? '') == 'Buddha' ? 'selected' : '' }}>
                                                        Buddha</option>
                                                     <option value="Kong Hu Cu"
                                                        {{ old('agama', $biodata->agama ?? '') == 'Kong Hu Cu' ? 'selected' : '' }}>
                                                        Kong Hu Cu</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Alamat -->
                                        <h6 class="mb-3 text-primary">Alamat</h6>
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Alamat Lengkap <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" name="alamat" rows="3" required
                                                        placeholder="Jl. Nama Jalan No. X, RT/RW, Kelurahan">{{ old('alamat', $biodata->alamat ?? '') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Provinsi <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="provinsiSelect" name="provinsi_id"
                                                        required>
                                                        <option value="">Pilih Provinsi</option>
                                                        @foreach ($provinsis as $prov)
                                                            <option value="{{ $prov->id }}"
                                                                {{ old('provinsi_id', $biodata->provinsi_id ?? '') == $prov->id ? 'selected' : '' }}>
                                                                {{ $prov->nama_provinsi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Kota/Kabupaten <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="kabupatenSelect" name="kabupaten_id"
                                                        required disabled>
                                                        <option value="">Pilih Kabupaten</option>
                                                    </select>
                                                    <small class="text-muted d-block mt-1">Pilih Provinsi terlebih
                                                        dahulu</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Kecamatan <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="kecamatanSelect" name="kecamatan_id"
                                                        required disabled>
                                                        <option value="">Pilih Kecamatan</option>
                                                    </select>
                                                    <small class="text-muted d-block mt-1">Pilih Kabupaten terlebih
                                                        dahulu</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Desa/Kelurahan <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="desaSelect" name="desa_id" required
                                                        disabled>
                                                        <option value="">Pilih Desa/Kelurahan</option>
                                                    </select>
                                                    <small class="text-muted d-block mt-1">Pilih Kecamatan terlebih
                                                        dahulu</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="kodePosDivParent" style="display: none;">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Kode Pos<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="kode_pos"
                                                        id="kodePosInput" placeholder="XXXXX"
                                                        value="{{ old('kode_pos', $biodata->kode_pos ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pendidikan dan Pekerjaan -->
                                        <h6 class="mb-3 text-primary">Asal Sekolah</h6>

                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Nama Sekolah<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="asal_sekolah"
                                                        placeholder="Nama sekolah asal"
                                                        value="{{ old('asal_sekolah', $biodata->asal_sekolah ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">NISN<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nisn"
                                                        placeholder="Nomor Induk Siswa Nasional" inputmode="numeric"
                                                        pattern="[0-9]*" maxlength="20"
                                                        value="{{ old('nisn', $biodata->nisn ?? '') }}" required>
                                                    <small class="text-muted d-block mt-1">Hanya angka (0-9) yang
                                                        diizinkan</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Informasi Tambahan -->
                                        <h6 class="mb-3 text-primary">Informasi Tambahan</h6>
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Hobi/Minat</label>
                                                    <textarea class="form-control" name="hobi" rows="2" placeholder="Hobi atau minat Anda">{{ old('hobi', $biodata->hobi ?? '') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Keterangan Tambahan</label>
                                                    <textarea class="form-control" name="keterangan" rows="3"
                                                        placeholder="Informasi tambahan yang perlu diketahui">{{ old('keterangan', $biodata->keterangan ?? '') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Data Keluarga -->
                                        <h6 class="mb-3 text-primary">Data Wali Murid</h6>
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Status Orang Tua <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="status_orang_tua"
                                                        id="statusOrangTua" required>
                                                        <option value="">Pilih Status</option>
                                                        <option value="Lengkap"
                                                            {{ old('status_orang_tua', $biodata->status_orang_tua ?? '') == 'Lengkap' ? 'selected' : '' }}>
                                                            Lengkap (Ada Ayah & Ibu)</option>
                                                        <option value="Yatim"
                                                            {{ old('status_orang_tua', $biodata->status_orang_tua ?? '') == 'Yatim' ? 'selected' : '' }}>
                                                            Yatim (Ayah Meninggal)</option>
                                                        <option value="Piatu"
                                                            {{ old('status_orang_tua', $biodata->status_orang_tua ?? '') == 'Piatu' ? 'selected' : '' }}>
                                                            Piatu (Ibu Meninggal)</option>
                                                        <option value="Yatim Piatu"
                                                            {{ old('status_orang_tua', $biodata->status_orang_tua ?? '') == 'Yatim Piatu' ? 'selected' : '' }}>
                                                            Yatim Piatu (Ayah & Ibu Meninggal)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section Ayah -->
                                        <div id="sectionAyah" style="display: none;">
                                            <h6 class="mb-3 text-secondary">Data Ayah</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Nama Ayah <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nama_ayah"
                                                        value="{{ old('nama_ayah', $biodata->nama_ayah ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">NIK Ayah <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nik_ayah"
                                                        inputmode="numeric" pattern="[0-9]*" maxlength="16"
                                                        value="{{ old('nik_ayah', $biodata->nik_ayah ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tahun Lahir Ayah <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="tahun_lahir_ayah"
                                                        value="{{ old('tahun_lahir_ayah', $biodata->tahun_lahir_ayah ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Pekerjaan Ayah <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="pekerjaan_ayah"
                                                        value="{{ old('pekerjaan_ayah', $biodata->pekerjaan_ayah ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Pendidikan Terakhir Ayah <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="pendidikan_ayah"
                                                        value="{{ old('pendidikan_ayah', $biodata->pendidikan_ayah ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Penghasilan Ayah <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="penghasilan_ayah">
                                                        <option value="">Pilih Penghasilan</option>
                                                        <option value="< 1 Juta"
                                                            {{ old('penghasilan_ayah', $biodata->penghasilan_ayah ?? '') == '< 1 Juta' ? 'selected' : '' }}>
                                                            < 1 Juta</option>
                                                        <option value="1-3 Juta"
                                                            {{ old('penghasilan_ayah', $biodata->penghasilan_ayah ?? '') == '1-3 Juta' ? 'selected' : '' }}>
                                                            1 - 3 Juta</option>
                                                        <option value="3-5 Juta"
                                                            {{ old('penghasilan_ayah', $biodata->penghasilan_ayah ?? '') == '3-5 Juta' ? 'selected' : '' }}>
                                                            3 - 5 Juta</option>
                                                        <option value="> 5 Juta"
                                                            {{ old('penghasilan_ayah', $biodata->penghasilan_ayah ?? '') == '> 5 Juta' ? 'selected' : '' }}>
                                                            > 5 Juta</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">No. HP Ayah <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="no_hp_ayah"
                                                        inputmode="numeric" pattern="[0-9]*"
                                                        value="{{ old('no_hp_ayah', $biodata->no_hp_ayah ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section Ibu -->
                                        <div id="sectionIbu" style="display: none;">
                                            <h6 class="mb-3 text-secondary">Data Ibu</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Nama Ibu <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nama_ibu"
                                                        value="{{ old('nama_ibu', $biodata->nama_ibu ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">NIK Ibu <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nik_ibu"
                                                        inputmode="numeric" pattern="[0-9]*" maxlength="16"
                                                        value="{{ old('nik_ibu', $biodata->nik_ibu ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tahun Lahir Ibu <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="tahun_lahir_ibu"
                                                        value="{{ old('tahun_lahir_ibu', $biodata->tahun_lahir_ibu ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Pekerjaan Ibu <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="pekerjaan_ibu"
                                                        value="{{ old('pekerjaan_ibu', $biodata->pekerjaan_ibu ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Pendidikan Terakhir Ibu <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="pendidikan_ibu"
                                                        value="{{ old('pendidikan_ibu', $biodata->pendidikan_ibu ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Penghasilan Ibu <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="penghasilan_ibu">
                                                        <option value="">Pilih Penghasilan</option>
                                                        <option value="< 1 Juta"
                                                            {{ old('penghasilan_ibu', $biodata->penghasilan_ibu ?? '') == '< 1 Juta' ? 'selected' : '' }}>
                                                            < 1 Juta</option>
                                                        <option value="1-3 Juta"
                                                            {{ old('penghasilan_ibu', $biodata->penghasilan_ibu ?? '') == '1-3 Juta' ? 'selected' : '' }}>
                                                            1 - 3 Juta</option>
                                                        <option value="3-5 Juta"
                                                            {{ old('penghasilan_ibu', $biodata->penghasilan_ibu ?? '') == '3-5 Juta' ? 'selected' : '' }}>
                                                            3 - 5 Juta</option>
                                                        <option value="> 5 Juta"
                                                            {{ old('penghasilan_ibu', $biodata->penghasilan_ibu ?? '') == '> 5 Juta' ? 'selected' : '' }}>
                                                            > 5 Juta</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">No. HP Ibu <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="no_hp_ibu"
                                                        inputmode="numeric" pattern="[0-9]*"
                                                        value="{{ old('no_hp_ibu', $biodata->no_hp_ibu ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section Wali -->
                                        <div id="sectionWali" style="display: none;">
                                            <h6 class="mb-3 text-secondary">Data Wali</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Nama Wali <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nama_wali"
                                                        value="{{ old('nama_wali', $biodata->nama_wali ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">NIK Wali <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nik_wali"
                                                        inputmode="numeric" pattern="[0-9]*" maxlength="16"
                                                        value="{{ old('nik_wali', $biodata->nik_wali ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tahun Lahir Wali <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="tahun_lahir_wali"
                                                        value="{{ old('tahun_lahir_wali', $biodata->tahun_lahir_wali ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Pekerjaan Wali <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="pekerjaan_wali"
                                                        value="{{ old('pekerjaan_wali', $biodata->pekerjaan_wali ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Pendidikan Terakhir Wali <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="pendidikan_wali"
                                                        value="{{ old('pendidikan_wali', $biodata->pendidikan_wali ?? '') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Penghasilan Wali <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" name="penghasilan_wali">
                                                        <option value="">Pilih Penghasilan</option>
                                                        <option value="< 1 Juta"
                                                            {{ old('penghasilan_wali', $biodata->penghasilan_wali ?? '') == '< 1 Juta' ? 'selected' : '' }}>
                                                            < 1 Juta</option>
                                                        <option value="1-3 Juta"
                                                            {{ old('penghasilan_wali', $biodata->penghasilan_wali ?? '') == '1-3 Juta' ? 'selected' : '' }}>
                                                            1 - 3 Juta</option>
                                                        <option value="3-5 Juta"
                                                            {{ old('penghasilan_wali', $biodata->penghasilan_wali ?? '') == '3-5 Juta' ? 'selected' : '' }}>
                                                            3 - 5 Juta</option>
                                                        <option value="> 5 Juta"
                                                            {{ old('penghasilan_wali', $biodata->penghasilan_wali ?? '') == '> 5 Juta' ? 'selected' : '' }}>
                                                            > 5 Juta</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">No. HP Wali <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="no_hp_wali"
                                                        inputmode="numeric" pattern="[0-9]*"
                                                        value="{{ old('no_hp_wali', $biodata->no_hp_wali ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Terms & Submit -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check mb-4">
                                                    <input class="form-check-input" type="checkbox" id="agreeTerms"
                                                        required>
                                                    <label class="form-check-label" for="agreeTerms">
                                                        Saya menyatakan bahwa data yang saya isi adalah benar dan dapat
                                                        dipertanggungjawabkan.
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-end gap-3">
                                                    <button type="reset" class="btn btn-outline-secondary">
                                                        <i class="fas fa-redo me-2"></i>Reset Form
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save me-2"></i>Simpan Biodata
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Kolom dengan tanda <span class="text-danger">*</span> wajib diisi.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->

                <script>
                    // Validasi form
                    document.getElementById('biodataForm').addEventListener('submit', function(e) {
                        const tanggalLahir = document.querySelector('input[name="tanggal_lahir"]').value;
                        const now = new Date();
                        const birthDate = new Date(tanggalLahir);

                        if (birthDate > now) {
                            e.preventDefault();
                            alert('Tanggal lahir tidak boleh melebihi tanggal hari ini.');
                            return false;
                        }

                        // Validasi dropdown ID terisi
                        const provinsiId = document.getElementById('provinsiSelect').value;
                        const kabupatenId = document.getElementById('kabupatenSelect').value;
                        const kecamatanId = document.getElementById('kecamatanSelect').value;
                        const desaId = document.getElementById('desaSelect').value;

                        console.log('Form submission data:', {
                            provinsiId,
                            kabupatenId,
                            kecamatanId,
                            desaId
                        });

                        if (!provinsiId || !kabupatenId || !kecamatanId || !desaId) {
                            e.preventDefault();
                            alert('Pastikan semua wilayah (Provinsi, Kabupaten, Kecamatan, Desa) sudah dipilih!');
                            return false;
                        }

                        return true;
                    });

                    // Validasi NISN hanya angka (real-time)
                    document.querySelector('input[name="nisn"]').addEventListener('input', function(e) {
                        // Hapus semua karakter non-angka
                        this.value = this.value.replace(/[^0-9]/g, '');
                    });

                    // Logic Status Orang Tua
                    const statusOrangTuaSelect = document.getElementById('statusOrangTua');
                    const sectionAyah = document.getElementById('sectionAyah');
                    const sectionIbu = document.getElementById('sectionIbu');
                    const sectionWali = document.getElementById('sectionWali');

                    function toggleRequired(section, isRequired) {
                        const inputs = section.querySelectorAll('input, select');
                        inputs.forEach(input => {
                            if (isRequired) {
                                input.setAttribute('required', 'required');
                            } else {
                                input.removeAttribute('required');
                            }
                        });
                    }

                    function handleStatusOrangTua() {
                        const status = statusOrangTuaSelect.value;

                        // Hide all first
                        sectionAyah.style.display = 'none';
                        sectionIbu.style.display = 'none';
                        sectionWali.style.display = 'none';

                        toggleRequired(sectionAyah, false);
                        toggleRequired(sectionIbu, false);
                        toggleRequired(sectionWali, false);

                        if (status === 'Lengkap') {
                            sectionAyah.style.display = 'block';
                            sectionIbu.style.display = 'block';
                            toggleRequired(sectionAyah, true);
                            toggleRequired(sectionIbu, true);
                        } else if (status === 'Yatim') {
                            sectionIbu.style.display = 'block';
                            toggleRequired(sectionIbu, true);
                        } else if (status === 'Piatu') {
                            sectionAyah.style.display = 'block';
                            toggleRequired(sectionAyah, true);
                        } else if (status === 'Yatim Piatu') {
                            sectionWali.style.display = 'block';
                            toggleRequired(sectionWali, true);
                        }
                    }

                    if (statusOrangTuaSelect) {
                        statusOrangTuaSelect.addEventListener('change', handleStatusOrangTua);
                        // Run once on load to set initial state
                        handleStatusOrangTua();
                    }

                    // Cascading Dropdown Logic using EMSIFA API
                    const provinsiSelect = document.getElementById('provinsiSelect');
                    const kabupatenSelect = document.getElementById('kabupatenSelect');
                    const kecamatanSelect = document.getElementById('kecamatanSelect');
                    const desaSelect = document.getElementById('desaSelect');
                    const kodePosDiv = document.getElementById('kodePosDivParent');
                    const kodePosInput = document.getElementById('kodePosInput');

                    // Data lama untuk restore saat edit/validasi error
                    const oldData = {
                        provinsi: "{{ old('provinsi_id', $biodata->provinsi_id ?? '') }}",
                        kabupaten: "{{ old('kabupaten_id', $biodata->kabupaten_id ?? '') }}",
                        kecamatan: "{{ old('kecamatan_id', $biodata->kecamatan_id ?? '') }}",
                        desa: "{{ old('desa_id', $biodata->desa_id ?? '') }}"
                    };

                    // Helper function untuk fetch data wilayah
                    async function fetchWilayah(url, targetSelect, placeholder, selectedValue = null) {
                        // Set loading state
                        targetSelect.innerHTML = `<option value="">Loading...</option>`;
                        targetSelect.setAttribute('disabled', 'disabled');

                        try {
                            console.log(`Fetching data from: ${url}`);
                            const response = await fetch(url);

                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }

                            const data = await response.json();
                            console.log('Data received:', data);

                            targetSelect.innerHTML = `<option value="">${placeholder}</option>`;

                            if (Array.isArray(data)) {
                                data.forEach(item => {
                                    const option = document.createElement('option');
                                    option.value = item.id;
                                    option.text = item.name;
                                    option.setAttribute('data-name', item.name); // Store name in data attribute
                                    targetSelect.appendChild(option);
                                });
                            }

                            // Enable dropdown
                            targetSelect.removeAttribute('disabled');

                            // Restore value jika ada
                            if (selectedValue) {
                                const exists = Array.from(targetSelect.options).some(opt => opt.value == selectedValue);
                                if (exists) {
                                    targetSelect.value = selectedValue;
                                    targetSelect.dispatchEvent(new Event('change'));
                                }
                            }
                        } catch (error) {
                            console.error('Error fetching data:', error);
                            targetSelect.innerHTML = `<option value="">Gagal memuat data (Cek Koneksi)</option>`;
                            // Tetap enable supaya user tahu ada error
                            targetSelect.removeAttribute('disabled');
                        }
                    }

                    // Load Provinsi on Start
                    fetchWilayah('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', provinsiSelect, 'Pilih Provinsi',
                        oldData.provinsi);

                    // Event Listener: Provinsi -> Kabupaten
                    provinsiSelect.addEventListener('change', function() {
                        const id = this.value;
                        console.log('Provinsi changed. ID:', id);

                        // Reset child dropdowns
                        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                        kabupatenSelect.setAttribute('disabled', 'disabled');

                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        kecamatanSelect.setAttribute('disabled', 'disabled');

                        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                        desaSelect.setAttribute('disabled', 'disabled');

                        kodePosDiv.style.display = 'none';

                        if (id) {
                            const shouldRestore = (id == oldData.provinsi);
                            const valueToRestore = shouldRestore ? oldData.kabupaten : null;

                            fetchWilayah(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${id}.json`,
                                kabupatenSelect, 'Pilih Kabupaten', valueToRestore);
                        }
                    });

                    // Event Listener: Kabupaten -> Kecamatan
                    kabupatenSelect.addEventListener('change', function() {
                        const id = this.value;
                        console.log('Kabupaten changed. ID:', id);

                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        kecamatanSelect.setAttribute('disabled', 'disabled');

                        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                        desaSelect.setAttribute('disabled', 'disabled');

                        kodePosDiv.style.display = 'none';

                        if (id) {
                            const shouldRestore = (id == oldData.kabupaten);
                            const valueToRestore = shouldRestore ? oldData.kecamatan : null;

                            fetchWilayah(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${id}.json`,
                                kecamatanSelect, 'Pilih Kecamatan', valueToRestore);
                        }
                    });

                    // Event Listener: Kecamatan -> Desa
                    kecamatanSelect.addEventListener('change', function() {
                        const id = this.value;
                        console.log('Kecamatan changed. ID:', id);

                        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                        desaSelect.setAttribute('disabled', 'disabled');

                        kodePosDiv.style.display = 'none';

                        if (id) {
                            const shouldRestore = (id == oldData.kecamatan);
                            const valueToRestore = shouldRestore ? oldData.desa : null;

                            fetchWilayah(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${id}.json`, desaSelect,
                                'Pilih Desa/Kelurahan', valueToRestore);
                        }
                    });

                    // Event Listener: Desa -> Kode Pos
                    desaSelect.addEventListener('change', function() {
                        const id = this.value;
                        console.log('Desa changed. ID:', id);

                        if (id) {
                            kodePosDiv.style.display = 'block';
                            kodePosInput.setAttribute('required', 'required');
                        } else {
                            kodePosDiv.style.display = 'none';
                            kodePosInput.removeAttribute('required');
                        }
                    });

                    // Preview image (opsional)
                    function previewImage(input, previewId) {
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById(previewId).src = e.target.result;
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
            @else
                @include('component.verif-content')
        @endif
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33',
                });
            @endif

            // Validasi input nomor telepon - hanya angka
            const nomorTeleponInput = document.querySelector('input[name="nomor_telepon"]');
            if (nomorTeleponInput) {
                nomorTeleponInput.addEventListener('input', function(e) {
                    // Hapus semua karakter yang bukan angka
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }
        });
    </script>
    <style>
        /* Default: Hide print container on screen */
        .print-container {
            display: none;
        }

        /* Background utama halaman */
        .pc-content {
            background: url('assets/images/user/image.png') !important;
            background-size: cover !important;
            background-attachment: fixed !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            min-height: 100vh;
        }

        .card {
            background-color: rgba(236, 237, 244, 0.87) !important;
        }

        .card-header {
            background-color: rgba(240, 240, 245, 0.83) !important;
        }

        /* Print Styles matching daftar_ulang and hasil_pengumuman */
        @media print {

            /* Hide non-printable elements */
            body {
                background: url('assets/images/widget/image.png') !important;
                background-size: cover !important;
                background-attachment: fixed !important;
                background-position: center !important;
                padding: 0 !important;
                margin: 0 !important;
                color: #000 !important;
            }

            .breadcrumb,
            .page-header,
            .alert,
            .pc-sidebar,
            .pc-header,
            .pc-footer,
            .card-header,
            .card-footer,
            .screen-only,
            nav,
            #biodataForm,
            .btn {
                display: none !important;
            }

            .pc-content {
                padding: 0 !important;
                margin: 0 !important;
            }

            /* Make sure the print container is visible */
            .print-container {
                display: block !important;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 9999;
                background: url('assets/images/widget/image.png') !important;
                background-size: cover !important;
                background-attachment: fixed !important;
                background-position: center !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .card-body {
                padding: 0 !important;
                margin: 0 !important;
                background-color: rgba(255, 255, 255, 0.14) !important;
            }

            /* Show print header */
            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 3px solid #000;
                background-color: rgba(255, 255, 255, 0.2) !important;
                position: relative;
            }

            .print-header h2 {
                margin: 5px 0;
                font-size: 18pt;
                font-weight: bold;
                text-transform: uppercase;
                color: #000;
            }

            .print-header h3 {
                margin: 5px 0;
                font-size: 16pt;
                font-weight: bold;
                color: #000;
            }

            .print-header p {
                margin: 2px 0;
                font-size: 11pt;
                color: #000;
            }

            /* Document info */
            .print-info {
                display: block !important;
                margin: 20px 0 30px 0;
                color: #000;
            }

            .print-info table {
                width: 100%;
                margin-bottom: 10px;
            }

            .print-info td {
                padding: 5px;
                font-size: 11pt;
            }

            /* Signature section */
            .print-signature {
                display: block !important;
                margin-top: 50px;
                page-break-inside: avoid;
            }

            .print-signature p {
                margin: 5px 0;
                color: #000;
            }

            .signature-table {
                width: 100%;
                border: none;
                margin-top: 40px;
            }

            .signature-table td {
                border: none !important;
                padding: 0 !important;
                text-align: center;
                vertical-align: top;
                padding-top: 0 !important;
            }

            /* Print footer */
            .print-footer {
                display: block !important;
                text-align: center;
                margin-top: 50px;
                font-size: 9pt;
                color: #666;
                border-top: 1px solid #cccccce2;
                padding-top: 10px;
                position: fixed;
                bottom: 20px;
                left: 0;
                right: 0;
            }

            @page {
                size: A4;
                margin: 20mm;
            }
        }
    </style>
@endsection
