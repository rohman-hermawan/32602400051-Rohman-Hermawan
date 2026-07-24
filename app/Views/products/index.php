<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Ringkasan Stat Cards -->
<div class="row g-3 mb-4 animate__animated animate__fadeInDown">
    <div class="col-md-4">
        <div class="glass-card p-3 d-flex align-items-center gap-3">
            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 fs-4">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div>
                <div class="text-muted small fw-medium">Total Produk</div>
                <h4 class="fw-bold mb-0 text-dark"><?= count($products); ?> Item</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-3 d-flex align-items-center gap-3">
            <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 fs-4">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
                <div class="text-muted small fw-medium">Pengurutan Data</div>
                <h4 class="fw-bold mb-0 text-dark" style="font-size: 1.1rem;">Terbaru di Atas</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card p-3 d-flex align-items-center gap-3">
            <div class="bg-info bg-opacity-10 text-info p-3 rounded-4 fs-4">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div>
                <div class="text-muted small fw-medium">Peran Akses</div>
                <h4 class="fw-bold mb-0 text-dark" style="font-size: 1.1rem;"><?= strtoupper(session()->get('role')); ?></h4>
            </div>
        </div>
    </div>
</div>

<!-- Header & Tombol Tambah -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-box text-teal me-2" style="color: var(--primary-emerald);"></i>Katalog Produk</h3>
        <p class="text-muted small mb-0">Kelola daftar inventaris produk lengkap dengan foto visual.</p>
    </div>
    
    <?php if (session()->get('role') === 'admin') : ?>
        <a href="/products/create" class="btn btn-emerald shadow-sm animate__animated animate__pulse animate__infinite animate__slower">
            <i class="fa-solid fa-plus me-1"></i> Tambah Produk Baru
        </a>
    <?php endif; ?>
</div>

<!-- Alert Notifikasi -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success custom-alert bg-success bg-opacity-10 border-success border-opacity-20 text-success alert-dismissible fade show shadow-sm mb-4 animate__animated animate__fadeIn" role="alert">
        <i class="fa-solid fa-circle-check me-2 fs-5 align-middle"></i><?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger custom-alert bg-danger bg-opacity-10 border-danger border-opacity-20 text-danger alert-dismissible fade show shadow-sm mb-4 animate__animated animate__fadeIn" role="alert">
        <i class="fa-solid fa-triangle-exclamation me-2 fs-5 align-middle"></i><?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Table Card -->
<div class="glass-card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0">
            <thead class="bg-light border-bottom">
                <tr class="text-uppercase small text-muted fw-bold" style="letter-spacing: 0.5px;">
                    <th class="py-3 ps-4" style="width: 60px;">No</th>
                    <th class="py-3" style="width: 90px;">Gambar</th>
                    <th class="py-3">Nama Produk</th>
                    <th class="py-3">Harga</th>
                    <th class="py-3">Stok Unit</th>
                    <?php if (session()->get('role') === 'admin') : ?>
                        <th class="py-3 text-center" style="width: 180px;">Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)) : ?>
                    <tr>
                        <td colspan="<?= session()->get('role') === 'admin' ? '6' : '5'; ?>" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-box-open fs-1 d-block mb-3 text-black-50"></i>
                            Belum ada data produk yang tersimpan.
                        </td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; foreach ($products as $p) : ?>
                        <tr class="border-bottom border-light hover-row" style="transition: background-color 0.2s ease;">
                            <td class="ps-4 fw-bold text-muted"><?= $no; ?></td>
                            <td>
                                <div class="position-relative overflow-hidden rounded-3 shadow-sm" style="width: 55px; height: 55px;">
                                    <img src="/uploads/products/<?= $p['gambar'] ? esc($p['gambar']) : 'default.jpg'; ?>" 
                                         alt="<?= esc($p['nama_produk']); ?>" 
                                         class="w-100 h-100 object-fit-cover img-zoom">
                                </div>
                            </td>
                            <td class="fw-semibold text-dark">
                                <?= esc($p['nama_produk']); ?>
                                <?php if ($no === 1) : ?>
                                    <span class="badge text-white ms-2 px-2 py-1 shadow-sm" style="background: var(--primary-emerald); font-size: 10px; border-radius: 6px;">
                                        <i class="fa-solid fa-sparkles me-1"></i>Terbaru
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-success">
                                Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <span class="badge rounded-pill <?= $p['stok'] < 5 ? 'bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25' : 'bg-success bg-opacity-10 text-success border border-success border-opacity-25'; ?> px-3 py-2 fw-semibold">
                                    <i class="fa-solid fa-layer-group me-1"></i><?= esc($p['stok']); ?> Unit
                                </span>
                            </td>
                            <?php if (session()->get('role') === 'admin') : ?>
                                <td class="text-center">
                                    <a href="/products/edit/<?= $p['id']; ?>" class="btn btn-warning btn-sm btn-action text-white me-1 shadow-sm" style="border-radius: 8px;">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="/products/delete/<?= $p['id']; ?>" 
                                       class="btn btn-danger btn-sm btn-action shadow-sm" 
                                       style="border-radius: 8px;"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus produk <?= esc($p['nama_produk']); ?>?')">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php $no++; endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .hover-row:hover {
        background-color: rgba(13, 148, 136, 0.03) !important;
    }
    .img-zoom {
        transition: transform 0.3s ease;
    }
    .img-zoom:hover {
        transform: scale(1.15);
    }
</style>

<?= $this->endSection(); ?>