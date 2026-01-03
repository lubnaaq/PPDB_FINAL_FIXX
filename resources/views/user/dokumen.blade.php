@extends('layouts.dashboard')
@section('title', 'Upload Dokumen')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Upload Dokumen</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Upload Dokumen Pendaftaran</h2>
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
                        <h5>Form Upload Dokumen</h5>
                        <p class="text-muted mb-0">Silakan upload dokumen yang diperlukan untuk pendaftaran SMK</p>
                    </div>
                    <div class="card-body">
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
                        <!-- Alert Messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Validasi Gagal!</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Upload Form -->
                        <form id="dokumentForm" method="POST" action="{{ route('dokumen.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nama Dokumen <span class="text-danger">*</span></label>
                                        <select class="form-control @error('nama_dokumen') is-invalid @enderror" 
                                                name="nama_dokumen" id="namaDokumen" required>
                                            <option value="">-- Pilih Dokumen --</option>
                                            <option value="Ijazah">Ijazah / SHUN</option>
                                            <option value="NISN">NISN</option>
                                            <option value="Kartu Keluarga">Kartu Keluarga</option>
                                            <option value="Akta Kelahiran">Akta Kelahiran</option>
                                            <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                                            <option value="Foto 3x4">Foto 3x4 (Warna Formal)</option>
                                            </select>
                                        @error('nama_dokumen')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">File Dokumen <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                                   name="file" id="fileInput" accept=".pdf,.jpg,.jpeg,.png" required>
                                            <span class="input-group-text">
                                                <i class="feather icon-upload-cloud"></i>
                                            </span>
                                        </div>
                                        <small class="form-text text-muted d-block mt-2">
                                            <i class="feather icon-info"></i> Format: PDF, JPG, JPEG, PNG (Maksimal 5MB)
                                        </small>
                                        @error('file')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="feather icon-upload"></i> Upload Dokumen
                                    </button>
                                    <a href="javascript:void(0);" class="btn btn-secondary" onclick="window.history.back()">
                                        <i class="feather icon-x"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- [ Daftar Dokumen yang Sudah Diupload ] start -->
        @if ($dokumens && count($dokumens) > 0)
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Dokumen yang Sudah Diupload</h5>
                            <p class="text-muted mb-0">Daftar dokumen pendaftaran Anda</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Dokumen</th>
                                            <th>Tipe File</th>
                                            <th>Status Verifikasi</th>
                                            <th>Tanggal Upload</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokumens as $key => $dokumen)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <strong>{{ $dokumen->nama_dokumen }}</strong>
                                                </td>
                                                <td>
                                                        <span class="badge bg-secondary">{{ strtoupper($dokumen->file_type) }}</span>
                                                        @if (in_array(strtolower($dokumen->file_type), ['jpg','jpeg','png']))
                                                            <a href="{{ asset('storage/'.$dokumen->file_path) }}" target="_blank" class="ms-2">Lihat</a>
                                                        @elseif (strtolower($dokumen->file_type) === 'pdf')
                                                            <a href="{{ asset('storage/'.$dokumen->file_path) }}" target="_blank" class="ms-2">Buka</a>
                                                        @endif
                                                </td>
                                            
                                                <td>
                                                    @if ($dokumen->status_verifikasi === 'pending')
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="feather icon-clock"></i> Menunggu Verifikasi
                                                        </span>
                                                    @elseif ($dokumen->status_verifikasi === 'disetujui')
                                                        <span class="badge bg-success">
                                                            <i class="feather icon-check-circle"></i> Disetujui
                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger">
                                                            <i class="feather icon-x-circle"></i> Ditolak
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ $dokumen->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('dokumen.download', $dokumen->id) }}" 
                                                           class="btn btn-sm btn-info" title="Download">
                                                            <i class="feather icon-download"></i>
                                                        </a>
                                                        @if ($dokumen->status_verifikasi === 'pending')
                                                            <button type="button" class="btn btn-sm btn-danger" 
                                                                    onclick="deleteDokumen({{ $dokumen->id }})" 
                                                                    title="Hapus">
                                                                <i class="feather icon-trash-2"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <i class="feather icon-info"></i> Belum ada dokumen yang diupload. Silakan upload dokumen yang diperlukan.
                    </div>
                </div>
            </div>
        @endif
        <!-- [ Daftar Dokumen yang Sudah Diupload ] end -->
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus dokumen ini? Aksi ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="btnKonfirmasiHapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let dokumenIdToDelete = null;

        function deleteDokumen(dokumenId) {
            dokumenIdToDelete = dokumenId;
            const modal = new bootstrap.Modal(document.getElementById('modalHapus'), {});
            modal.show();
        }

        document.getElementById('btnKonfirmasiHapus').addEventListener('click', function() {
            if (!dokumenIdToDelete) return;

            fetch(`/dokumen/${dokumenIdToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    document.querySelector('.pc-content').insertAdjacentElement('afterbegin', alertDiv);
                    
                    // Reload page after 2 seconds
                    setTimeout(() => location.reload(), 2000);
                } else {
                    alert('Gagal menghapus dokumen: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus dokumen');
            })
            .finally(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalHapus'));
                modal.hide();
            });
        });

        // Preview file name
        document.getElementById('fileInput').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                const fileSize = this.files[0].size;
                const maxSize = 5 * 1024 * 1024; // 5MB

                if (fileSize > maxSize) {
                    alert('Ukuran file tidak boleh lebih dari 5MB');
                    this.value = '';
                }
            }
        });
    </script>

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
