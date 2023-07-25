<?php
include 'function.php';

if (!isset($_GET['atas'])) {
    redirectBack();
}

if (!db_count('data_tiket', ['id' => $_GET['atas']])) {
    redirectBack();
}

$tkt = db_find('data_tiket', ['id' => $_GET['atas']]);

// Tambah Harga Tiket
if (isset($_POST['tambah'])) {
    if (isset($_POST['pakai_kendaraan'])) {
        $pakai_kendaraan = 1;
    } else {
        $pakai_kendaraan = 0;
    }
    if (db_insert('harga_tiket', [
        'tiket_id' => $tkt->id,
        'harga' => $_POST['harga'],
        'keterangan' => $_POST['keterangan'],
        'pakai_kendaraan' => $pakai_kendaraan,
    ])) {
        setFlash('Berhasil Menambahkan Data');
    } else {
        setFlash('Gagal Menambahkan Data');
    }
    redirectBack();
}

// Ubah Harga Tiket
if (isset($_POST['ubah'])) {
    if (isset($_POST['pakai_kendaraan'])) {
        $pakai_kendaraan = 1;
    } else {
        $pakai_kendaraan = 0;
    }
    if (db_update('harga_tiket', ['id' => $_GET['id']], [
        'tiket_id' => $tkt->id,
        'harga' => $_POST['harga'],
        'keterangan' => $_POST['keterangan'],
        'pakai_kendaraan' => $pakai_kendaraan,
    ])) {
        setFlash('Berhasil Mengubah Data');
    } else {
        setFlash('Gagal Mengubah Data');
    }
    redirectBack();
}

// Hapus Harga Tiket
if (isset($_GET['hapus'])) {
    if (db_count('harga_tiket', ['id' => $_GET['hapus']])) {
        if (db_delete('harga_tiket', ['id' => $_GET['hapus']])) {
            setFlash('Berhasil menghapus data');
            redirectBack();
        }
    }
    setFlash('Gagal menghapus data');
    redirectBack();
}

// Untuk aksi Harga Tiket
if (isset($_GET['aksi_harga'])) {
    if (empty($_GET['aksi_harga'])) {
        unset($_SESSION['aksi_harga']);
    } else {
        $_SESSION['aksi_harga'] = $_GET['aksi_harga'];
        // Deteksi Id
        if (isset($_GET['id']) && db_count('harga_tiket', ['id' => $_GET['id']])) {
            redirect("harga.php?atas=$tkt->id&&id=" . $_GET['id']);
        } else {
            redirect("harga.php?atas=$tkt->id");
        }
    }
    redirect("harga.php?atas=$tkt->id");
}

$sidebar_on = 'tiket';
include 'header.php'; ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php flash(); ?>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Lainnya</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group">
                            <a href="harga.php?atas=<?= $tkt->id; ?>&&aksi_harga" class="list-group-item list-group-item-action <?= (!isset($_SESSION['aksi_harga'])) ? 'active' : ''; ?><?= (isset($_SESSION['aksi_harga'])) ? ($_SESSION['aksi_harga'] == 'tampil' ? 'active' : '') : ''; ?><?= (isset($_SESSION['aksi_harga'])) ? ($_SESSION['aksi_harga'] == 'ubah' ? 'active' : '') : ''; ?>" aria-current="true">Data Harga Tiket</a>
                            <a href="harga.php?atas=<?= $tkt->id; ?>&&aksi_harga=tambah" class="list-group-item list-group-item-action <?= (isset($_SESSION['aksi_harga'])) ? ($_SESSION['aksi_harga'] == 'tambah' ? 'active' : '') : ''; ?>">Tambah Harga Tiket</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <?php if (isset($_SESSION['aksi_harga']) && $_SESSION['aksi_harga'] == 'tambah') : ?>
                    <form method="POST" class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Tambah Harga Tiket</h5>
                                <div>
                                    <a href="harga.php?atas=<?= $tkt->id; ?>&&aksi_harga" class="btn btn-warning">Kembali</a>
                                    <button name="tambah" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Kapal</label>
                                    <input readonly type="text" class="form-control" value="<?= db_find('data_kapal', ['id' => $tkt->kapal_id])->nama; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Status Tiket</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->status == 1 ? 'Buka' : 'Tutup'; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Tanggal Keberangkatan</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->tanggal_keberangkatan; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Waktu Keberangkatan</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->waktu_keberangkatan; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Pelabuhan Asal</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->asal; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Pelabuhan Tujuan</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->tujuan; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <input type="checkbox" name="pakai_kendaraan" id="pakai_kendaraan">
                                    <label for="pakai_kendaraan">Jika pakai kendaraan silahkan centang ini</label>
                                </div>
                                <div class="col-md-6">
                                    <label for="harga">Harga Tiket (Rp)</label>
                                    <input type="number" name="harga" id="harga" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                <?php elseif (isset($_SESSION['aksi_harga']) && $_SESSION['aksi_harga'] == 'ubah') : ?>
                    <form method="POST" class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Ubah Data Harga Tiket</h5>
                                <div class="">
                                    <a href="harga.php?atas=<?= $tkt->id; ?>&&aksi_harga" class="btn btn-warning">Kembali</a>
                                    <button name="ubah" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Kapal</label>
                                    <input readonly type="text" class="form-control" value="<?= db_find('data_kapal', ['id' => $tkt->kapal_id])->nama; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Status Tiket</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->status == 1 ? 'Buka' : 'Tutup'; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Tanggal Keberangkatan</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->tanggal_keberangkatan; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Waktu Keberangkatan</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->waktu_keberangkatan; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Pelabuhan Asal</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->asal; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Pelabuhan Tujuan</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->tujuan; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <?php if (db_count('harga_tiket', ['id' => $_GET['id']])) { ?>
                                    <?php $p = db_find('harga_tiket', ['id' => $_GET['id']]); ?>
                                    <div class="col-12 mb-3">
                                        <input <?= $p->pakai_kendaraan == 1 ? 'checked' : ''; ?> type="checkbox" name="pakai_kendaraan" id="pakai_kendaraan">
                                        <label for="pakai_kendaraan">Jika pakai kendaraan silahkan centang ini</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="harga">Harga Tiket (Rp)</label>
                                        <input type="number" name="harga" id="harga" class="form-control" value="<?= $p->harga; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $p->keterangan; ?>">
                                    </div>
                                <?php } else { ?>
                                    <div class="col-12 text-center">
                                        <label for="password">Tidak ada data</label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                <?php else : ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Data Harga Tiket</h5>
                                <div>
                                    <a href="tiket.php" class="btn btn-warning">Kembali</a>
                                    <a href="harga.php?atas=<?= $tkt->id; ?>&&aksi_harga=tambah" class="btn btn-primary">Tambah</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Kapal</label>
                                    <input readonly type="text" class="form-control" value="<?= db_find('data_kapal', ['id' => $tkt->kapal_id])->nama; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Status Tiket</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->status == 1 ? 'Buka' : 'Tutup'; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Tanggal Keberangkatan</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->tanggal_keberangkatan; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Waktu Keberangkatan</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->waktu_keberangkatan; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Pelabuhan Asal</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->asal; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Pelabuhan Tujuan</label>
                                    <input readonly type="text" class="form-control" value="<?= $tkt->tujuan; ?>">
                                </div>
                            </div>
                            <div class="table-responsive overflow-auto">
                                <table class="table table-bordered" id="example3">
                                    <thead class="bg-primary text-light text-center">
                                        <tr>
                                            <th>AKSI</th>
                                            <th>Harga Tiket</th>
                                            <th>Keterangan</th>
                                            <th>Pakai Kendaraan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php foreach (db_findAll('harga_tiket', ['tiket_id' => $tkt->id]) as $kpl) : ?>
                                            <tr>
                                                <td>
                                                    <a href="harga.php?atas=<?= $tkt->id; ?>&&aksi_harga=ubah&&id=<?= $kpl['id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a onclick="return confirm('Yakin?')" href="harga.php?atas=<?= $tkt->id; ?>&&hapus=<?= $kpl['id']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                                                </td>
                                                <td><?= $kpl['harga']; ?></td>
                                                <td><?= $kpl['keterangan']; ?></td>
                                                <?php if ($kpl['pakai_kendaraan']) { ?>
                                                    <td><span class="btn btn-flat btn-success btn-xs">Ya</span></td>
                                                <?php } else { ?>
                                                    <td><span class="btn btn-flat btn-danger btn-xs">Tidak</span></td>
                                                <?php } ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>