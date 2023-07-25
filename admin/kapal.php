<?php
include 'function.php';


// Tambah Kapal
if (isset($_POST['tambah'])) {
    if (empty($_POST['nama'])) {
        setFlash('Inputan tidak boleh kosong');
        redirectBack();
    }
    if (db_insert('data_kapal', [
        'nama' => $_POST['nama'],
        'nama_bank' => $_POST['nama_bank'],
        'nomor_rekening' => $_POST['nomor_rekening'],
        'pemegang_rekening' => $_POST['pemegang_rekening'],
        'kode_bank' => $_POST['kode_bank'],
    ])) {
        setFlash('Berhasil Menambahkan Data');
    } else {
        setFlash('Gagal Menambahkan Data');
    }
    redirectBack();
}

// Ubah Kapal
if (isset($_POST['ubah'])) {
    if (empty($_POST['nama'])) {
        setFlash('Inputan tidak boleh kosong');
        redirectBack();
    }
    if (db_update('data_kapal', ['id' => $_GET['id']], [
        'nama' => $_POST['nama'],
        'nama_bank' => $_POST['nama_bank'],
        'nomor_rekening' => $_POST['nomor_rekening'],
        'pemegang_rekening' => $_POST['pemegang_rekening'],
        'kode_bank' => $_POST['kode_bank'],
    ])) {
        setFlash('Berhasil Mengubah Data');
    } else {
        setFlash('Gagal Mengubah Data');
    }
    redirectBack();
}

// Hapus Kapal
if (isset($_GET['hapus'])) {
    if (db_count('data_kapal', ['id' => $_GET['hapus']])) {
        if (db_delete('data_kapal', ['id' => $_GET['hapus']])) {
            setFlash('Berhasil menghapus data');
            redirectBack();
        }
    }
    setFlash('Gagal menghapus data');
    redirectBack();
}

// Untuk aksi Kapal
if (isset($_GET['aksi_kapal'])) {
    if (empty($_GET['aksi_kapal'])) {
        unset($_SESSION['aksi_kapal']);
    } else {
        $_SESSION['aksi_kapal'] = $_GET['aksi_kapal'];
        // Deteksi Id
        if (isset($_GET['id']) && db_count('data_kapal', ['id' => $_GET['id']])) {
            redirect('kapal.php?id=' . $_GET['id']);
        } else {
            redirect('kapal.php');
        }
    }
    redirect('kapal.php');
}

$sidebar_on = 'kapal';
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
                            <a href="kapal.php?aksi_kapal" class="list-group-item list-group-item-action <?= (!isset($_SESSION['aksi_kapal'])) ? 'active' : ''; ?><?= (isset($_SESSION['aksi_kapal'])) ? ($_SESSION['aksi_kapal'] == 'tampil' ? 'active' : '') : ''; ?><?= (isset($_SESSION['aksi_kapal'])) ? ($_SESSION['aksi_kapal'] == 'ubah' ? 'active' : '') : ''; ?>" aria-current="true">Data Kapal</a>
                            <a href="kapal.php?aksi_kapal=tambah" class="list-group-item list-group-item-action <?= (isset($_SESSION['aksi_kapal'])) ? ($_SESSION['aksi_kapal'] == 'tambah' ? 'active' : '') : ''; ?>">Tambah Kapal</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <?php if (isset($_SESSION['aksi_kapal']) && $_SESSION['aksi_kapal'] == 'tambah') : ?>
                    <form method="POST" class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Tambah Kapal</h5>
                                <div>
                                    <a href="kapal.php?aksi_kapal" class="btn btn-warning">Kembali</a>
                                    <button name="tambah" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <label for="nama">Nama Kapal</label>
                                    <input required type="text" name="nama" id="nama" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="nama_bank">Nama Bank</label>
                                    <input required type="text" name="nama_bank" id="nama_bank" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="nomor_rekening">Nomor Rekening</label>
                                    <input required type="text" name="nomor_rekening" id="nomor_rekening" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="pemegang_rekening">Nama Pemegang Rekening</label>
                                    <input required type="text" name="pemegang_rekening" id="pemegang_rekening" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="kode_bank">Kode Bank</label>
                                    <input required type="text" name="kode_bank" id="kode_bank" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                <?php elseif (isset($_SESSION['aksi_kapal']) && $_SESSION['aksi_kapal'] == 'ubah') : ?>
                    <form method="POST" class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Ubah Data Kapal</h5>
                                <div class="">
                                    <a href="kapal.php?aksi_kapal" class="btn btn-warning">Kembali</a>
                                    <button name="ubah" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if (db_count('data_kapal', ['id' => $_GET['id']])) { ?>
                                    <?php $p = db_find('data_kapal', ['id' => $_GET['id']]); ?>
                                    <div class="col-12 mt-2">
                                        <label for="nama">Nama Kapal</label>
                                        <input required type="text" name="nama" id="nama" class="form-control" value="<?= $p->nama ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="nama_bank">Nama Bank</label>
                                        <input required type="text" name="nama_bank" id="nama_bank" class="form-control" value="<?= $p->nama_bank ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="nomor_rekening">Nomor Rekening</label>
                                        <input required type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" value="<?= $p->nomor_rekening ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="pemegang_rekening">Nama Pemegang Rekening</label>
                                        <input required type="text" name="pemegang_rekening" id="pemegang_rekening" class="form-control" value="<?= $p->pemegang_rekening ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="kode_bank">Kode Bank</label>
                                        <input required type="text" name="kode_bank" id="kode_bank" class="form-control" value="<?= $p->kode_bank ?>">
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
                                <h5>Data Kapal</h5>
                                <a href="kapal.php?aksi_kapal=tambah" class="btn btn-primary">Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive overflow-auto">
                                <table class="table table-bordered" id="example3">
                                    <thead class="bg-primary text-light text-center">
                                        <tr>
                                            <th>AKSI</th>
                                            <th>NAMA KAPAL</th>
                                            <th>NAMA BANK</th>
                                            <th>NOMOR REKENING</th>
                                            <th>NAMA PEMEGANG REKENING</th>
                                            <th>KODE BANK</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php foreach (db_findAll('data_kapal') as $kpl) : ?>
                                            <tr>
                                                <td>
                                                    <a href="kapal.php?aksi_kapal=ubah&&id=<?= $kpl['id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <?php if (!db_count('data_tiket', ['kapal_id' => $kpl['id']])) { ?>
                                                        <a onclick="return confirm('Yakin?')" href="kapal.php?hapus=<?= $kpl['id']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                </td>
                                                <td><?= $kpl['nama']; ?></td>
                                                <td><?= $kpl['nama_bank']; ?></td>
                                                <td><?= $kpl['nomor_rekening']; ?></td>
                                                <td><?= $kpl['pemegang_rekening']; ?></td>
                                                <td><?= $kpl['kode_bank']; ?></td>
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