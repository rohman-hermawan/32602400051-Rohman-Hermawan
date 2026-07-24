<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row justify-content-center animate__animated animate__zoomIn animate__faster">
    <div class="col-md-6">
        <div class="glass-card p-4">
            <!-- Header Card -->
            <div class="d-flex align-items-center gap-3 mb-4 border-bottom border-white border-opacity-10 pb-3">
                <div class="p-3 rounded-3" style="background: rgba(13, 148, 136, 0.2); color: var(--emerald-glow);">
                    <i class="fa-solid fa-plus-circle fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0 text-dark">Tambah Produk Baru</h4>
                    <small class="text-muted">Masukkan rincian informasi dan foto produk ke sistem</small>
                </div>
            </div>

            <!-- Flash Error Alert -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 small mb-4 rounded-3">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <!-- Form Tambah Produk -->
            <form action="/products/store" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <!-- Input Nama Produk -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Nama Produk <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
                        <input type="text" name="nama_produk" class="form-control" value="<?= old('nama_produk'); ?>" placeholder="Masukkan nama produk..." required>
                    </div>
                </div>

                <!-- Input Harga -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Harga (Rp) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                        <input type="number" name="harga" class="form-control" value="<?= old('harga'); ?>" placeholder="Contoh: 75000" required>
                    </div>
                </div>

                <!-- Input Stok -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Stok Unit <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-boxes-stacked"></i></span>
                        <input type="number" name="stok" class="form-control" value="<?= old('stok'); ?>" placeholder="Contoh: 15" required>
                    </div>
                </div>

                <!-- Input File Gambar & Preview -->
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted">Foto Produk <span class="text-muted fs-7">(Opsional, Max 2MB)</span></label>
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                        <input type="file" name="gambar" id="gambarInput" class="form-control" accept="image/png, image/jpeg, image/jpg, image/webp" onchange="previewImg()">
                    </div>
                    <small class="text-muted d-block mb-3 fs-7">*Format: JPG / PNG / WEBP</small>
                    
                    <!-- Pratinjau Gambar -->
                    <div class="text-center p-3 rounded-3" style="background: rgba(255, 255, 255, 0.03); border: 1px dashed var(--border-glass);">
                        <p class="text-muted small mb-2">Pratinjau Foto:</p>
                        <img id="imgPreview" src="/uploads/products/default.jpg" class="img-fluid rounded-3 shadow-sm" style="max-height: 160px; object-fit: cover;">
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between align-items-center pt-3 border-top border-white border-opacity-10">
                    <a href="/products" class="btn btn-outline-secondary px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-emerald px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImg() {
        const gambar = document.querySelector('#gambarInput');
        const imgPreview = document.querySelector('#imgPreview');

        if (gambar.files && gambar.files[0]) {
            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    }
</script>

<?= $this->endSection(); ?>