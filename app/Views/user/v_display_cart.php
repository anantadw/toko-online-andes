<?php echo $this->extend('layout/v_template') ?>

<?php echo $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col">
            <h1>Keranjang</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-8">
            <?php if (isset($_SESSION['cart'])) : ?>
                <?php foreach (session('cart') as $index => $game) : ?>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="/images/games/<?php echo $game['gambar_game'] ?>" alt="<?php echo $game['nama_game'] ?>" width="100px">
                                        </div>
                                        <div class="col">
                                            <h6>
                                                <?php echo $game['nama_game'] ?>
                                            </h6>
                                            <p class="card-subtitle text-muted my-3">Rp<?php echo number_format($game['harga_game'], 0, ',', '.') ?></p>
                                        </div>
                                        <div class="col">
                                            <p>Jumlah Beli</p>
                                            <div class="d-flex align-items-center">
                                                <form action="/user/games/cart/quantity" method="post">
                                                    <input type="hidden" name="type" value="subtract">
                                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                                    <button type="submit" class="btn btn-outline-secondary" <?php if ($game['stok_game'] == 1) echo 'disabled'; ?>>-</button>
                                                </form>
                                                <p class="mx-3 mb-0">
                                                    <?php echo $game['stok_game']; ?>
                                                </p>
                                                <form action="/user/games/cart/quantity" method="post">
                                                    <input type="hidden" name="type" value="add">
                                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                                    <button type="submit" class="btn btn-outline-secondary">+</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p>Sub Total</p>
                                            <p>Rp<?php echo number_format($game['harga_game'] * $game['stok_game'], 0, ',', '.') ?></p>
                                        </div>
                                        <div class="col">
                                            <form action="" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="index" value="<?php echo $index ?>">
                                                <button type="submit" class="btn btn-danger ms-auto">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4>Total Harga</h4>
                    <?php
                    $total = 0;
                    foreach (session('cart') as $index => $game) {
                        $total += $game['harga_game'] * $game['stok_game'];
                    }; ?>
                    <h5>Rp<?php echo number_format($total, 0, ',', '.') ?></h5>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="alert alert-dark" role="alert">
            Keranjang kosong.
        </div>
    <?php endif; ?>
    </div>
</div>
<?php echo $this->endSection() ?>