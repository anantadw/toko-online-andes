<?php echo $this->extend('layout/v_template') ?>

<?php echo $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col">
            <h1>Daftar Games</h1>
        </div>
    </div>
    <div class="row mt-5">
        <?php foreach ($games as $game) : ?>
            <div class="col-lg-2 col-md-6 col-12 mb-4">
                <div class="card shadow-sm">
                    <img src="/images/games/<?php echo $game['gambar_game'] ?>" class="card-img-top <?php echo $color = ($game['stok_game'] == 0) ? 'grayscale' : ''; ?>" alt="<?php echo $game['nama_game'] ?>">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $game['nama_game'] ?>
                            <span class="badge rounded-pill <?php echo $color = ($game['stok_game'] == 0) ? 'text-bg-danger' : 'text-bg-success'; ?>"><?php echo $game['stok_game'] ?></span>
                        </h5>
                        <!-- <div class="mb-4">
                            <span class="badge rounded-pill text-bg-primary">PS4</span>
                            <span class="badge rounded-pill text-bg-primary">PC</span>
                        </div> -->
                        <h5 class="card-subtitle text-muted my-3">Rp<?php echo number_format($game['harga_game'], 0, ',', '.') ?></h5>
                        <div class="d-flex justify-content-end mt-5">
                            <!-- <button type="button" class="btn btn-warning"><i class="bi bi-pencil-square me-2"></i>Edit</button> -->
                            <form action="" method="post">
                                <input type="hidden" name="id_game" value="<?php echo $game['id_game']; ?>">
                                <button type="submit" class="btn btn-primary ms-2" <?php if ($game['stok_game'] == 0) echo 'disabled'; ?> title="Masukkan Keranjang"><i class="bi bi-bag-plus"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php echo $this->endSection() ?>