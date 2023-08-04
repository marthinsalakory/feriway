<?php
if (isset($_SESSION['login'])) {
    if (!db_count('pengguna', ['id' => $_SESSION['login']])) redirect('auth.php?logout');
    $user = db_find('pengguna', ['id' => $_SESSION['login']]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FerryWaai</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
    <link rel="shortcut icon" href="admin/dist/img/icon_kapal.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome/css/all.min.css">
    <script src="admin/plugins/fontawesome/js/all.min.js"></script>

    <!-- =======================================================
  * Template Name: Presento
  * Updated: Jun 14 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/presento-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="index.php">FerryWaai<span>.</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto" href="<?= $nav_on != 'index' ? 'index.php' : ''; ?>#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="<?= $nav_on != 'index' ? 'index.php' : ''; ?>#about">Tentang</a></li>
                    <li><a class="nav-link scrollto" href="<?= $nav_on != 'index' ? 'index.php' : ''; ?>#pengumuman">Pengumuman</a></li>
                    <li><a class="nav-link scrollto" href="<?= $nav_on != 'index' ? 'index.php' : ''; ?>#agenda">Agenda</a></li>
                    <?php if (isset($_SESSION['login'])) : ?>
                        <li><a class="<?= $nav_on == 'pemesanan' ? 'active' : ''; ?>" href="pemesanan.php">Riwayat Pemesanan</a></li>
                    <?php endif; ?>
                    <li><a class="nav-link scrollto" href="<?= $nav_on != 'index' ? 'index.php' : ''; ?>#contact">Kontak</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <?php if (!isset($user)) : ?>
                <a href="masuk.php" class="get-started-btn scrollto" data-bs-toggle="modal" data-bs-target="#modallogin">Masuk</a>
                <a href="daftar.php" class="get-started-btn scrollto" data-bs-toggle="modal" data-bs-target="#modalregister">Daftar</a>
            <?php else : ?>
                <a onclick="return confirm('Keluar?')" href="auth.php?logout" class="ms-4 scrollto btn btn-danger">Keluar</a>
            <?php endif; ?>
        </div>
    </header><!-- End Header -->

    <?php if (!isset($user)) : ?>
        <?php if (isset($_SESSION['error_login'])) : ?>
            <script>
                window.addEventListener('DOMContentLoaded', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('modallogin'));
                    myModal.show();
                });
            </script>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_register'])) : ?>
            <script>
                window.addEventListener('DOMContentLoaded', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('modalregister'));
                    myModal.show();
                });
            </script>
        <?php endif; ?>
        <!-- Modal Login-->
        <div class="modal fade" id="modallogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="auth.php" class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Masuk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($_SESSION['error_login'])) : ?>
                            <p class="text-danger text-center"><?= $_SESSION['error_login']; ?></p>
                            <?php unset($_SESSION['error_login']); ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-12">
                                <label for="username">Username</label>
                                <input required type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="col-12 mt-3">
                                <label for="password">Password</label>
                                <input required type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-12 mt-3">
                                <p>Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#modalregister">Daftar</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="login" class="btn btn-danger">Masuk</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Register-->
        <div class="modal fade" id="modalregister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="auth.php" class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Daftar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($_SESSION['error_register'])) : ?>
                            <p class="text-danger text-center"><?= $_SESSION['error_register']; ?></p>
                            <?php unset($_SESSION['error_register']); ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-12">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input required type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
                            </div>
                            <div class="col-6 mt-3">
                                <label for="email">Email</label>
                                <input required type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="col-6 mt-3">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input required type="number" name="nomor_telepon" id="nomor_telepon" class="form-control">
                            </div>
                            <div class="col-6 mt-3">
                                <label for="username">Username</label>
                                <input required type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="col-6 mt-3">
                                <label for="password">Password</label>
                                <input required type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-6 mt-3">
                                <p>Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#modallogin">Masuk</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="register" class="btn btn-danger">Kirim</button>
                    </div>
                </form>
            </div>
        </div>

    <?php endif; ?>