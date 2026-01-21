<div class="dashboard-background">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h2 class="mb-3 text-primary">
                            Selamat Datang, <span class="fw-bold">{{ Auth::user()->name }}</span>!
                        </h2>

                        @if (!$user->is_verified)
                            <div class="alert alert-warning d-flex align-items-center justify-content-between shadow-sm"
                                role="alert">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                                    <div>
                                        <strong>Email Anda belum terverifikasi.</strong> Silakan verifikasi terlebih
                                        dahulu
                                        untuk
                                        mengakses semua fitur.
                                    </div>
                                </div>

                                <a href="{{ route('verify.form') }}" id="verify-button"
                                    class="btn btn-warning btn-sm fw-bold">Verifikasi
                                    Sekarang</a>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <p class="lead mb-4">
                            Ini adalah <span class="fw-bold text-success">Dashboard</span> kamu untuk memantau progress
                            dan
                            status terkait <span class="text-info">PPDB</span>.
                            Silakan gunakan menu di samping untuk mengakses fitur-fitur seperti pendaftaran, pengumuman,
                            dan
                            lainnya.
                        </p>

                        <div class="row mt-4">
                            <div class="col-md-4 mb-3">
                                <div class="card border-info h-100">
                                    <div class="card-body">
                                        <i class="bi bi-person-lines-fill fs-2 text-info"></i>
                                        <h5 class="card-title mt-2">Pendaftaran</h5>
                                        <p class="card-text">Cek dan lengkapi data pendaftaran kamu di sini.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card border-success h-100">
                                    <div class="card-body">
                                        <i class="bi bi-bar-chart-line-fill fs-2 text-success"></i>
                                        <h5 class="card-title mt-2">Progress</h5>
                                        <p class="card-text">Pantau status dan tahapan seleksi PPDB.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card border-warning h-100">
                                    <div class="card-body">
                                        <i class="bi bi-megaphone-fill fs-2 text-warning"></i>
                                        <h5 class="card-title mt-2">Pengumuman</h5>
                                        <p class="card-text">Lihat pengumuman terbaru terkait PPDB.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="/myprofile" class="btn btn-primary mt-4 px-4">
                            Lihat Profil Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Script to handle the verification button click state
    const verifyButton = document.getElementById('verify-button');

    if (verifyButton) {
        verifyButton.addEventListener('click', function() {
            // Disable the button and show processing text
            this.classList.add('disabled');
            this.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Processing...
            `;
        });
    }
</script>

<style>
    /* Configurable theme variables (edit values to change colors) */
    :root {
        /* Background image (can be url('...') or none) */
        --bg-image-url: url('assets/images/user/image.png');

        /* Overlay card colors */
        --card-bg: rgba(255, 255, 255, 0.62);
        --card-header-bg: rgba(255, 255, 255, 0.90);

        /* Blur intensity (set to 0px to disable) */
        --card-blur: 6px;

        /* Accent colors (optional, for custom elements) */
        --accent-primary: #0d6efd;
        --accent-success: #198754;
        --accent-info: #0dc6f0;
        --accent-warning: #ffc107;
    }

    .dashboard-background {
        background-image: var(--bg-image-url);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        padding: 60px 0;
    }

    .dashboard-background .card {
        background-color: var(--card-bg);
        backdrop-filter: blur(var(--card-blur));
    }

    .dashboard-background .card .card-header {
        background-color: var(--card-header-bg);
    }
</style>
