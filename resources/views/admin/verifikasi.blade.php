@extends('layouts.dashboard')
@section('title', 'Verifikasi Berkas')
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
                            <li class="breadcrumb-item" aria-current="page">Verifikasi Berkas</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Verifikasi Dokumen Pendaftar</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Pembayaran Pendaftar</h5>
                        <p class="text-muted mb-0">Verifikasi bukti pembayaran yang diupload oleh pendaftar</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pendaftar</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Status</th>
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payments as $i => $pay)
                                        <tr>
                                            <td>{{ ($payments->currentPage() - 1) * $payments->perPage() + $i + 1 }}</td>
                                            <td>{{ $pay->user->name ?? '-' }}</td>
                                            <td>Rp {{ number_format($pay->amount, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pay->payment_date)->format('d/m/Y') }}</td>
                                            <td>
                                                @if ($pay->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                                @elseif ($pay->status === 'verified')
                                                    <span class="badge bg-success">Terverifikasi</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ asset('storage/'.$pay->proof_file_path) }}" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="feather icon-eye"></i> Lihat
                                                </a>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-success" onclick="setujuiPayment({{ $pay->id }})">
                                                        <i class="feather icon-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="tolakPayment({{ $pay->id }})">
                                                        <i class="feather icon-x"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-5">
                                                <i class="feather icon-info"></i> Belum ada data pembayaran.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if (method_exists($payments, 'links'))
                            <div class="mt-3">
                                {{ $payments->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Dokumen Pendaftar</h5>
                        <p class="text-muted mb-0">Verifikasi dokumen yang diupload oleh pendaftar (Dikelompokkan per User)</p>
                    </div>
                    <div class="card-body">
                        <!-- Filter Status -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="btn-group" role="group">
                                    <a href="?status=" class="btn btn-outline-primary btn-sm">Semua</a>
                                    <a href="?status=pending" class="btn btn-outline-warning btn-sm">Menunggu Verifikasi</a>
                                    <a href="?status=disetujui" class="btn btn-outline-success btn-sm">Disetujui</a>
                                    <a href="?status=ditolak" class="btn btn-outline-danger btn-sm">Ditolak</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="25%">Nama Pendaftar</th>
                                        <th width="20%">Email</th>
                                        <th width="12%">Jumlah Dokumen</th>
                                        <th width="18%">Status Dokumen</th>
                                        <th width="12%">Status Pembayaran</th>
                                        <th width="8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Group dokumen by user_id
                                        $dokumensByUser = $dokumens->groupBy('user_id');
                                        $counter = 1;
                                    @endphp
                                    
                                    @forelse ($dokumensByUser as $userId => $userDokumens)
                                        @php
                                            $user = $userDokumens->first()->user;
                                            $totalDocs = $userDokumens->count();
                                            $pendingDocs = $userDokumens->where('status_verifikasi', 'pending')->count();
                                            $disetujuiDocs = $userDokumens->where('status_verifikasi', 'disetujui')->count();
                                            $ditolakDocs = $userDokumens->where('status_verifikasi', 'ditolak')->count();
                                            
                                            $paymentStatus = $user->payments->sortByDesc('created_at')->first()?->status ?? 'none';
                                        @endphp
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>
                                                <strong>{{ $user->name ?? '-' }}</strong>
                                            </td>
                                            <td><small>{{ $user->email ?? '-' }}</small></td>
                                            <td class="text-center">
                                                <span class="badge bg-info">{{ $totalDocs }} Dokumen</span>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @if($pendingDocs > 0)
                                                        <span class="badge bg-warning text-dark">{{ $pendingDocs }} Menunggu</span>
                                                    @endif
                                                    @if($disetujuiDocs > 0)
                                                        <span class="badge bg-success">{{ $disetujuiDocs }} Disetujui</span>
                                                    @endif
                                                    @if($ditolakDocs > 0)
                                                        <span class="badge bg-danger">{{ $ditolakDocs }} Ditolak</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($paymentStatus === 'verified')
                                                    <span class="badge bg-success">Lunas</span>
                                                @elseif ($paymentStatus === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif ($paymentStatus === 'rejected')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @else
                                                    <span class="badge bg-secondary">Belum Bayar</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary w-100" onclick="toggleDetails({{ $userId }})">
                                                    <i class="feather icon-chevron-down" id="icon-{{ $userId }}"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Collapsed detail row -->
                                        <tr id="user-docs-{{ $userId }}" style="display: none;">
                                            <td colspan="7" class="p-0">
                                                <div class="bg-light border-top border-bottom">
                                                    <div class="p-4">
                                                        <h6 class="mb-3">
                                                            <i class="feather icon-file-text text-primary"></i> 
                                                            <strong>Daftar Dokumen {{ $user->name }}</strong>
                                                        </h6>
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-bordered bg-white mb-0">
                                                                <thead class="table-secondary">
                                                                    <tr>
                                                                        <th width="5%">No.</th>
                                                                        <th width="30%">Nama Dokumen</th>
                                                                        <th width="10%">Tipe</th>
                                                                        <th width="12%">Status</th>
                                                                        <th width="18%">Tanggal Upload</th>
                                                                        <th width="25%">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($userDokumens as $index => $dok)
                                                                        <tr>
                                                                            <td class="text-center">{{ $index + 1 }}</td>
                                                                            <td>{{ $dok->nama_dokumen }}</td>
                                                                            <td class="text-center">
                                                                                <span class="badge bg-secondary">{{ strtoupper($dok->file_type) }}</span>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                @if ($dok->status_verifikasi === 'pending')
                                                                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                                                                @elseif ($dok->status_verifikasi === 'disetujui')
                                                                                    <span class="badge bg-success">Disetujui</span>
                                                                                @else
                                                                                    <span class="badge bg-danger">Ditolak</span>
                                                                                @endif
                                                                            </td>
                                                                            <td class="text-center">{{ $dok->created_at->format('d/m/Y H:i') }}</td>
                                                                            <td class="text-center">
                                                                                <div class="btn-group" role="group">
                                                                                    <a href="{{ asset('storage/'.$dok->file_path) }}" target="_blank" class="btn btn-sm btn-info" title="Lihat Dokumen">
                                                                                        <i class="feather icon-eye"></i> Lihat
                                                                                    </a>
                                                                                    @if($dok->status_verifikasi !== 'disetujui')
                                                                                        <button type="button" class="btn btn-sm btn-success" onclick="setujui({{ $dok->id }})" title="Setujui">
                                                                                            <i class="feather icon-check"></i> Setujui
                                                                                        </button>
                                                                                    @endif
                                                                                    @if($dok->status_verifikasi !== 'ditolak')
                                                                                        <button type="button" class="btn btn-sm btn-danger" onclick="tolak({{ $dok->id }})" title="Tolak">
                                                                                            <i class="feather icon-x"></i> Tolak
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
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-5">
                                                <i class="feather icon-info"></i> Belum ada data dokumen.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if (method_exists($dokumens, 'links'))
                            <div class="mt-3">
                                {{ $dokumens->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- [ Modal Verifikasi ] start -->
        <div class="modal fade" id="modalVerifikasi" tabindex="-1" role="dialog" aria-labelledby="modalVerifikasiLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalVerifikasiLabel">Verifikasi Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="documentPreview">
                            <p class="text-muted text-center">Preview dokumen akan ditampilkan di sini</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-danger" id="btnTolak">Tolak</button>
                        <button type="button" class="btn btn-success" id="btnSetujui">Setujui</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Modal Verifikasi ] end -->

        <!-- [ Modal Catatan ] start -->
        <div class="modal fade" id="modalCatatan" tabindex="-1" role="dialog" aria-labelledby="modalCatatanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCatatanLabel">Catatan Verifikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Catatan / Alasan Penolakan</label>
                            <textarea class="form-control" id="catatanVerifikasi" rows="4" placeholder="Masukkan catatan verifikasi..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="btnSimpanCatatan">Simpan Catatan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Modal Catatan ] end -->
    </div>

    <script>
        function toggleDetails(userId) {
            const detailRow = document.getElementById('user-docs-' + userId);
            const icon = document.getElementById('icon-' + userId);
            
            if (detailRow.style.display === 'none') {
                detailRow.style.display = 'table-row';
                icon.className = 'feather icon-chevron-up';
            } else {
                detailRow.style.display = 'none';
                icon.className = 'feather icon-chevron-down';
            }
        }

        function updateStatus(id, status, catatan = null) {
            fetch(`/dokumen/${id}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status_verifikasi: status, catatan_verifikasi: catatan })
            })
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    location.reload();
                } else {
                    alert(d.message || 'Gagal memperbarui status');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan saat memperbarui status');
            });
        }

        function setujui(id) { updateStatus(id, 'disetujui'); }
        function tolak(id) {
            const catatan = prompt('Masukkan catatan/alasan penolakan (opsional)');
            updateStatus(id, 'ditolak', catatan || null);
        }

        function updatePaymentStatus(id, status, notes = null) {
            fetch(`/payment/${id}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status, notes: notes })
            })
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    location.reload();
                } else {
                    alert(d.message || 'Gagal memperbarui status pembayaran');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan saat memperbarui status pembayaran');
            });
        }

        function setujuiPayment(id) { updatePaymentStatus(id, 'verified'); }
        function tolakPayment(id) {
            const notes = prompt('Masukkan alasan penolakan pembayaran (opsional)');
            updatePaymentStatus(id, 'rejected', notes || null);
        }
    </script>
@endsection
