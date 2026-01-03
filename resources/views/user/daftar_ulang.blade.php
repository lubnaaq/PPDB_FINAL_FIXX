@extends('layouts.dashboard')
@section('title', 'Daftar Ulang')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Daftar Ulang</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Daftar Ulang</h2>
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
                        <h5>Informasi Daftar Ulang</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">Perhatian!</h4>
                            <p>Halaman ini memuat informasi mengenai prosedur daftar ulang bagi calon siswa yang telah dinyatakan <strong>LULUS</strong> seleksi PPDB.</p>
                            <hr>
                            <p class="mb-0">Pastikan Anda memantau status kelulusan Anda di menu <strong>Pengumuman</strong> atau <strong>Status</strong> sebelum melakukan daftar ulang.</p>
                        </div>

                        <h5 class="mt-4">Jadwal Daftar Ulang</h5>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Kegiatan</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Tempat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Daftar Ulang Gelombang 1</td>
                                    <td>10 - 12 Juli 2026</td>
                                    <td>08.00 - 14.00 WIB</td>
                                    <td>Ruang Tata Usaha SMK</td>
                                </tr>
                                <tr>
                                    <td>Daftar Ulang Gelombang 2</td>
                                    <td>15 - 17 Juli 2026</td>
                                    <td>08.00 - 14.00 WIB</td>
                                    <td>Ruang Tata Usaha SMK</td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="mt-4">Berkas yang Harus Dibawa</h5>
                        <p>Calon siswa wajib datang ke sekolah dengan membawa berkas-berkas asli dan fotokopi sebagai berikut:</p>
                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                1. Bukti Tanda Terima Pendaftaran (Cetak dari Website)
                                <span class="badge bg-primary rounded-pill">1 Lembar</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                2. Ijazah / Surat Keterangan Lulus (Asli & Fotokopi Legalisir)
                                <span class="badge bg-primary rounded-pill">2 Lembar</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                3. Kartu Keluarga (Asli & Fotokopi)
                                <span class="badge bg-primary rounded-pill">2 Lembar</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                4. Akta Kelahiran (Asli & Fotokopi)
                                <span class="badge bg-primary rounded-pill">2 Lembar</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                5. Pas Foto Berwarna 3x4 (Background Merah/Biru)
                                <span class="badge bg-primary rounded-pill">4 Lembar</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                6. Surat Pernyataan Siswa & Orang Tua (Materai 10.000)
                                <span class="badge bg-primary rounded-pill">1 Lembar</span>
                            </li>
                        </ul>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="button" onclick="window.print()">
                                <i class="feather icon-printer me-2"></i> Cetak Informasi Ini
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection
