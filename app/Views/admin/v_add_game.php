<?php echo $this->extend('layout/v_template') ?>

<?php echo $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col">
            <h1>Tambah Game</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <?php if (session()->getFlashdata('validation_error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php foreach (session()->getFlashdata('validation_error') as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-4">
            <div class="card"">
                <div class=" card-body">
                <form id="addForm" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating">
                        <input type="text" class="form-control <?php echo ($validation->hasError('judul') ? 'is-invalid' : ''); ?>" id="floatingJudul" name="judul" placeholder="Judul Game">
                        <label for="floatingJudul">Judul</label>
                        <div class="invalid-feedback"><?php echo $validation->getError('judul'); ?></div>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="number" class="form-control <?php echo ($validation->hasError('stok') ? 'is-invalid' : ''); ?>" id="floatingstok_game" name="stok" placeholder="stok_game" min="1" max="999">
                        <label for="floatingstok_game">Stok</label>
                        <div class="invalid-feedback"><?php echo $validation->getError('stok'); ?></div>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="number" class="form-control <?php echo ($validation->hasError('harga') ? 'is-invalid' : ''); ?>" id="floatingHarga" name="harga" placeholder="Harga" min="0">
                        <label for="floatingHarga">Harga</label>
                        <div class="invalid-feedback"><?php echo $validation->getError('harga'); ?></div>
                    </div>
                    <div class="mt-3">
                        <label for="fileGambar" class="form-label">Gambar</label>
                        <input class="form-control <?php echo ($validation->hasError('gambar') ? 'is-invalid' : ''); ?>" type="file" id="fileGambar" name="gambar" accept="image/png, image/jpg, image/jpeg">
                        <div class="invalid-feedback"><?php echo $validation->getError('gambar'); ?></div>
                    </div>
                    <div class="d-flex justify-content-between mt-5">
                        <a href="/admin/games" class="btn btn-secondary">Kembali</a>
                        <button type="submit" form="addForm" class="btn btn-success"><i class=" bi bi-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->endSection() ?>