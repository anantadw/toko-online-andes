<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="#">TokoOnlineAndes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo (uri_string() == 'admin/games') ? 'link-active' : ''; ?>" href="/admin/games">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (uri_string() == 'user/games') ? 'link-active' : ''; ?>" href="/user/games">User</a>
                </li>
                <?php if (uri_string() != 'admin/games') : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (uri_string() == 'user/cart') ? 'link-active' : ''; ?>" href="/user/cart"><i class="bi bi-cart"></i><?php if (session('cart')) : ?><span class="badge rounded-pill text-bg-danger ms-1"><?php echo count(session('cart')); ?></span><?php endif; ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>