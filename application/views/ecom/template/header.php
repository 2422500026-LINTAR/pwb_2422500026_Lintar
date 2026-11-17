<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">Toko Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuUtama">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Kategori</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Semua Kategori</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-2" role="search">
                <input class="form-control me-2" type="search" placeholder="Search">
            </form>
            <?php if ($this->session->has_userdata('pelanggan_login')) : ?>
                <a href="<?= base_url('profil') ?>" class="btn btn-outline-light me-2">Profil</a>
                <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
            <?php else : ?>
                <a href="<?= base_url('login') ?>" class="btn btn-outline-light me-2">Login</a>
                <a href="<?= base_url('register') ?>" class="btn btn-warning">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>