<?php
include 'function.php';

// Tambah
if (isset($_POST['tambah'])) {
  if (db_insert('pengumuman', [
    'judul' => $_POST['judul'],
    'isi' => $_POST['isi'],
    'tanggal' => date('Y/m/d'),
    'waktu' => date('H:i:s'),
  ])) {
    setFlash('Berhasil menambahkan data');
    redirectBack();
  } else {
    setFlash('Gagal menambahkan data');
    redirectBack();
  }
}


// Ubah 
if (isset($_POST['ubah'])) {
  if (db_update('pengumuman', ['id' => $_GET['ubah']], [
    'judul' => $_POST['judul'],
    'isi' => $_POST['isi'],
  ])) {
    setFlash('Berhasil mengubah data');
    redirectBack();
  } else {
    setFlash('Gagal mengubah data');
    redirectBack();
  }
}

if (isset($_GET['tambah'])) {
  $tampil =  'tambah';
} elseif (isset($_GET['ubah'])) {
  if (!db_count('pengumuman', ['id' => $_GET['ubah']])) redirectBack();
  $data = db_find('pengumuman', ['id' => $_GET['ubah']]);
  $tampil =  'ubah';
} elseif (isset($_GET['hapus'])) {
  if (!db_count('pengumuman', ['id' => $_GET['hapus']])) redirectBack();
  if (db_delete('pengumuman', ['id' => $_GET['hapus']])) {
    setFlash('Berhasil menghapus data');
    redirectBack();
  } else {
    setFlash('Gagal menghapus data');
    redirectBack();
  }
} else {
  $tampil = null;
}

$sidebar_on = 'pengumuman';
include 'header.php'; ?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <?php flash(); ?>
      </div>
      <div class="col-12">
        <?php if ($tampil == 'tambah') : ?>
          <form method="POST" class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h5>Tambah Pengumuman</h5>
                <div>
                  <a href="pengumuman.php" class="btn btn-warning">Kembali</a>
                  <button name="tambah" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="judul">Judul</label>
                <input required type="text" name="judul" id="judul" class="form-control">
              </div>
              <div class="form-group mt-3">
                <label for="isi">Isi</label>
                <textarea required type="text" name="isi" id="isi" class="form-control" rows="10"></textarea>
              </div>
            </div>
          </form>
        <?php elseif ($tampil == 'ubah') : ?>
          <form method="POST" class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h5>Ubah Pengumuman</h5>
                <div>
                  <a href="pengumuman.php" class="btn btn-warning">Kembali</a>
                  <button name="ubah" class="btn btn-primary">Simpan Perubahan</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="judul">Judul</label>
                <input required type="text" name="judul" id="judul" class="form-control" value="<?= $data->judul; ?>">
              </div>
              <div class="form-group mt-3">
                <label for="isi">Isi</label>
                <textarea required type="text" name="isi" id="isi" class="form-control" rows="10"><?= $data->isi; ?></textarea>
              </div>
            </div>
          </form>
        <?php else : ?>
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h5>Kelola Pengumuman</h5>
                <a href="pengumuman.php?tambah" class="btn btn-primary">Tambah Data</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive overflow-auto">
                <table class="table table-bordered" id="example3">
                  <thead class="bg-primary text-light text-center">
                    <tr>
                      <th>AKSI</th>
                      <th>Waktu Upload</th>
                      <th>Judul</th>
                      <th>Isi</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach (db_findAll('pengumuman') as $pmmn) : ?>
                      <tr>
                        <td>
                          <a href="pengumuman.php?ubah=<?= $pmmn['id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                          <a onclick="return confirm('Hapus?')" href="pengumuman.php?hapus=<?= $pmmn['id']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
                          <a target="_blank" href="../pengumuman.php?id=<?= $pmmn['id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Lihat"><i class="fa fa-eye"></i></a>
                        </td>
                        <td><?= $pmmn['tanggal']; ?>, <?= $pmmn['waktu']; ?></td>
                        <td><?= $pmmn['judul']; ?></td>
                        <td><?= $pmmn['isi']; ?></td>
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