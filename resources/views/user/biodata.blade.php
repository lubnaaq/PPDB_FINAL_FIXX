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
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
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
                                              <input type="email" class="form-control" name="email" required readonly
                                                  placeholder="contoh@email.com" value="{{ auth()->user()->email }}">
                                            <small class="text-muted d-block mt-1">Email tidak dapat diubah (sesuai akun registrasi)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">No. Telepon/HP <span class="text-danger">*</span></label>
                                              <input type="tel" class="form-control" name="nomor_telepon" required 
                                                placeholder="Nomor telepon" 
                                                inputmode="numeric" 
                                                pattern="[0-9]*"
                                                maxlength="20"
                                                value="{{ old('nomor_telepon', $biodata->nomor_telepon ?? '') }}">
                                            <small class="text-muted d-block mt-1">Hanya angka (0-9) yang diizinkan</small>
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
                                            <select class="form-select" id="provinsiSelect" name="provinsi_id" required>
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($provinsis as $prov)
                                                    <option value="{{ $prov->id }}" {{ old('provinsi_id', $biodata->provinsi_id ?? '') == $prov->id ? 'selected' : '' }}>
                                                        {{ $prov->nama_provinsi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                            <select class="form-select" id="kabupatenSelect" name="kabupaten_id" required disabled>
                                                <option value="">Pilih Kabupaten</option>
                                            </select>
                                            <small class="text-muted d-block mt-1">Pilih Provinsi terlebih dahulu</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                            <select class="form-select" id="kecamatanSelect" name="kecamatan_id" required disabled>
                                                <option value="">Pilih Kecamatan</option>
                                            </select>
                                            <small class="text-muted d-block mt-1">Pilih Kabupaten terlebih dahulu</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                                            <select class="form-select" id="desaSelect" name="desa_id" required disabled>
                                                <option value="">Pilih Desa/Kelurahan</option>
                                            </select>
                                            <small class="text-muted d-block mt-1">Pilih Kecamatan terlebih dahulu</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="kodePosDivParent" style="display: none;">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Kode Pos<span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="kode_pos" id="kodePosInput"
                                                  placeholder="XXXXX" value="{{ old('kode_pos', $biodata->kode_pos ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Pendidikan dan Pekerjaan -->
                                <h6 class="mb-3 text-primary">Asal Sekolah</h6>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Sekolah<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="asal_sekolah" 
                                                placeholder="Nama sekolah asal" value="{{ old('asal_sekolah', $biodata->asal_sekolah ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">NISN<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nisn" 
                                                placeholder="Nomor Induk Siswa Nasional" 
                                                inputmode="numeric" 
                                                pattern="[0-9]*"
                                                maxlength="20"
                                                value="{{ old('nisn', $biodata->nisn ?? '') }}"
                                                required>
                                            <small class="text-muted d-block mt-1">Hanya angka (0-9) yang diizinkan</small>
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

                    // Validasi dropdown ID terisi
                    const provinsiId = document.getElementById('provinsiSelect').value;
                    const kabupatenId = document.getElementById('kabupatenSelect').value;
                    const kecamatanId = document.getElementById('kecamatanSelect').value;
                    const desaId = document.getElementById('desaSelect').value;

                    console.log('Form submission data:', {
                        provinsiId, kabupatenId, kecamatanId, desaId
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
                fetchWilayah('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', provinsiSelect, 'Pilih Provinsi', oldData.provinsi);

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
                        
                        fetchWilayah(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${id}.json`, kabupatenSelect, 'Pilih Kabupaten', valueToRestore);
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
                        
                        fetchWilayah(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${id}.json`, kecamatanSelect, 'Pilih Kecamatan', valueToRestore);
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
                        
                        fetchWilayah(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${id}.json`, desaSelect, 'Pilih Desa/Kelurahan', valueToRestore);
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
@endsection