<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row justify-content-center animate__animated animate__zoomIn animate__faster">
    <div class="col-md-6">
        <div class="glass-card p-4">
            <div class="d-flex align-items-center gap-3 mb-4 border-bottom pb-3">
                <div class="bg-warning bg-opacity-10 p-3 rounded-3 text-warning">
                    <i class="fa-solid fa-pen-to-square fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-0 text-dark">Edit Data Produk</h4>
                    <small class="text-muted">Perbarui rincian informasi dan foto produk yang tersimpan</small>
                </div>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger custom-alert bg-danger bg-opacity-10 text-danger border-0 small mb-3">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="/products/update/<?= $product['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Nama Produk</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-box text-muted"></i></span>
                        <input type="text" name="nama_produk" class="form-control border-start-0 ps-0" value="<?= old('nama_produk', $product['nama_produk']); ?>" placeholder="Masukkan nama produk..." required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Harga (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-tag text-muted"></i></span>
                        <input type="number" name="harga" class="form-control border-start-0 ps-0" value="<?= old('harga', $product['harga']); ?>" placeholder="Contoh: 75000" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-muted">Stok Unit</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-boxes-stacked text-muted"></i></span>
                        <input type="number" name="stok" class="form-control border-start-0 ps-0" value="<?= old('stok', $product['stok']); ?>" placeholder="Contoh: 15" required>
                    </div>
                </div>

                <!-- Input File Gambar Edit & Preview Gambar Saat Ini -->
                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted">Ganti Gambar Produk (Opsional)</label>
                    <input type="file" name="gambar" id="gambarInput" class="form-control mb-2" accept="image/*" onchange="previewImg()">
                    <small class="text-muted d-block mb-2 fs-7">*Biarkan kosong jika tidak ingin mengubah gambar</small>
                    
                    <div class="text-center p-2 border rounded-3 bg-light">
                        <img id="imgPreview" src="/uploads/products/<?= $product['gambar'] ? esc($product['gambar']) : 'default.jpg'; ?>" class="img-fluid rounded-2" style="max-height: 150px; object-fit: cover;">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-2">
                    <a href="/products" class="btn btn-light border rounded-3 px-3 text-muted">
                        <i class="fa-solid fa-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-emerald">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Perbarui Produk
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

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?= $this->endSection(); ?>