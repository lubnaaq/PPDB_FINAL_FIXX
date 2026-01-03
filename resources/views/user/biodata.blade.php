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
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Biodata Diri</h5>
                            <p class="text-muted mb-0">Silakan lengkapi data diri Anda dengan benar</p>
                        </div>
                        <div class="card-body">
                            <form id="biodataForm" action="{{ route('biodata.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Informasi Pribadi -->
                                <h6 class="mb-3 text-primary">Informasi Pribadi</h6>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama_lengkap" required 
                                                   placeholder="Masukkan nama lengkap">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                              <input type="email" class="form-control" name="email" required 
                                                  placeholder="contoh@email.com" value="{{ old('email', $biodata->email ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">No. Telepon/HP <span class="text-danger">*</span></label>
                                              <input type="tel" class="form-control" name="nomor_telepon" required 
                                                  placeholder="08xxxxxxxxxx" value="{{ old('nomor_telepon', $biodata->nomor_telepon ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                            <select class="form-select" name="jenis_kelamin" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="tempat_lahir" required 
                                                  placeholder="Kota kelahiran" value="{{ old('tempat_lahir', $biodata->tempat_lahir ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tanggal_lahir" required value="{{ old('tanggal_lahir', isset($biodata->tanggal_lahir) && $biodata->tanggal_lahir ? \Illuminate\Support\Carbon::parse($biodata->tanggal_lahir)->format('Y-m-d') : '') }}">
                                        </div>
                                    </div>
                                </div>
<div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Agama <span class="text-danger">*</span></label>
                                            <select class="form-select" name="agama" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ old('agama', $biodata->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ old('agama', $biodata->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ old('agama', $biodata->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ old('agama', $biodata->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ old('agama', $biodata->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                <!-- Alamat -->
                                <h6 class="mb-3 text-primary">Alamat</h6>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="alamat" rows="3" required 
                                                      placeholder="Jl. Nama Jalan No. X, RT/RW, Kelurahan">{{ old('alamat', $biodata->alamat ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                            <select class="form-select" name="provinsi" required>
                                                <option value="">Pilih Provinsi</option>
                                                <option value="DKI Jakarta" {{ old('provinsi', $biodata->provinsi ?? '') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                                                <option value="Jawa Barat" {{ old('provinsi', $biodata->provinsi ?? '') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                                <option value="Jawa Tengah" {{ old('provinsi', $biodata->provinsi ?? '') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                                                <option value="Jawa Timur" {{ old('provinsi', $biodata->provinsi ?? '') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                                                <option value="Banten" {{ old('provinsi', $biodata->provinsi ?? '') == 'Banten' ? 'selected' : '' }}>Banten</option>
                                                <!-- Tambahkan provinsi lain sesuai kebutuhan -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="kota" required 
                                                  placeholder="Nama kota/kabupaten" value="{{ old('kota', $biodata->kota ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Kode Pos</label>
                                              <input type="text" class="form-control" name="kode_pos" 
                                                  placeholder="XXXXX" value="{{ old('kode_pos', $biodata->kode_pos ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Pendidikan dan Pekerjaan -->
                                <h6 class="mb-3 text-primary">Asal Sekolah</h6>
                                
                                <div class="row mb-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Sekolah/Instansi</span></label>
                                              <input type="text" class="form-control" name="instansi" 
                                                  placeholder="Nama sekolah/instansasai asal" value="{{ old('instansi', $biodata->instansi ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                               
                                <!-- Informasi Tambahan -->
                                <h6 class="mb-3 text-primary">Informasi Tambahan</h6>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Hobi/Minat</label>
                                            <textarea class="form-control" name="hobi" rows="2" 
                                                      placeholder="Hobi atau minat Anda">{{ old('hobi', $biodata->hobi ?? '') }}</textarea>
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

                                <!-- Terms & Submit -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                            <label class="form-check-label" for="agreeTerms">
                                                Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan.
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
                    
                    return true;
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
        });
    </script>
@endsection