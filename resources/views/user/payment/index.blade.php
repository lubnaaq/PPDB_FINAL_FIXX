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

                        @if (isset($jurusan) && $jurusan)
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <i class="feather icon-info me-2 f-20"></i>
                                <div>
                                    <h5 class="alert-heading mb-1">Informasi Biaya Jurusan</h5>
                                    <p class="mb-0">Jurusan: <strong>{{ $jurusan->nama }}</strong></p>
                                    <p class="mb-0">Gelombang saat ini: <strong id="gelombangText">Mendeteksi...</strong>
                                    </p>
                                    <p class="mb-0">Biaya yang harus dibayar: <strong id="biayaText">Rp 0</strong></p>
                                </div>
                            </div>
                        @endif

                        @php
                            $isLunas =
                                $payments->where('payment_method', 'lunas')->where('status', 'verified')->count() > 0;
                            $isPending = $payments->where('status', 'pending')->count() > 0;
                        @endphp

                        @if ($isLunas)
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fas fa-check-circle fa-2x me-3"></i>
                                <div>
                                    <h4 class="alert-heading">Pembayaran Lunas</h4>
                                    <p class="mb-0">Terima kasih, pembayaran Anda telah lunas. Tidak perlu melakukan
                                        upload lagi.</p>
                                </div>
                            </div>
                        @elseif ($isPending)
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <i class="fas fa-clock fa-2x me-3"></i>
                                <div>
                                    <h4 class="alert-heading">Menunggu Verifikasi</h4>
                                    <p class="mb-0">Pembayaran Anda sedang diverifikasi. Mohon tunggu sebelum melakukan
                                        upload ulang.</p>
                                </div>
                            </div>
                        @else
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
                                                <input type="text" class="form-control" id="totalBiaya" readonly>
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
                                            <label class="form-label">Jumlah Angsuran <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control @error('installment_count') is-invalid @enderror"
                                                name="installment_count" id="installment_count">
                                                <option value="">-- Pilih Angsuran --</option>
                                                <option value="2">2 Bulan</option>
                                                <option value="3">3 Bulan</option>
                                                <option value="4">4 Bulan</option>
                                            </select>
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
                                                    name="amount" id="amount" value="{{ old('amount') }}" required
                                                    min="1000" readonly>
                                                <span class="input-group-text" id="amountFormatted">0</span>
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
                                        value="1">

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
                                                    <a href="{{ asset('storage/' . $payment->proof_file_path) }}"
                                                        target="_blank" class="btn btn-sm btn-info">Lihat</a>
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

    <script>
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

        let totalPrice = 0;

        document.addEventListener('DOMContentLoaded', function() {
            const jurusan = @json($jurusan ?? null);

            if (jurusan) {
                // Gunakan tanggal dari device user
                const today = new Date();

                // Tentukan batas akhir Gelombang 1
                // Contoh: 31 Mei 2026
                // Format: YYYY-MM-DD
                const cutoffDate = new Date('2026-05-31');

                let price = 0;
                let gelombang = '';

                // Bandingkan tanggal hari ini dengan batas akhir gelombang 1
                if (today <= cutoffDate) {
                    price = parseFloat(jurusan.harga_gelombang_1);
                    gelombang = 'Gelombang 1 (s/d 31 Mei 2026)';
                } else {
                    price = parseFloat(jurusan.harga_gelombang_2);
                    gelombang = 'Gelombang 2 (Mulai 1 Juni 2026)';
                }

                totalPrice = price;

                // Update UI Elements
                const totalBiaya = document.getElementById('totalBiaya');
                const amountInput = document.getElementById('amount');
                const amountFormatted = document.getElementById('amountFormatted');
                const gelombangText = document.getElementById('gelombangText');
                const biayaText = document.getElementById('biayaText');
                const totalAmountInput = document.getElementById('total_amount');

                // Set total biaya
                if (totalBiaya) {
                    totalBiaya.value = formatCurrency(price);
                }

                // Set nilai default (lunas)
                if (amountInput) {
                    amountInput.value = price;
                    amountInput.readOnly = true;
                }

                if (totalAmountInput) {
                    totalAmountInput.value = price;
                }

                // Update tampilan format currency
                if (amountFormatted) {
                    amountFormatted.textContent = formatCurrency(price);
                }

                if (gelombangText) {
                    gelombangText.textContent = gelombang;
                }

                if (biayaText) {
                    biayaText.textContent = 'Rp ' + formatCurrency(price);
                }
            }

            // Handle metode pembayaran change
            const paymentMethodSelect = document.getElementById('payment_method');
            const angsuranOptions = document.getElementById('angsuranOptions');
            const installmentCountSelect = document.getElementById('installment_count');
            const installmentSummary = document.getElementById('installmentSummary');

            if (paymentMethodSelect) {
                paymentMethodSelect.addEventListener('change', function() {
                    const method = this.value;
                    const amountInput = document.getElementById('amount');
                    const amountFormatted = document.getElementById('amountFormatted');

                    if (method === 'angsuran') {
                        angsuranOptions.style.display = 'block';
                        installmentCountSelect.required = true;
                    } else if (method === 'lunas') {
                        angsuranOptions.style.display = 'none';
                        installmentSummary.style.display = 'none';
                        installmentCountSelect.required = false;
                        installmentCountSelect.value = '';

                        // Set kembali ke harga penuh
                        if (amountInput) {
                            amountInput.value = totalPrice;
                        }
                        if (amountFormatted) {
                            amountFormatted.textContent = formatCurrency(totalPrice);
                        }
                    } else {
                        angsuranOptions.style.display = 'none';
                        installmentSummary.style.display = 'none';
                        installmentCountSelect.required = false;
                    }
                });
            }

            // Handle installment count change
            if (installmentCountSelect) {
                installmentCountSelect.addEventListener('change', function() {
                    const count = parseInt(this.value);

                    if (count > 0 && totalPrice > 0) {
                        calculateInstallments(count, totalPrice);
                        installmentSummary.style.display = 'block';
                    } else {
                        installmentSummary.style.display = 'none';
                    }
                });
            }
        });

        function calculateInstallments(count, total) {
            const amountInput = document.getElementById('amount');
            const amountFormatted = document.getElementById('amountFormatted');
            const installmentDetails = document.getElementById('installmentDetails');
            const firstInstallment = document.getElementById('firstInstallment');

            // Hitung angsuran per bulan
            const perMonth = Math.ceil(total / count);

            // Hitung sisa untuk pembayaran terakhir (jika ada selisih karena pembulatan)
            const lastPayment = total - (perMonth * (count - 1));

            // Set nilai untuk pembayaran pertama
            if (amountInput) {
                amountInput.value = perMonth;
            }
            if (amountFormatted) {
                amountFormatted.textContent = formatCurrency(perMonth);
            }
            if (firstInstallment) {
                firstInstallment.textContent = 'Rp ' + formatCurrency(perMonth);
            }

            // Buat detail angsuran
            let detailsHTML = '<ul class="mb-0">';
            for (let i = 1; i <= count; i++) {
                const amount = (i === count) ? lastPayment : perMonth;
                const status = (i === 1) ? ' <span class="badge bg-warning">Bayar Sekarang</span>' : '';
                detailsHTML += `<li>Angsuran ke-${i}: Rp ${formatCurrency(amount)}${status}</li>`;
            }
            detailsHTML += '</ul>';
            detailsHTML += `<hr><p class="mb-0"><strong>Total:</strong> Rp ${formatCurrency(total)}</p>`;

            if (installmentDetails) {
                installmentDetails.innerHTML = detailsHTML;
            }
        }
    </script>
@endsection
