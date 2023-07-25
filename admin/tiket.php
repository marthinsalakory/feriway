<?php
include 'function.php';


// Tambah Tiket
if (isset($_POST['tambah'])) {
    if (db_insert('data_tiket', [
        'kapal_id' => $_POST['kapal_id'],
        'tanggal_keberangkatan' => $_POST['tanggal_keberangkatan'],
        'waktu_keberangkatan' => $_POST['waktu_keberangkatan'],
        'asal' => $_POST['asal'],
        'tujuan' => $_POST['tujuan'],
        'status' => 1,
    ])) {
        setFlash('Berhasil Menambahkan Data');
    } else {
        setFlash('Gagal Menambahkan Data');
    }
    redirectBack();
}

// Ubah Tiket
if (isset($_POST['ubah'])) {
    if (db_update('data_tiket', ['id' => $_GET['id']], [
        'kapal_id' => $_POST['kapal_id'],
        'tanggal_keberangkatan' => $_POST['tanggal_keberangkatan'],
        'waktu_keberangkatan' => $_POST['waktu_keberangkatan'],
        'asal' => $_POST['asal'],
        'tujuan' => $_POST['tujuan'],
    ])) {
        setFlash('Berhasil Mengubah Data');
    } else {
        setFlash('Gagal Mengubah Data');
    }
    redirectBack();
}

// Hapus Tiket
if (isset($_GET['hapus'])) {
    if (db_count('data_tiket', ['id' => $_GET['hapus']])) {
        if (db_delete('data_tiket', ['id' => $_GET['hapus']])) {
            setFlash('Berhasil menghapus data');
            redirectBack();
        }
    }
    setFlash('Gagal menghapus data');
    redirectBack();
}

// Ubah Status Tiket
if (isset($_GET['status'])) {
    if (db_count('data_tiket', ['id' => $_GET['status']])) {
        if (db_find('data_tiket', ['id' => $_GET['status']])->status) {
            if (db_update('data_tiket', ['id' => $_GET['status']], ['status' => 0])) {
                setFlash('Berhasil Menutup Tiket');
                redirectBack();
            }
        } else {
            if (db_update('data_tiket', ['id' => $_GET['status']], ['status' => 1])) {
                setFlash('Berhasil Mengaktifkan Tiket');
                redirectBack();
            }
        }
    }
    setFlash('Gagal Ubah Status');
    redirectBack();
}

// Untuk aksi Tiket
if (isset($_GET['aksi_tiket'])) {
    if (empty($_GET['aksi_tiket'])) {
        unset($_SESSION['aksi_tiket']);
    } else {
        $_SESSION['aksi_tiket'] = $_GET['aksi_tiket'];
        // Deteksi Id
        if (isset($_GET['id']) && db_count('data_tiket', ['id' => $_GET['id']])) {
            redirect('tiket.php?id=' . $_GET['id']);
        } else {
            redirect('tiket.php');
        }
    }
    redirect('tiket.php');
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
                            <a href="tiket.php?aksi_tiket" class="list-group-item list-group-item-action <?= (!isset($_SESSION['aksi_tiket'])) ? 'active' : ''; ?><?= (isset($_SESSION['aksi_tiket'])) ? ($_SESSION['aksi_tiket'] == 'tampil' ? 'active' : '') : ''; ?><?= (isset($_SESSION['aksi_tiket'])) ? ($_SESSION['aksi_tiket'] == 'ubah' ? 'active' : '') : ''; ?>" aria-current="true">Data Tiket</a>
                            <a href="tiket.php?aksi_tiket=tambah" class="list-group-item list-group-item-action <?= (isset($_SESSION['aksi_tiket'])) ? ($_SESSION['aksi_tiket'] == 'tambah' ? 'active' : '') : ''; ?>">Tambah Tiket</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <?php if (isset($_SESSION['aksi_tiket']) && $_SESSION['aksi_tiket'] == 'tambah') : ?>
                    <form method="POST" class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Tambah Tiket</h5>
                                <div>
                                    <a href="tiket.php?aksi_tiket" class="btn btn-warning">Kembali</a>
                                    <button name="tambah" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <label for="kapal_id">Kapal</label>
                                    <select required type="text" name="kapal_id" id="kapal_id" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php foreach (db_findAll('data_kapal') as $kpl) : ?>
                                            <option value="<?= $kpl['id']; ?>"><?= $kpl['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="tanggal_keberangkatan">Tanggal Keberangkatan</label>
                                    <input required type="date" name="tanggal_keberangkatan" id="tanggal_keberangkatan" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="waktu_keberangkatan">Waktu Keberangkatan</label>
                                    <input required type="time" name="waktu_keberangkatan" id="waktu_keberangkatan" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="asal">Pelabuhan Asal</label>
                                    <input required type="text" name="asal" id="asal" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="tujuan">Pelabuhan Tujuan</label>
                                    <input required type="text" name="tujuan" id="tujuan" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                <?php elseif (isset($_SESSION['aksi_tiket']) && $_SESSION['aksi_tiket'] == 'ubah') : ?>
                    <form method="POST" class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Ubah Data Tiket</h5>
                                <div class="">
                                    <a href="tiket.php?aksi_tiket" class="btn btn-warning">Kembali</a>
                                    <button name="ubah" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if (db_count('data_tiket', ['id' => $_GET['id']])) { ?>
                                    <?php $p = db_find('data_tiket', ['id' => $_GET['id']]); ?>
                                    <div class="col-12 mt-2">
                                        <label for="kapal_id">Kapal</label>
                                        <select required type="text" name="kapal_id" id="kapal_id" class="form-control">
                                            <option value="">Pilih</option>
                                            <?php foreach (db_findAll('data_kapal') as $kpl) : ?>
                                                <option <?= $p->kapal_id == $kpl['id'] ? 'selected' : ''; ?> value="<?= $kpl['id']; ?>"><?= $kpl['nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="tanggal_keberangkatan">Tanggal Keberangkatan</label>
                                        <input required type="date" name="tanggal_keberangkatan" id="tanggal_keberangkatan" class="form-control" value="<?= $p->tanggal_keberangkatan; ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="waktu_keberangkatan">Waktu Keberangkatan</label>
                                        <input required type="time" name="waktu_keberangkatan" id="waktu_keberangkatan" class="form-control" value="<?= $p->waktu_keberangkatan; ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="asal">Pelabuhan Asal</label>
                                        <input required type="text" name="asal" id="asal" class="form-control" value="<?= $p->asal; ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="tujuan">Pelabuhan Tujuan</label>
                                        <input required type="text" name="tujuan" id="tujuan" class="form-control" value="<?= $p->tujuan; ?>">
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
                                <h5>Data Tiket</h5>
                                <a href="tiket.php?aksi_tiket=tambah" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive overflow-auto">
                                <table class="table table-bordered" id="example3">
                                    <thead class="bg-primary text-light text-center">
                                        <tr>
                                            <th>AKSI</th>
                                            <th>NAMA KAPAL</th>
                                            <th>TANGGAL KEBERANGKATAN</th>
                                            <th>WAKTU KEBERANGKATAN</th>
                                            <th>LINTASAN</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php foreach (db_findAll('data_tiket') as $tkt) : ?>
                                            <tr>
                                                <td>
                                                    <a href="harga.php?atas=<?= $tkt['id']; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Kelola Harga Tiket"><i class="fa-solid fa-rupiah-sign"></i></a>
                                                    <a href="tiket.php?aksi_tiket=ubah&&id=<?= $tkt['id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <?php if (!db_count('harga_tiket', ['tiket_id' => $tkt['id']])) { ?>
                                                        <a onclick="return confirm('Yakin?')" href="tiket.php?hapus=<?= $tkt['id']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                    <?php if ($tkt['status']) { ?>
                                                        <a href="tiket.php?status=<?= $tkt['id']; ?>" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Tutup Pemesanan"><i class="fa fa-unlock"></i></a>
                                                    <?php } else { ?>
                                                        <a href="tiket.php?status=<?= $tkt['id']; ?>" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Buka Pemesanan"><i class="fa fa-lock"></i></a>
                                                    <?php } ?>
                                                </td>
                                                <td><?= db_find('data_kapal', ['id' => $tkt['kapal_id']])->nama; ?></td>
                                                <td><?= $tkt['tanggal_keberangkatan']; ?></td>
                                                <td><?= $tkt['waktu_keberangkatan']; ?></td>
                                                <td><?= $tkt['asal']; ?> - <?= $tkt['tujuan']; ?></td>
                                                <?php if ($tkt['status']) { ?>
                                                    <td><span class="btn btn-flat btn-success btn-xs">Buka</span></td>
                                                <?php } else { ?>
                                                    <td><span class="btn btn-flat btn-danger btn-xs">Tutup</span></td>
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