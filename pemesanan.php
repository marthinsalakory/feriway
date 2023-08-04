<?php
include 'function.php';

if (!isset($_SESSION['login'])) {
    $_SESSION['error_login'] = 'Anda harus login terlebih dahulu';
    redirectBack();
}

$nav_on = 'pemesanan';
include 'header.php'; ?>

<main id="main">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>

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
                            <th class="text-center">UNDUH TIKET</th>
                            <th class="text-center">STATUS</th>
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
                        <?php $t = 1; ?>
                        <?php foreach (db_findAll('pemesanan', ['pengguna_id' => $user->id]) as $pmsn) : ?>
                            <div class="card fw-bold" style="display: none;background-color: <?= db_find('harga_tiket', ['id' => $pmsn['harga_tiket_id']])->warna ?>;" id="card<?= $t; ?>">
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
                            <tr>
                                <td><?= $i++; ?></td>
                                <td class="text-center">
                                    <?php if ($pmsn['status'] == 1) { ?>
                                        <button class="btn btn-outline-success btn-sm" id="downloadButton<?= $t; ?>"><i class="fa fa-ticket"></i> Download</button>
                                    <?php } else { ?>
                                        <p class="text-danger"><i class="fa fa-x"></i></p>
                                    <?php } ?>
                                </td>
                                <?php if (db_find('data_tiket', ['id' => $pmsn['tiket_id']])->status != 0) { ?>
                                    <?php if ($pmsn['status'] == 1) { ?>
                                        <td><span class="text-success">Dikonfirmasi</span></td>
                                    <?php } elseif ($pmsn['status'] == 2) { ?>
                                        <td><span class="text-danger">Ditolak</span></td>
                                    <?php } else { ?>
                                        <td><span class="text-warning">Menunggu</span></td>
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
                            <script>
                                // Mengambil referensi elemen card
                                const cardElement = document.getElementById('card<?= $t; ?>');

                                // Mengambil referensi tombol unduh
                                const downloadButton = document.getElementById('downloadButton<?= $t; ?>');

                                // Menambahkan event listener untuk tombol unduh
                                downloadButton.addEventListener('click', () => {
                                    // Cek
                                    if (!confirm('Download?')) return false;

                                    // Menampilkan sementara card yang tersembunyi
                                    cardElement.style.display = 'block';

                                    // Mengonversi elemen card menjadi gambar menggunakan html2canvas
                                    html2canvas(cardElement).then(canvas => {
                                        // Mengonversi canvas menjadi data URL gambar JPG
                                        const dataURL = canvas.toDataURL('image/jpeg');

                                        // Membuat tautan unduhan menggunakan FileSaver.js
                                        const fileName = 'tiket.jpg';
                                        saveAs(dataURL, fileName);
                                    });

                                    // Menyembunyikan card
                                    cardElement.style.display = 'none';
                                });
                            </script>
                            <?php $t++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main><!-- End #main -->


<?php include 'footer.php'; ?>