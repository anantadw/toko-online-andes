<?php echo $this->extend('layout/v_template') ?>

<?php echo $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col">
            <h1 class="text-center">Checkout</h1>
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-6">
            <form action="" method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="no_transaksi">Nomor Transaksi</label>
                    <input type="hidden" name="no_transaksi" value="<?php echo $no_transaksi; ?>">
                    <h3 id="no_transaksi"><?php echo $no_transaksi; ?></h3>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="col">
                        <label for="no_telepon" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control" id="no_telepon" name="no_telepon" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                    </div>
                    <div class="col">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" required>
                    </div>
                    <div class="col">
                        <label for="kodepos" class="form-label">Kode Pos</label>
                        <input type="number" class="form-control" id="kodepos" name="kodepos" required>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="no_transaksi">Total Harga</label>
                    <input type="hidden" name="total_harga" value="<?php echo $total_harga; ?>">
                    <h3 id="total_harga">Rp<?php echo number_format($total_harga, 0, ',', '.') ?></h3>
                </div>
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>