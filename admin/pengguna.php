<?php
include 'function.php';


// Tambah Pengguna
if (isset($_POST['tambah'])) {
    if (empty($_POST['nama_lengkap']) && empty($_POST['level']) && empty($_POST['email']) & empty($_POST['nomor_telepon']) && empty($_POST['username']) && empty($_POST['password'])) {
        setFlash('Inputan tidak boleh kosong');
        redirectBack();
    }
    if (db_insert('pengguna', [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'level' => $_POST['level'],
        'nama_lengkap' => $_POST['nama_lengkap'],
        'email' => $_POST['email'],
        'nomor_telepon' => $_POST['nomor_telepon']
    ])) {
        setFlash('Berhasil Menambahkan Data');
    } else {
        setFlash('Gagal Menambahkan Data');
    }
    redirectBack();
}

// Ubah Pengguna
if (isset($_POST['ubah'])) {
    if (empty($_POST['nama_lengkap']) && empty($_POST['level']) && empty($_POST['email']) & empty($_POST['nomor_telepon']) && empty($_POST['username']) && empty($_POST['password'])) {
        setFlash('Inputan tidak boleh kosong');
        redirectBack();
    }
    if (db_update('pengguna', ['id' => $_GET['id']], [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'level' => $_POST['level'],
        'nama_lengkap' => $_POST['nama_lengkap'],
        'email' => $_POST['email'],
        'nomor_telepon' => $_POST['nomor_telepon']
    ])) {
        setFlash('Berhasil Mengubah Data');
    } else {
        setFlash('Gagal Mengubah Data');
    }
    redirectBack();
}

// Hapus Pengguna
if (isset($_GET['hapus'])) {
    if (db_count('pengguna', ['id' => $_GET['hapus']])) {
        if (db_delete('pengguna', ['id' => $_GET['hapus']])) {
            setFlash('Berhasil menghapus data');
            redirectBack();
        }
    }
    setFlash('Gagal menghapus data');
    redirectBack();
}

// Ubah Status Pengguna
if (isset($_GET['status'])) {
    if (db_count('pengguna', ['id' => $_GET['status']])) {
        if (db_find('pengguna', ['id' => $_GET['status']])->status) {
            if (db_update('pengguna', ['id' => $_GET['status']], ['status' => 0])) {
                setFlash('Pengguna di Non Aktifkan');
                redirectBack();
            }
            die;
        } else {
            if (db_update('pengguna', ['id' => $_GET['status']], ['status' => 1])) {
                setFlash('Pengguna di Aktifkan');
                redirectBack();
            }
        }
    }
    setFlash('Gagal mengubah status pengguna');
    redirectBack();
}

// Untuk aksi pengguna
if (isset($_GET['aksi_pengguna'])) {
    if (empty($_GET['aksi_pengguna'])) {
        unset($_SESSION['aksi_pengguna']);
    } else {
        $_SESSION['aksi_pengguna'] = $_GET['aksi_pengguna'];
        // Deteksi Id
        if (isset($_GET['id']) && db_count('pengguna', ['id' => $_GET['id']])) {
            redirect('pengguna.php?id=' . $_GET['id']);
        } else {
            redirect('pengguna.php');
        }
    }
    redirect('pengguna.php');
}

$sidebar_on = 'berita';
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
                            <a href="pengguna.php?aksi_pengguna" class="list-group-item list-group-item-action <?= (!isset($_SESSION['aksi_pengguna'])) ? 'active' : ''; ?><?= (isset($_SESSION['aksi_pengguna'])) ? ($_SESSION['aksi_pengguna'] == 'tampil' ? 'active' : '') : ''; ?><?= (isset($_SESSION['aksi_pengguna'])) ? ($_SESSION['aksi_pengguna'] == 'ubah' ? 'active' : '') : ''; ?>" aria-current="true">Data Pengguna</a>
                            <a href="pengguna.php?aksi_pengguna=tambah" class="list-group-item list-group-item-action <?= (isset($_SESSION['aksi_pengguna'])) ? ($_SESSION['aksi_pengguna'] == 'tambah' ? 'active' : '') : ''; ?>">Tambah Pengguna</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <?php if (isset($_SESSION['aksi_pengguna']) && $_SESSION['aksi_pengguna'] == 'tambah') : ?>
                    <form method="POST" class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Tambah Pengguna</h5>
                                <button name="tambah" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input required type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="level">Level</label>
                                    <select required type="text" name="level" id="level" class="form-control">
                                        <option value=""></option>
                                        <option value="1">Admin</option>
                                        <option value="0">Penumpang</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="email">Email</label>
                                    <input required type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input required type="number" name="nomor_telepon" id="nomor_telepon" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="username">Username</label>
                                    <input required type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="password">Password</label>
                                    <input required type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                <?php elseif (isset($_SESSION['aksi_pengguna']) && $_SESSION['aksi_pengguna'] == 'ubah') : ?>
                    <form method="POST" class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Ubah Data Pengguna</h5>
                                <div class="">
                                    <a href="pengguna.php?aksi_pengguna" class="btn btn-warning">Kembali</a>
                                    <button name="ubah" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if (db_count('pengguna', ['id' => $_GET['id']])) { ?>
                                    <?php $p = db_find('pengguna', ['id' => $_GET['id']]); ?>
                                    <div class="col-md-6 mt-2">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input required type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= $p->nama_lengkap ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="level">Level</label>
                                        <select required type="text" name="level" id="level" class="form-control">
                                            <option value=""></option>
                                            <option <?= $p->level == 1 ? 'selected' : '' ?> value="1">Admin</option>
                                            <option <?= $p->level == 1 ? '' : 'selected' ?> value="0">Penumpang</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="email">Email</label>
                                        <input required type="email" name="email" id="email" class="form-control" value="<?= $p->email ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="nomor_telepon">Nomor Telepon</label>
                                        <input required type="number" name="nomor_telepon" id="nomor_telepon" class="form-control" value="<?= $p->nomor_telepon ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="username">Username</label>
                                        <input required type="text" name="username" id="username" class="form-control" value="<?= $p->username ?>">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="password">Password</label>
                                        <input required type="password" name="password" id="password" class="form-control" value="<?= $p->password ?>">
                                    </div>
                                <?php } else { ?>
                                    <div class="col-12 text-center">
                                        <label for="password">Tidak ada data</label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                <?php elseif (isset($_SESSION['aksi_pengguna']) && $_SESSION['aksi_pengguna'] == 'lihat') : ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5>Filter Pengguna</h5>
                                <a href="pengguna.php?aksi_pengguna" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive overflow-auto">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <?php if (db_count('pengguna', ['id' => $_GET['id']])) { ?>
                                            <?php $p = db_find('pengguna', ['id' => $_GET['id']]); ?>
                                            <tr>
                                                <th>NAMA</th>
                                                <td><?= $p->nama_lengkap; ?></td>
                                            </tr>
                                            <tr>
                                                <th>EMAIL</th>
                                                <td><?= $p->email; ?></td>
                                            </tr>
                                            <tr>
                                                <th>NO TELEPON</th>
                                                <td><?= $p->nomor_telepon; ?></td>
                                            </tr>
                                            <tr>
                                                <th>USERNAME</th>
                                                <td><?= $p->username; ?></td>
                                            </tr>
                                            <tr>
                                                <th>LEVEL</th>
                                                <td><?= $p->level == 1 ? 'Admin' : 'User'; ?></td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr>
                                                <th>Tidak ada data</th>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php elseif (isset($_SESSION['aksi_pengguna']) && $_SESSION['aksi_pengguna'] == 'filter') : ?>
                    <div class="card">
                        <div class="card-header">
                            <h5>Filter Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive overflow-auto">
                                <table class="table table-bordered" id="example3">
                                    <thead class="bg-primary text-light text-center">
                                        <tr>
                                            <th>AKSI</th>
                                            <th>USERNAME</th>
                                            <th>LEVEL</th>
                                            <th>NAMA</th>
                                            <th>EMAIL</th>
                                            <th>NO TELEPON</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                                                <button class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Kunci"><i class="fa fa-lock"></i></button>
                                                <button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="fa fa-eye"></i></button>
                                            </td>
                                            <td>alfreinsco</td>
                                            <td>Admin</td>
                                            <td>Marthin Alfreinsco Salakory</td>
                                            <td>marthinsalakory11@gmail.com</td>
                                            <td>081318812027</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="card">
                        <div class="card-header">
                            <h5>Kelola Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive overflow-auto">
                                <table class="table table-bordered" id="example3">
                                    <thead class="bg-primary text-light text-center">
                                        <tr>
                                            <th>AKSI</th>
                                            <th>USERNAME</th>
                                            <th>LEVEL</th>
                                            <th>NAMA LENGKAP</th>
                                            <th>EMAIL</th>
                                            <th>NOMOR TELEPON</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php foreach (db_findAll('pengguna') as $u) : ?>
                                            <tr>
                                                <td>
                                                    <a href="pengguna.php?aksi_pengguna=ubah&&id=<?= $u['id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <?php if ($_SESSION['login'] != $u['id']) : ?>
                                                        <a onclick="return confirm('Yakin?')" href="pengguna.php?hapus=<?= $u['id']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                                                    <?php endif; ?>
                                                    <?php if ($u['status'] == 1) { ?>
                                                        <a href="pengguna.php?status=<?= $u['id']; ?>" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Non Aktifkan"><i class="fa fa-unlock"></i></a>
                                                    <?php } else { ?>
                                                        <a href="pengguna.php?status=<?= $u['id']; ?>" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Aktifkan"><i class="fa fa-lock"></i></a>
                                                    <?php } ?>
                                                    <a href="?aksi_pengguna=lihat&&id=<?= $u['id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td><?= $u['username']; ?></td>
                                                <td><?= $u['level'] == 1 ? 'Admin' : 'User'; ?></td>
                                                <td><?= $u['nama_lengkap']; ?></td>
                                                <td><?= $u['email']; ?></td>
                                                <td><?= $u['nomor_telepon']; ?></td>
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