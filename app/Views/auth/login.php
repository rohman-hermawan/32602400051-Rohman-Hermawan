<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row justify-content-center align-items-center min-vh-75 animate__animated animate__zoomIn animate__faster">
    <div class="col-md-5 col-lg-4">
        
        <!-- Logo / Brand Header -->
        <div class="text-center mb-4">
            <div class="bg-teal p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="background: var(--primary-emerald); width: 60px; height: 60px;">
                <i class="fa-solid fa-boxes-stacked text-white fs-3"></i>
            </div>
            <h3 class="fw-bold text-dark mb-1">Masuk Sistem</h3>
            <p class="text-muted small">Akses dashboard inventaris produk Anda</p>
        </div>

        <!-- Glassmorphism Login Card -->
        <div class="glass-card p-4">

            <!-- Alert Flashdata Error -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger custom-alert bg-danger bg-opacity-10 text-danger border-0 small mb-4 animate__animated animate__shakeX">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i><?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <!-- Form Login -->
            <form action="/login/process" method="post">
                <?= csrf_field(); ?>

                <!-- Input Username -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" name="username" class="form-control border-start-0 ps-0" placeholder="Masukkan username..." value="<?= old('username'); ?>" required autofocus>
                    </div>
                </div>

                <!-- Input Password -->
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="passwordInput" name="password" class="form-control border-start-0 border-end-0 ps-0" placeholder="Masukkan password..." required>
                        <button type="button" class="input-group-text bg-light border-start-0 text-muted" onclick="togglePassword()">
                            <i class="fa-solid fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-emerald w-100 py-2 mb-3 shadow-sm">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Masuk Sekarang
                </button>

                <!-- Footer Card -->
                <div class="text-center pt-2 border-top">
                    <a href="/" class="text-decoration-none small text-muted">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Script Toggle Show/Hide Password -->
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

<?= $this->endSection(); ?>