<?php
include 'function.php';
if (!isset($_SESSION['login'])) {
    $_SESSION['error_login'] = 'Anda harus login terlebih dahulu';
    redirectBack();
}

$id = 0;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
}
$pmsn = db_find_array('pemesanan', ['id' => $id]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FeriWay</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Tambahkan header CORS di sini -->
    <meta http-equiv="Access-Control-Allow-Origin" content="https://feriway.marthin">

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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>

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
        <div class="w-100 text-center">
            <h3 class="fw-bold mb-4">INFORMASI TIKET</h3>
        </div>
        <?php if (db_count('pemesanan', ['id' => $id])) : ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Status Tiket</th>
                                <td><?= $pmsn['status'] == 1 ? "<span class='text-primary fw-bold'>Telah Dikonfirmasi<span>" : ($pmsn['status'] == 2 ? "<span class='text-danger fw-bold'>Ditolak<span>" : "<span class='text-warning fw-bold'>Belum Dikonfirmasi<span>"); ?></td>
                            </tr>
                            <tr>
                                <th>ID Akun</th>
                                <td><?= $pmsn['id']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td><?= db_find('pengguna', ['id' => $pmsn['pengguna_id']])->nama_lengkap; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= db_find('pengguna', ['id' => $pmsn['pengguna_id']])->email; ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon</th>
                                <td><?= db_find('pengguna', ['id' => $pmsn['pengguna_id']])->nomor_telepon; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 table-responsive">
                    <div class="card fw-bold" style="width: 1110px;display: block;background-color: <?= db_find('harga_tiket', ['id' => $pmsn['harga_tiket_id']])->warna ?>;" id="card<?= $t; ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 position-relative" style="border-right: dashed 2px black;">
                                    <img class="position-absolute end-0" width="100" src="assets/img/Logo_ASDP.png" alt="">
                                    <span class="bg-primary">PERUSAHAAN PENYEBRANGAN</span>
                                    <p class="mt-2">PELABUHAN PENYEBRANGAN</p>
                                    <p style="line-height: 1px;">Lintasan: <?= db_find('data_tiket', ['id' => $pmsn['tiket_id']])->asal . ' - ' . db_find('data_tiket', ['id' => $pmsn['tiket_id']])->tujuan ?></p>
                                    <p style="line-height: 1px;">Waktu Keberangkatan: <?= db_find('data_tiket', ['id' => $pmsn['tiket_id']])->tanggal_keberangkatan ?>, <?= db_find('data_tiket', ['id' => $pmsn['tiket_id']])->waktu_keberangkatan ?></p>
                                    <p style="line-height: 1px;"><?= db_find('harga_tiket', ['id' => $pmsn['harga_tiket_id']])->keterangan ?></p>
                                    <div class="d-flex justify-content-between">
                                        <h4 class="my-4 fw-bold">Rp. <?= db_find('harga_tiket', ['id' => $pmsn['harga_tiket_id']])->harga ?></h4>
                                        <div class="text-center"><img width="60" src="data:image/png;base64, <?php echo base64_encode(generateQRCode('http://' . $_SERVER['HTTP_HOST'] . '/ticket.php?id=' . $pmsn['id'])); ?>" alt="QR Code">
                                            <p>Scan Disini</p>
                                        </div>
                                    </div>
                                    <p style="line-height: 1px;">Berlaku Sekali Jalan</p>
                                    <p style="line-height: 1px;">SK.BUPATI MALUKU TENGAH NO. 12 TAHUN 2013</p>
                                    <p style="line-height: 1px;">05225100003642</p>
                                    <span class="bg-primary">PERUSAHAAN PENYEBRANGAN</span>
                                </div>
                                <div class="col-6 position-relative">
                                    <img class="position-absolute end-0" width="100" src="assets/img/Logo_ASDP.png" alt="">
                                    <span class="bg-primary">PEMAKAI JASA</span>
                                    <p class="mt-2">PELABUHAN PENYEBRANGAN</p>
                                    <p style="line-height: 1px;">Lintasan: <?= db_find('data_tiket', ['id' => $pmsn['tiket_id']])->asal . ' - ' . db_find('data_tiket', ['id' => $pmsn['tiket_id']])->tujuan ?></p>
                                    <p style="line-height: 1px;">Waktu Keberangkatan: <?= db_find('data_tiket', ['id' => $pmsn['tiket_id']])->tanggal_keberangkatan ?>, <?= db_find('data_tiket', ['id' => $pmsn['tiket_id']])->waktu_keberangkatan ?></p>
                                    <p style="line-height: 1px;"><?= db_find('harga_tiket', ['id' => $pmsn['harga_tiket_id']])->keterangan ?></p>
                                    <div class="d-flex justify-content-between">
                                        <h4 class="my-4 fw-bold">Rp. <?= db_find('harga_tiket', ['id' => $pmsn['harga_tiket_id']])->harga ?></h4>
                                        <div class="text-center"><img width="60" src="data:image/png;base64, <?php echo base64_encode(generateQRCode('http://' . $_SERVER['HTTP_HOST'] . '/ticket.php?id=' . $pmsn['id'])); ?>" alt="QR Code">
                                            <p>Scan Disini</p>
                                        </div>
                                    </div>
                                    <p style="line-height: 1px;">Berlaku Sekali Jalan</p>
                                    <p style="line-height: 1px;">SK.BUPATI MALUKU TENGAH NO. 12 TAHUN 2013</p>
                                    <p style="line-height: 1px;">05225100003642</p>
                                    <span class="bg-primary text-end">PEMAKAI JASA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <h3>Tidak ada data</h3>
        <?php endif; ?>
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