<?php
include 'function.php';
$nav_on = 'tiket';
include 'header.php'; ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php">Beranda</a></li>
                <li>Tiket</li>
            </ol>
            <h2>Agenda Keberangkatan</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="agenda" class="agenda">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        border: 1px solid #ddd;
                        font-size: 14px;
                    }

                    table th,
                    table td {
                        padding: 12px;
                        text-align: left;
                        border-bottom: 1px solid #ddd;
                    }

                    table th {
                        background-color: #f9f9f9;
                        color: #333;
                        font-weight: bold;
                    }

                    table tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }

                    table tr:hover {
                        background-color: #e5e5e5;
                    }
                </style>

                <div class="col-12 table-responsive">
                    <table>
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Lintasan</th>
                                <th>Kapal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (db_query('SELECT * FROM data_tiket ORDER BY tanggal_keberangkatan ASC') as $tkt) : ?>
                                <?php if ($tkt['status']) { ?>
                                    <tr onclick="window.location.href='harga.php?id=<?= $tkt['id']; ?>';" style="cursor: pointer;">
                                        <td><?= ubahHari(date('l', strtotime($tkt['tanggal_keberangkatan']))) . date(', d-m-Y', strtotime($tkt['tanggal_keberangkatan'])); ?></td>
                                        <td><?= $tkt['waktu_keberangkatan']; ?></td>
                                        <td><?= $tkt['asal']; ?> - <?= $tkt['tujuan']; ?></td>
                                        <td><?= db_find('data_kapal', ['id' => $tkt['kapal_id']])->nama; ?></td>
                                        <td class="text-success">Buka</td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td><?= ubahHari(date('l', strtotime($tkt['tanggal_keberangkatan']))) . date(', d-m-Y', strtotime($tkt['tanggal_keberangkatan'])); ?></td>
                                        <td><?= $tkt['waktu_keberangkatan']; ?></td>
                                        <td><?= $tkt['asal']; ?> - <?= $tkt['tujuan']; ?></td>
                                        <td><?= db_find('data_kapal', ['id' => $tkt['kapal_id']])->nama; ?></td>
                                        <td class="text-danger">Tutup</td>
                                    </tr>
                                <?php } ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->


<?php include 'footer.php'; ?>