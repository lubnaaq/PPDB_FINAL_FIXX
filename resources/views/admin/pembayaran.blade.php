@extends('layouts.dashboard')
@section('title', 'Verifikasi Pembayaran')
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
                            <li class="breadcrumb-item" aria-current="page">Verifikasi Pembayaran</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Verifikasi Pembayaran Pendaftar</h2>
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
                        <!-- Filters -->
                        <div class="d-flex gap-2 mb-3">
                            <a href="{{ route('admin.pembayaran') }}"
                                class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
                            <a href="{{ route('admin.pembayaran', ['status' => 'pending']) }}"
                                class="btn btn-sm {{ request('status') == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">Menunggu
                                Verifikasi</a>
                            <a href="{{ route('admin.pembayaran', ['status' => 'verified']) }}"
                                class="btn btn-sm {{ request('status') == 'verified' ? 'btn-success' : 'btn-outline-success' }}">Terverifikasi</a>
                            <a href="{{ route('admin.pembayaran', ['status' => 'rejected']) }}"
                                class="btn btn-sm {{ request('status') == 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">Ditolak</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-center">
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
                                        <tr class="align-middle">
                                            <td class="text-center">{{ ($payments->currentPage() - 1) * $payments->perPage() + $i + 1 }}</td>
                                            <td>
                                                {{ $pay->user->name ?? '-' }}
                                                @if (optional(optional($pay->user)->biodata)->kelas)
                                                    <br>
                                                    <small
                                                        class="text-success fw-bold">{{ $pay->user->biodata->kelas->nama_kelas }}</small>
                                                @endif
                                            </td>
                                            <td class="text-center">Rp {{ number_format($pay->amount, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($pay->payment_date)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                @if ($pay->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                                @elseif ($pay->status === 'verified')
                                                    <span class="badge bg-success">Terverifikasi</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($pay->status === 'rejected')
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        onclick="showRejectedInfo()">
                                                        <i class="feather icon-eye-off"></i> Lihat
                                                    </button>
                                                @else
                                                    <a href="{{ asset('storage/' . $pay->proof_file_path) }}"
                                                        target="_blank" class="btn btn-sm btn-info">
                                                        <i class="feather icon-eye"></i> Lihat
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($pay->status === 'pending')
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            onclick="setujuiPayment({{ $pay->id }})">
                                                            <i class="feather icon-check"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="tolakPayment({{ $pay->id }})">
                                                            <i class="feather icon-x"></i>
                                                        </button>
                                                    </div>
                                                @endif
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
                        <div class="mt-3">
                            {{ $payments->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts for Payment Action (SweetAlert2) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showRejectedInfo() {
            Swal.fire({
                title: 'Bukti Tidak Tersedia',
                text: "Bukti pembayaran ini tidak dapat dibuka karena telah ditolak. User harus mengupload bukti baru.",
                icon: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }

        function setujuiPayment(id) {
            Swal.fire({
                title: 'Setujui Pembayaran?',
                text: "Status akan berubah menjadi Terverifikasi",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!'
            }).then((result) => {
                if (result.isConfirmed) {
                    updatePaymentStatus(id, 'verified');
                }
            })
        }

        function tolakPayment(id) {
            Swal.fire({
                title: 'Tolak Pembayaran?',
                input: 'textarea',
                inputLabel: 'Alasan Penolakan',
                inputPlaceholder: 'Tuliskan alasan penolakan...',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Tolak',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Anda harus menuliskan alasan!'
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    updatePaymentStatus(id, 'rejected', result.value);
                }
            })
        }

        function updatePaymentStatus(id, status, notes = null) {
            fetch(`/admin/payment/${id}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status,
                        notes: notes
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Berhasil!',
                            data.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            data.message,
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan pada server',
                        'error'
                    );
                });
        }
    </script>
@endsection
