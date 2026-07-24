<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Hero Section -->
<div class="glass-card p-4 p-md-5 mb-5 text-center position-relative overflow-hidden animate__animated animate__fadeInDown">
    <div class="row justify-content-center py-4">
        <div class="col-lg-8">
            <span class="badge bg-emerald text-white px-3 py-2 rounded-pill mb-3 shadow-sm" style="background: var(--primary-emerald); font-size: 12px; letter-spacing: 1px;">
                <i class="fa-solid fa-sparkles me-1"></i> INVENTORY MANAGEMENT SYSTEM
            </span>
            <h1 class="display-5 fw-bold text-dark mb-3">
                Kelola Inventaris Produk Lebih <span style="color: var(--primary-emerald);">Cepat & Modern</span>
            </h1>
            <p class="lead text-muted mb-4 fs-6" style="max-width: 650px; margin: 0 auto;">
                Platform manajemen stok dan data produk yang dirancang elegan, sejuk di mata, dan efisien untuk membantu operasional bisnis kamu.
            </p>
            
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="/products" class="btn btn-emerald btn-lg px-4 fs-6 shadow-sm">
                    <i class="fa-solid fa-box-archive me-2"></i> Lihat Katalog Produk
                </a>
                <?php if (!session()->get('isLoggedIn')) : ?>
                    <a href="/login" class="btn btn-light border btn-lg px-4 fs-6 text-muted shadow-sm">
                        <i class="fa-solid fa-right-to-bracket me-2"></i> Masuk Sekarang
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Grid Keunggulan / Fitur Utama -->
<div class="row g-4 mb-5 animate__animated animate__fadeInUp animate__delay-1s">
    <!-- Fitur 1 -->
    <div class="col-md-4">
        <div class="glass-card p-4 h-100 text-center hover-card">
            <div class="bg-primary bg-opacity-10 text-primary d-inline-flex p-3 rounded-4 mb-3 fs-3" style="color: var(--primary-emerald) !important; background-color: rgba(13, 148, 136, 0.1) !important;">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">Update Real-Time</h5>
            <p class="text-muted small mb-0">
                Data produk yang baru ditambah, diubah, atau dihapus akan langsung terurut secara otomatis di posisi teratas.
            </p>
        </div>
    </div>

    <!-- Fitur 2 -->
    <div class="col-md-4">
        <div class="glass-card p-4 h-100 text-center hover-card">
            <div class="bg-success bg-opacity-10 text-success d-inline-flex p-3 rounded-4 mb-3 fs-3">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">Akses Terkontrol</h5>
            <p class="text-muted small mb-0">
                Fitur pengelolaan seperti Tambah, Edit, dan Hapus dilindungi secara aman berdasarkan peran akun (Admin).
            </p>
        </div>
    </div>

    <!-- Fitur 3 -->
    <div class="col-md-4">
        <div class="glass-card p-4 h-100 text-center hover-card">
            <div class="bg-info bg-opacity-10 text-info d-inline-flex p-3 rounded-4 mb-3 fs-3">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">Tampilan Ringkas</h5>
            <p class="text-muted small mb-0">
                Antarmuka *Glassmorphism* yang sejuk dan bersih membuat navigasi serta pemantauan stok jadi lebih nyaman.
            </p>
        </div>
    </div>
</div>

<!-- Quick Banner Status Login -->
<div class="glass-card p-4 mb-4 bg-white bg-opacity-50 border-0 animate__animated animate__fadeInUp animate__delay-1s">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-teal p-3 rounded-circle text-white d-flex align-items-center justify-content-center" style="background: var(--primary-emerald); width: 48px; height: 48px;">
                <i class="fa-solid fa-user-check fs-5"></i>
            </div>
            <div>
                <?php if (session()->get('isLoggedIn')) : ?>
                    <h6 class="fw-bold mb-0 text-dark">Selamat datang kembali, <?= esc(session()->get('username')); ?>!</h6>
                    <small class="text-muted">Anda masuk sebagai <span class="badge bg-info text-dark"><?= strtoupper(session()->get('role')); ?></span>. Silakan kelola inventaris Anda.</small>
                <?php else : ?>
                    <h6 class="fw-bold mb-0 text-dark">Anda Belum Login</h6>
                    <small class="text-muted">Silakan masuk ke akun Anda untuk mendapatkan akses penuh ke manajemen produk.</small>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <?php if (session()->get('isLoggedIn')) : ?>
                <a href="/products" class="btn btn-outline-secondary btn-sm px-3 rounded-3">
                    Buka Katalog <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            <?php else : ?>
                <a href="/login" class="btn btn-emerald btn-sm px-3 shadow-sm">
                    Login Sistem <i class="fa-solid fa-right-to-bracket ms-1"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -10px rgba(13, 148, 136, 0.15) !important;
    }
</style>

<?= $this->endSection(); ?>