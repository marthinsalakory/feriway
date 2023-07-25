<?php
include 'function.php';

if (!isset($_SESSION['login'])) {
    $_SESSION['error_login'] = 'Anda harus login terlebih dahulu';
    redirectBack();
}

$nav_on = 'pemesanan';
include 'header.php'; ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <ol>
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="tiket.php">Tiket</a></li>
                        <li>Pemesanan</li>
                    </ol>
                    <h2>Riwayat Pemesanan</h2>
                </div>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->
    <style>
        table {
            white-space: nowrap;
        }
    </style>

    <!-- ======= Blog Section ======= -->
    <section>
        <div class="container" data-aos="fade-up">
            <?php if (isFlash()) : ?>
                <div class="mb-3"><?php flash() ?></div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>STATUS</th>
                            <th>NAMA KAPAL</th>
                            <th>TANGGAL KEBERANGKATAN</th>
                            <th>WAKTU KEBERANGKATAN</th>
                            <th>LINTASAN</th>
                            <th>KATEGORI TIKET</th>
                            <th>HARGA TIKET</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach (db_findAll('pemesanan', ['pengguna_id' => $user->id]) as $pmsn) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <?php if (db_find('data_tiket', ['id' => $pmsn['tiket_id']])->status != 0) { ?>
                                    <?php if ($pmsn['status'] == 1) { ?>
                                        <td><button class="btn btn-success btn-flat btn-sm">Dikonfirmasi</button></td>
                                    <?php } elseif ($pmsn['status'] == 2) { ?>
                                        <td><button class="btn btn-danger btn-flat btn-sm">Ditolak</button></td>
                                    <?php } else { ?>
                                        <td><button class="btn btn-warning btn-flat btn-sm">Menunggu</button></td>
                                    <?php } ?>
                                <?php } else { ?>
                                    <td><button class="btn btn-danger btn-flat btn-sm">Kadaluwarsa</button></td>
                                <?php } ?>
                                <td><?= db_find('data_kapal', ['id' => $pmsn['kapal_id']])->nama ?></td>
                                <td><?= db_find('data_tiket', ['id' => $pmsn['tiket_id']])->tanggal_keberangkatan ?></td>
                                <td><?= db_find('data_tiket', ['id' => $pmsn['tiket_id']])->waktu_keberangkatan ?></td>
                                <td><?= db_find('data_tiket', ['id' => $pmsn['tiket_id']])->asal . ' - ' . db_find('data_tiket', ['id' => $pmsn['tiket_id']])->tujuan ?></td>
                                <td><?= db_find('harga_tiket', ['id' => $pmsn['harga_tiket_id']])->keterangan ?></td>
                                <td>Rp. <?= db_find('harga_tiket', ['id' => $pmsn['harga_tiket_id']])->harga ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main><!-- End #main -->


<?php include 'footer.php'; ?>