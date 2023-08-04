<?php
include 'function.php';

if (!isset($_SESSION['login'])) {
    $_SESSION['error_login'] = 'Anda harus login terlebih dahulu';
    redirectBack();
}

if (!db_find('harga_tiket', ['id' => $_GET['id']])) redirectBack();

$hrg = db_find('harga_tiket', ['id' => $_GET['id']]);
$tkt = db_find('data_tiket', ['id' => $hrg->tiket_id]);
$kpl = db_find('data_kapal', ['id' => $tkt->kapal_id]);


if (isset($_POST['bayar'])) {
    if (db_count('pemesanan', ['kode_referensi' => $_POST['kode_referensi']])) {
        setFlash('Kode referensi anda sudah kadalwarsa');
    }

    $uniqueFileName = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['slip_pembayaran'])) {
        $uploadDir = 'uploads/'; // Ganti dengan direktori tempat berkas akan disimpan
        $fileInfo = $_FILES['slip_pembayaran'];

        $fileName = $fileInfo['name'];
        $fileTmpName = $fileInfo['tmp_name'];
        $fileSize = $fileInfo['size'];
        $fileError = $fileInfo['error'];

        // Cek apakah tidak ada error pada unggahan
        if ($fileError === UPLOAD_ERR_OK) {
            // Pastikan hanya file dengan ekstensi tertentu yang diizinkan untuk diunggah
            $allowedExtensions = array('pdf', 'jpg', 'jpeg', 'png');
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                // Buat nama unik untuk berkas yang diunggah
                $uniqueFileName = uniqid('slip_') . '.' . $fileExtension;
                $destination = $uploadDir . $uniqueFileName;

                // Pindahkan berkas ke folder tujuan
                if (move_uploaded_file($fileTmpName, $destination)) {
                } else {
                    setFlash("Gagal mengunggah berkas.");
                }
            } else {
                setFlash("Ekstensi berkas tidak diizinkan. Hanya file PDF, JPG, JPEG, dan PNG yang diizinkan.");
            }
        } else {
            setFlash("Terjadi kesalahan saat mengunggah berkas.");
        }
    }

    if (!isFlash()) {
        if (db_insert('pemesanan', [
            'pengguna_id' => $_SESSION['login'],
            'kapal_id' => $kpl->id,
            'tiket_id' => $tkt->id,
            'harga_tiket_id' => $hrg->id,
            'nama_bank' => $_POST['nama_bank'],
            'nomor_rekening' => $_POST['nomor_rekening'],
            'pemegang_rekening' => $_POST['pemegang_rekening'],
            'kode_referensi' => $_POST['kode_referensi'],
            'slip_pembayaran' => $uniqueFileName,
            'merek_kendaraan' => $_POST['merek_kendaraan'],
            'tipe_kendaraan' => $_POST['tipe_kendaraan'],
            'nomor_polisi' => $_POST['nomor_polisi'],
            'tanggal' => date('Y-m-d'),
            'waktu' => date('H:i:s')
        ])) {
            setFlash('Berhasil mengirim pemesanan tiket, mohon menunggu tiket anda di konfirmasi oleh petugas');
            redirectBack();
        } else {
            setFlash("Gagal mengirim pemesanan tiket");
        }
    }
}

$nav_on = 'tiket';
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
                        <li>Bayar</li>
                    </ol>
                    <h2>Bayar</h2>
                </div>
                <div>
                    <a target="_blank" href="slip_pembayaran.php?id=<?= $_GET['id']; ?>" class="btn btn-warning btn-sm" style="height: max-content;"><i class="fa fa-print"></i> Cetak Slip</a>
                </div>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section>
        <form method="POST" enctype="multipart/form-data" class="container" data-aos="fade-up">
            <?php if (isFlash()) : ?>
                <div class="mb-3"><?php flash() ?></div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h3>Data Akun</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label>Nama</label>
                            <input readonly class="form-control" type="text" value="<?= $user->nama_lengkap; ?>">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Username</label>
                            <input readonly class="form-control" type="text" value="<?= $user->username; ?>">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Email</label>
                            <input readonly class="form-control" type="text" value="<?= $user->email; ?>">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Nomor Telepon</label>
                            <input readonly class="form-control" type="text" value="<?= $user->nomor_telepon; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Data Tiket</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label>Nama Kapal</label>
                            <input readonly class="form-control" type="text" value="<?= $kpl->nama; ?>">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Tanggal Keberangkatan</label>
                            <input readonly class="form-control" type="text" value="<?= $tkt->tanggal_keberangkatan; ?>">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Waktu Keberangkatan</label>
                            <input readonly class="form-control" type="text" value="<?= $tkt->waktu_keberangkatan; ?>">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Lintasan</label>
                            <input readonly class="form-control" type="text" value="<?= $tkt->asal . ' - ' . $tkt->tujuan; ?>">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Kategori Tiket</label>
                            <input readonly class="form-control" type="text" value="<?= $hrg->keterangan; ?>">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Harga Tiket</label>
                            <input readonly class="form-control" type="text" value="Wajib Rp. <?= $hrg->harga; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($hrg->pakai_kendaraan) : ?>
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Data Kendaraan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <label for="merek_kendaraan">Merek <span class="text-danger">*</span></label>
                                <input required class="form-control" type="text" name="merek_kendaraan" id="merek_kendaraan" value="<?= old('merek_kendaraan'); ?>">
                            </div>
                            <div class="col-12 mt-3">
                                <label for="tipe_kendaraan">Tipe Kendaraan <span class="text-danger">*</span></label>
                                <input required class="form-control" type="text" name="tipe_kendaraan" id="tipe_kendaraan" value="<?= old('tipe_kendaraan'); ?>">
                            </div>
                            <div class="col-12 mt-3">
                                <label for="nomor_polisi">Nomor Polisi <span class="text-danger">*</span></label>
                                <input required class="form-control" type="text" name="nomor_polisi" id="nomor_polisi" value="<?= old('nomor_polisi'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Data Rekening</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 style="font-weight: 600;">REKENING ASAL:</h5>
                            <div class="form-group">
                                <label for="nama_bank_pengirim">Nama Bank <span class="text-danger">*</span></label>
                                <input required class="form-control" type="text" name="nama_bank" id="nama_bank" value="<?= old('nama_bank'); ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label for="nomor_rekening">Nomor Rekening <span class="text-danger">*</span></label>
                                <input required class="form-control" type="text" name="nomor_rekening" id="nomor_rekening" value="<?= old('nomor_rekening'); ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label for="pemegang_rekening">Nama Pemegang Rekening <span class="text-danger">*</span></label>
                                <input required class="form-control" type="text" name="pemegang_rekening" id="pemegang_rekening" value="<?= old('pemegang_rekening'); ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label for="kode_referensi">Kode Referensi <span class="text-danger">*</span></label>
                                <input required class="form-control" type="text" name="kode_referensi" id="kode_referensi" value="<?= old('kode_referensi'); ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label for="slip_pembayaran">Slip Pembayaran (.pdf) <span class="text-danger">*</span></label>
                                <input required class="form-control" type="file" name="slip_pembayaran" id="slip_pembayaran">
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 style="font-weight: 600;">REKENING TUJUAN:</h5>
                            <div class="form-group">
                                <label>Nama Bank</label>
                                <input readonly class="form-control" value="<?= $kpl->nama_bank; ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label>Nomor Rekening</label>
                                <input readonly class="form-control" value="<?= $kpl->nomor_rekening; ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label>Nama Pemegang Rekening</label>
                                <input readonly class="form-control" value="<?= $kpl->pemegang_rekening; ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label>Jumlah Pembayaran</label>
                                <input readonly class="form-control" value="Wajib Rp. <?= $hrg->harga; ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label>Kode Bank</label>
                                <input readonly class="form-control" value="<?= $kpl->kode_bank; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3 text-center">
                <button type="reset" class="btn btn-secondary btn-lg">Batal</button>
                <button name="bayar" class="btn btn-danger btn-lg">Kirim</button>
            </div>
        </form>
    </section>

</main><!-- End #main -->


<?php include 'footer.php'; ?>