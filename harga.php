<?php
include 'function.php';
if (!isset($_GET['id'])) {
    redirectBack();
}
if (empty($_GET['id'])) {
    redirectBack();
}
if (!db_count('data_tiket', ['id' => $_GET['id'], 'status' => 1])) {
    redirectBack();
}
$data = db_find('data_tiket', ['id' => $_GET['id'], 'status' => 1]);

$nav_on = 'tiket';
include 'header.php'; ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="tiket.php">Tiket</a></li>
                <li><?= db_find('data_kapal', ['id' => $data->kapal_id])->nama; ?></li>
            </ol>
            <h2><?= db_find('data_kapal', ['id' => $data->kapal_id])->nama; ?></h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <style>
        .ticket {
            background-color: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
        }

        .ticket:hover {
            background-color: #f3f3f3;
            padding: 20px;
            margin-bottom: 20px;
        }

        .ticket .title {
            font-size: 24px;
            font-weight: bold;
        }

        .ticket .price {
            font-size: 18px;
            margin-top: 10px;
        }
    </style>
    <!-- ======= Blog Section ======= -->
    <section id="agenda" class="agenda">
        <div class="container p-2" data-aos="fade-up">
            <div class="row">
                <?php foreach (db_findAll('harga_tiket', ['tiket_id' => $data->id]) as $hrg) : ?>
                    <div class="col-md-4">
                        <div class="ticket">
                            <div class="title"><?= $hrg['keterangan']; ?></div>
                            <div class="price">Rp <?= $hrg['harga']; ?></div>
                            <a href="bayar.php?id=<?= $hrg['id']; ?>" class="btn btn-warning mt-3">Bayar</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main><!-- End #main -->


<?php include 'footer.php'; ?>