<?php
include 'function.php';

// Hapus Kapal
if (isset($_GET['hapus'])) {
    if (db_count('kontak', ['id' => $_GET['hapus']])) {
        if (db_delete('kontak', ['id' => $_GET['hapus']])) {
            setFlash('Berhasil menghapus data');
            redirectBack();
        }
    }
    setFlash('Gagal menghapus data');
    redirectBack();
}

$sidebar_on = 'kontak';
include 'header.php'; ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php flash(); ?>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5>Umpan Balik</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive overflow-auto">
                            <table class="table table-bordered" id="example3">
                                <thead class="bg-primary text-light text-center">
                                    <tr>
                                        <th>AKSI</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>JUDUL</th>
                                        <th>PESAN</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach (db_findAll('kontak') as $kntk) : ?>
                                        <tr>
                                            <td><a onclick="return confirm('Yakin?')" href="kontak.php?hapus=<?= $kntk['id']; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a></td>
                                            <td><?= $kntk['nama']; ?></td>
                                            <td><?= $kntk['email']; ?></td>
                                            <td><?= $kntk['judul']; ?></td>
                                            <td><?= $kntk['pesan']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>