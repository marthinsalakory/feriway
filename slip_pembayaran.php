<?php
include 'function.php';
if (!isset($_SESSION['login'])) {
    $_SESSION['error_login'] = 'Anda harus login terlebih dahulu';
    redirectBack();
}


if (!db_count('harga_tiket', ['id' => $_GET['id']])) redirect('auth.php?logout');
$hrg = db_find('harga_tiket', ['id' => $_GET['id']]);
$tkt = db_find('data_tiket', ['id' => $hrg->tiket_id]);
$kpl = db_find('data_kapal', ['id' => $tkt->kapal_id]);


if (!db_count('pengguna', ['id' => $_SESSION['login']])) redirect('auth.php?logout');
$user = db_find('pengguna', ['id' => $_SESSION['login']]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FeriWay</title>
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


    <style>
        @media print {
            .no_print {
                display: none;
            }
        }
    </style>

    <!-- =======================================================
  * Template Name: Presento
  * Updated: Jun 14 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/presento-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <div class="container mt-5">
        <button onclick="print()" class="btn btn-primary float-end mb-3 btn-sm no_print"><i class="fa fa-print"></i> PRINT</button>
        <table class="table table-bordered">
            <tr class="text-center">
                <th colspan="2">SLIP PEMBAYARAN TIKET KAPAL FERI</th>
            </tr>
            <tbody>
                <tr>
                    <th colspan="2">DATA PEMESAN</th>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>: <?= $user->username; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: <?= $user->nama_lengkap; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: <?= $user->email; ?></td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td>: <?= $user->nomor_telepon; ?></td>
                </tr>
                <tr>
                    <th>Total Tagihan</th>
                    <th>Rp. <?= $hrg->harga; ?></th>
                </tr>
                <tr>
                    <th>Nama Bank</th>
                    <th><?= $kpl->nama_bank; ?></th>
                </tr>
                <tr>
                    <th>Nomor Rekening</th>
                    <th><?= $kpl->nomor_rekening; ?></th>
                </tr>
                <tr>
                    <th>Nama Rekening</th>
                    <th><?= $kpl->pemegang_rekening; ?></th>
                </tr>
                <tr>
                    <th colspan="2">Bantuan</th>
                </tr>
                <tr>
                    <td colspan="2">
                        1. Datangi Bank Terdekat<br>
                        2. Kemudian Sampaikan kepada Teler untuk pengiriman Uang<br>
                        3. Lalu berikan Slip ini<br>
                        4. Proses pengiriman selesai<br>
                        5. Minta slip pengiriman dan nomor referensi sebagai bukti pengiriman<br>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>