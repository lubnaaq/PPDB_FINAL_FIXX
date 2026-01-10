@extends('layouts.dashboard')
@section('title', 'Pembayaran')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Pembayaran</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Pembayaran Pendaftaran</h2>
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
                        <h5>Form Upload Bukti Pembayaran</h5>
                        <p class="text-muted mb-0">Silakan upload bukti pembayaran pendaftaran.</p>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (!$jurusan)
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                                <div>
                                    <h4 class="alert-heading">Jurusan Belum Dipilih</h4>
                                    <p class="mb-0">Anda belum memilih jurusan. Silakan lengkapi biodata dan pilih jurusan
                                        terlebih dahulu sebelum melakukan pembayaran.</p>
                                    <a href="{{ route('user.biodata') }}" class="btn btn-danger mt-2">Lengkapi Biodata</a>
                                </div>
                            </div>
                        @endif

                        @if (isset($jurusan) && $jurusan)
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <i class="feather icon-info me-2 f-20"></i>
                                <div>
                                    <h5 class="alert-heading mb-1">Informasi Biaya Jurusan</h5>
                                    <p class="mb-0">Jurusan: <strong>{{ $jurusan->nama }}</strong></p>
                                    <p class="mb-0">Gelombang:
                                        <strong>{{ isset($gelombang) && $gelombang ? $gelombang->nama : 'Umum' }}</strong>
                                    </p>
                                    @if (isset($basePrice) && $basePrice > 0)
                                        <p class="mb-0">Biaya Dasar: Rp {{ number_format($basePrice, 0, ',', '.') }}</p>
                                    @endif
                                    @if (isset($potongan) && $potongan > 0)
                                        <p class="mb-0">Potongan Gelombang: <span class="text-success">- Rp
                                                {{ number_format($potongan, 0, ',', '.') }}</span></p>
                                    @endif
                                    <p class="mb-0 mt-1"><strong>Total Biaya: Rp
                                            {{ number_format($totalBiaya, 0, ',', '.') }}</strong></p>
                                </div>
                            </div>
                        @endif

                        @if ($isLunas)
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fas fa-check-circle fa-2x me-3"></i>
                                <div>
                                    <h4 class="alert-heading">Pembayaran Lunas</h4>
                                    <p class="mb-0">Terima kasih, pembayaran Anda telah lunas. Total Biaya:
                                        <strong>Rp {{ number_format($totalBiaya, 0, ',', '.') }}</strong>
                                    </p>
                                </div>
                            </div>
                        @elseif ($hasPending)
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <i class="fas fa-clock fa-2x me-3"></i>
                                <div>
                                    <h4 class="alert-heading">Menunggu Verifikasi</h4>
                                    <p class="mb-0">Pembayaran Anda sedang diverifikasi. Mohon tunggu.
                                        Jika ada kesalahan, Anda dapat mengedit bukti pembayaran di tabel riwayat di bawah.
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                                <i class="fas fa-wallet fa-2x me-3"></i>
                                <div>
                                    <h5 class="alert-heading">Status Pembayaran</h5>
                                    <ul class="mb-0 ps-3">
                                        <li>Total Biaya: <strong>Rp {{ number_format($totalBiaya, 0, ',', '.') }}</strong>
                                        </li>
                                        <li>Sudah Terbayar: <strong class="text-success">Rp
                                                {{ number_format($totalTerbayar, 0, ',', '.') }}</strong></li>
                                        <li>Sisa Tagihan: <strong class="text-danger">Rp
                                                {{ number_format($sisaTagihan, 0, ',', '.') }}</strong></li>
                                        @if ($angsuranKe > 1)
                                            <li>Pembayaran Selanjutnya: <strong>Angsuran ke-{{ $angsuranKe }}</strong>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            <!-- Informasi Rekening Pembayaran -->
                            <div class="card bg-light-primary mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-primary mb-3"><i class="fas fa-wallet me-2"></i>Metode
                                        Pembayaran Tersedia</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                                                <div class="flex-shrink-0">
                                                    <i class="fas fa-university fa-2x text-primary"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">Bank BRI</h6>
                                                    <p class="mb-0 fw-bold fs-5">1234-5678-9012-3456</p>
                                                    <small class="text-muted">a.n. SMK Unggulan</small>
                                                </div>
                                                <button class="btn btn-sm btn-light-primary"
                                                    onclick="copyToClipboard('1234567890123456')"
                                                    title="Salin No. Rekening"><i class="far fa-copy"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                                                <div class="flex-shrink-0">
                                                    <i class="fas fa-university fa-2x text-info"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">Bank Mandiri</h6>
                                                    <p class="mb-0 fw-bold fs-5">123-45-6789012-3</p>
                                                    <small class="text-muted">a.n. SMK Unggulan</small>
                                                </div>
                                                <button class="btn btn-sm btn-light-primary"
                                                    onclick="copyToClipboard('1234567890123')" title="Salin No. Rekening"><i
                                                        class="far fa-copy"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                                                <div class="flex-shrink-0">
                                                    <i class="fas fa-university fa-2x text-success"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">Bank BSI</h6>
                                                    <p class="mb-0 fw-bold fs-5">7123456789</p>
                                                    <small class="text-muted">a.n. SMK Unggulan</small>
                                                </div>
                                                <button class="btn btn-sm btn-light-primary"
                                                    onclick="copyToClipboard('7123456789')" title="Salin No. Rekening"><i
                                                        class="far fa-copy"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                                                <div class="flex-shrink-0">
                                                    <i class="fas fa-wallet fa-2x text-warning"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">DANA / OVO / GoPay</h6>
                                                    <p class="mb-0 fw-bold fs-5">0812-3456-7890</p>
                                                    <small class="text-muted">a.n. Bendahara Sekolah</small>
                                                </div>
                                                <button class="btn btn-sm btn-light-primary"
                                                    onclick="copyToClipboard('081234567890')" title="Salin Nomor"><i
                                                        class="far fa-copy"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-warning mb-0 mt-2">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <small>Harap transfer sesuai dengan nominal yang tertera. Simpan bukti transfer
                                            untuk diupload pada form di bawah ini.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Form -->
                            <form id="paymentForm" method="POST" action="{{ route('payment.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Total Biaya Pendaftaran <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" class="form-control" id="totalBiaya" readonly
                                                    value="{{ number_format($totalBiaya, 0, ',', '.') }}">
                                            </div>
                                            <small class="form-text text-muted d-block mt-2">
                                                <i class="feather icon-info"></i> Total biaya berdasarkan jurusan dan
                                                gelombang yang dipilih
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Metode Pembayaran <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control @error('payment_method') is-invalid @enderror"
                                                name="payment_method" id="payment_method" required>
                                                <option value="">-- Pilih Metode --</option>
                                                <option value="lunas">Lunas (Bayar Penuh)</option>
                                                <option value="angsuran">Angsuran (Cicilan)</option>
                                            </select>
                                            @error('payment_method')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="angsuranOptions" style="display: none;">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Rencana Angsuran <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control @error('installment_count') is-invalid @enderror"
                                                name="installment_count" id="installment_count">
                                                <option value="">-- Pilih Lama Angsuran --</option>
                                                <option value="2">2 Bulan (2x Pembayaran)</option>
                                                <option value="3">3 Bulan (3x Pembayaran)</option>
                                                <option value="4">4 Bulan (4x Pembayaran)</option>
                                                <option value="5">5 Bulan (5x Pembayaran)</option>
                                                <option value="6">6 Bulan (6x Pembayaran)</option>
                                            </select>
                                            <small class="text-muted">Pilih berapa kali pembayaran yang diinginkan (Max 6
                                                bulan).</small>
                                            @error('installment_count')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Ringkasan Angsuran -->
                                    <div class="col-md-12" id="installmentSummary" style="display: none;">
                                        <div class="alert alert-info">
                                            <h6 class="alert-heading"><i class="feather icon-calendar"></i> Rincian
                                                Angsuran</h6>
                                            <div id="installmentDetails"></div>
                                            <p class="mb-0 mt-2"><strong>Pembayaran pertama (saat ini):</strong> <span
                                                    id="firstInstallment">Rp 0</span></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Jumlah Pembayaran Saat Ini (Rp) <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    name="amount" id="amount"
                                                    value="{{ old('amount', $angsuranKe > 1 ? $sisaTagihan : $totalBiaya) }}"
                                                    required min="1000" readonly>
                                                <span class="input-group-text"
                                                    id="amountFormatted">{{ number_format($angsuranKe > 1 ? $sisaTagihan : $totalBiaya, 0, ',', '.') }}</span>
                                            </div>
                                            <small class="form-text text-muted d-block mt-2">
                                                <i class="feather icon-info"></i> Jumlah yang harus dibayar saat ini
                                            </small>
                                            @error('amount')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Tanggal Pembayaran <span
                                                    class="text-danger">*</span></label>
                                            <input type="date"
                                                class="form-control @error('payment_date') is-invalid @enderror"
                                                name="payment_date" id="payment_date"
                                                value="{{ old('payment_date', \Carbon\Carbon::today()->format('Y-m-d')) }}"
                                                required>
                                            @error('payment_date')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Hidden fields untuk angsuran -->
                                    <input type="hidden" name="total_amount" id="total_amount" value="0">
                                    <input type="hidden" name="installment_number" id="installment_number"
                                        value="{{ $angsuranKe ?? 1 }}">

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Bukti Pembayaran <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file"
                                                    class="form-control @error('proof_file') is-invalid @enderror"
                                                    name="proof_file" id="proof_file" accept=".pdf,.jpg,.jpeg,.png"
                                                    required>
                                                <span class="input-group-text">
                                                    <i class="feather icon-upload-cloud"></i>
                                                </span>
                                            </div>
                                            <small class="form-text text-muted d-block mt-2">
                                                <i class="feather icon-info"></i> Format: PDF, JPG, JPEG, PNG (Maksimal
                                                2MB)
                                            </small>
                                            @error('proof_file')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="feather icon-upload"></i> Upload Bukti
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- [ Daftar Pembayaran ] start -->
        @if ($payments && count($payments) > 0)
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Riwayat Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Metode</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Bukti</th>
                                            <th>Status</th>
                                            <th>Tanggal Upload</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $key => $payment)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    @if ($payment->payment_method === 'angsuran')
                                                        <span class="badge bg-info">Angsuran</span>
                                                    @else
                                                        <span class="badge bg-success">Lunas</span>
                                                    @endif
                                                </td>
                                                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    <small>{{ $payment->notes ?? '-' }}</small>
                                                </td>
                                                <td>
                                                    @if ($payment->status === 'rejected')
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            onclick="showRejectedInfo()">
                                                            <i class="feather icon-eye-off"></i> Lihat
                                                        </button>
                                                    @else
                                                        <a href="{{ asset('storage/' . $payment->proof_file_path) }}"
                                                            target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($payment->status === 'pending')
                                                        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                                    @elseif ($payment->status === 'verified')
                                                        <span class="badge bg-success">Terverifikasi</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    @if ($payment->status === 'verified')
                                                        <a href="{{ route('payment.receipt', $payment->id) }}"
                                                            target="_blank" class="btn btn-sm btn-secondary"
                                                            title="Cetak Kuitansi">
                                                            <i class="feather icon-printer"></i>
                                                        </a>
                                                    @elseif ($payment->status === 'pending' || $payment->status === 'rejected')
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editPaymentModal{{ $payment->id }}"
                                                            title="Ganti Bukti">
                                                            <i class="feather icon-edit"></i>
                                                        </button>

                                                        <!-- Modal Edit -->
                                                        <div class="modal fade" id="editPaymentModal{{ $payment->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form
                                                                        action="{{ route('payment.update', $payment->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Ganti Bukti
                                                                                Pembayaran</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Upload ulang bukti pembayaran untuk mengganti
                                                                                file sebelumnya.</p>
                                                                            <div class="mb-3">
                                                                                <label
                                                                                    for="proof_file_{{ $payment->id }}"
                                                                                    class="form-label">Bukti Baru <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="file" class="form-control"
                                                                                    id="proof_file_{{ $payment->id }}"
                                                                                    name="proof_file"
                                                                                    accept=".pdf,.jpg,.jpeg,.png" required>
                                                                                <small class="text-muted">Format: JPG,
                                                                                    JPEG, PNG, PDF. Max 2MB.</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
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
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showRejectedInfo() {
            Swal.fire({
                title: 'Bukti Tidak Tersedia',
                text: "Bukti pembayaran ini tidak dapat dibuka karena telah ditolak. Silakan upload bukti baru.",
                icon: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Bisa tambahkan notifikasi toast disini jika mau
                alert('Nomor berhasil disalin: ' + text);
            }, function(err) {
                console.error('Gagal menyalin teks: ', err);
            });
        }

        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        }

        let totalPrice = {{ $totalBiaya ?? 0 }};
        const sisaTagihan = {{ $sisaTagihan ?? 0 }};
        const angsuranKe = {{ $angsuranKe ?? 1 }};

        document.addEventListener('DOMContentLoaded', function() {
            const jurusan = @json($jurusan ?? null);

            if (jurusan) {
                // Logic harga sudah dihandle di server (PaymentController)
                // Kita gunakan totalPrice dari server
                let price = totalPrice;

                // Jika sudah ada pembayaran, total yang harus dibayar sekarang adalah sisa tagihan
                let currentPayable = price;
                if (angsuranKe > 1) {
                    currentPayable = sisaTagihan;
                }

                // Update UI Elements
                const totalBiaya = document.getElementById('totalBiaya');
                const amountInput = document.getElementById('amount');
                const amountFormatted = document.getElementById('amountFormatted');
                const totalAmountInput = document.getElementById('total_amount');

                // Set total biaya
                if (totalBiaya) {
                    totalBiaya.value = formatCurrency(price);
                }

                // Set nilai default
                if (amountInput) {
                    amountInput.value = currentPayable;
                    amountInput.readOnly = true;
                }

                if (totalAmountInput) {
                    totalAmountInput.value = price;
                }

                if (amountFormatted) {
                    amountFormatted.textContent = formatCurrency(currentPayable);
                }
            }

            // Handle metode pembayaran change
            const paymentMethodSelect = document.getElementById('payment_method');
            // const angsuranInfo = document.getElementById('angsuranInfo');
            const angsuranOptions = document.getElementById('angsuranOptions');
            const installmentCountSelect = document.getElementById('installment_count');
            const installmentSummary = document.getElementById('installmentSummary');

            function updateAmount() {
                const method = paymentMethodSelect.value;
                const amountInput = document.getElementById('amount');
                const amountFormatted = document.getElementById('amountFormatted');

                if (method === 'angsuran') {
                    const months = parseInt(installmentCountSelect.value);
                    if (months) {
                        let monthlyAmount = Math.ceil(totalPrice / months);

                        // Cap at sisaTagihan
                        if (monthlyAmount > sisaTagihan) {
                            monthlyAmount = sisaTagihan;
                        }

                        if (amountInput) {
                            amountInput.value = monthlyAmount;
                        }
                        if (amountFormatted) {
                            amountFormatted.textContent = formatCurrency(monthlyAmount);
                        }
                    } else {
                        // Reset if no month selected
                        if (amountInput) amountInput.value = 0;
                        if (amountFormatted) amountFormatted.textContent = 0;
                    }
                } else if (method === 'lunas') {
                    let payAmount = (angsuranKe > 1) ? sisaTagihan : totalPrice;
                    if (amountInput) {
                        amountInput.value = payAmount;
                    }
                    if (amountFormatted) {
                        amountFormatted.textContent = formatCurrency(payAmount);
                    }
                }
            }

            if (paymentMethodSelect) {
                paymentMethodSelect.addEventListener('change', function() {
                    const method = this.value;
                    // Simplify logic: 
                    // Show options ONLY if Angsuran AND First Installment (angsuranKe == 1).
                    // If angsuranKe > 1, options are hidden because plan is locked/irrelevant.

                    const showOptions = (method === 'angsuran' && angsuranKe === 1);

                    if (angsuranOptions) {
                        angsuranOptions.style.display = showOptions ? 'block' : 'none';
                    }

                    if (installmentCountSelect) {
                        installmentCountSelect.required = showOptions;
                        if (!showOptions && method !== 'angsuran') {
                            installmentCountSelect.value = ""; // Reset if not angsuran
                        }
                    }

                    if (installmentSummary) {
                        installmentSummary.style.display = 'none';
                    }

                    // Amount Calculation Handling
                    if (method === 'angsuran' && angsuranKe > 1) {
                        // Payment for existing installment plan (Sisa Tagihan)
                        const amountInput = document.getElementById('amount');
                        const amountFormatted = document.getElementById('amountFormatted');
                        if (amountInput) amountInput.value = sisaTagihan;
                        if (amountFormatted) amountFormatted.textContent = formatCurrency(sisaTagihan);
                    } else {
                        // Lunas OR First Installment (calculation handled by updateAmount)
                        updateAmount();
                    }
                });
            }

            if (installmentCountSelect) {
                installmentCountSelect.addEventListener('change', updateAmount);
            }
        }); // Closing DOMContentLoaded
    </script>
@endsection
