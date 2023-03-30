<?php echo $this->extend('layout/v_template') ?>

<?php echo $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col">
            <h1>Data Games</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <a href="/admin/games/create" class="btn btn-primary ms-auto">
                <i class="bi bi-plus-lg me-2"></i>Tambah Game
            </a>
        </div>
    </div>
    <div class="row mt-5">
        <?php foreach ($games as $game) : ?>
            <div class="col-lg-2 col-md-6 col-12 mb-4 align-self-stretch">
                <div class="card shadow-">
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
                            <button type="button" class="btn btn-danger ms-2 hapus" data-title="<?php echo $game['nama_game']; ?>" data-id="<?php echo $game['id_game']; ?>"><i class="bi bi-trash me-2"></i>Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Game</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post" action="" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingJudul" name="judul" placeholder="Judul Game">
                        <label for="floatingJudul">Judul</label>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="number" class="form-control" id="floatingstok_game" name="stok" placeholder="stok_game" min="1" max="999">
                        <label for="floatingstok_game">Stok</label>
                    </div>
                    <div class="form-floating mt-3">
                        <input type="number" class="form-control" id="floatingHarga" name="harga" placeholder="Harga" min="0">
                        <label for="floatingHarga">Harga</label>
                    </div>
                    <div class="mt-3">
                        <label for="fileGambar" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="fileGambar" name="gambar" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addForm" class="btn btn-success"><i class="bi bi-save me-2"></i>Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>


<!-- Custom script -->
<?php echo $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        $('.hapus').on('click', function() {
            const judul = $(this).data('title');
            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin hapus ' + judul + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'post',
                        url: "<?php echo base_url('/admin/games/'); ?>" + id,
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            let type = (response.status) ? 'success' : 'error';
                            Swal.fire({
                                icon: type,
                                title: response.message,
                            })
                        }
                    });
                }
            })
        });
    });
</script>
<?php echo $this->endSection(); ?>