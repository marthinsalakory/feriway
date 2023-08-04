<?php
include 'function.php';


// Status 
if (isset($_POST['status'])) {
  if (db_update('pemesanan', ['id' => $_POST['id']], [
    'status' => $_POST['status'],
  ])) {
    setFlash('Berhasil mengubah status');
    redirectBack();
  } else {
    setFlash('Gagal mengubah status');
    redirectBack();
  }
}

if (isset($_GET['hapus'])) {
  $pms = db_find('pemesanan', ['id' => $_GET['hapus']]);
  if (db_delete('pemesanan', ['id' => $_GET['hapus']])) {
    unlink('../uploads/' . $pms->slip_pembayaran);
  }
  setFlash('Berhasil hapus 1 data pemesanan');
  redirectBack();
}
$sidebar_on = 'pemesanan';
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
              <h5>Data Pemesanan</h5>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive overflow-auto">
              <table class="table table-bordered" id="example3">
                <thead class="bg-primary text-light text-center">
                  <tr>
                    <th>Aksi</th>
                    <th>Ubah Status Pembayaran</th>
                    <th>Nama Bank</th>
                    <th>Nomor Rekening Pengirim</th>
                    <th>Pemegang Rekening Pengirim</th>
                    <th>Kode Referensi Pengiriman</th>
                    <th>Slip Pengiriman</th>
                    <th>Merek Kendaraan</th>
                    <th>Tipe Kendaraan</th>
                    <th>Nomor Polisi</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Nama Kapal</th>
                    <th>Nama Bank Tujuan</th>
                    <th>Nomor Rekening Tujuan</th>
                    <th>Pemegang Rekening Tujuan</th>
                    <th>Kode Bank Tujuan</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Pelabuhan Asal</th>
                    <th>Pelabuhan Tujuan</th>
                    <th>Status Tiket</th>
                    <th>Harga Tiket</th>
                    <th>Keterangan</th>
                    <th>Pakai Kendaraan</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <?php foreach (db_findAll('v_pemesanan') as $v) : ?>
                    <tr>
                      <td><a href="?hapus=<?= $v['id']; ?>" onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                      <td>
                        <form method="POST">
                          <input type="hidden" name="id" value="<?= $v['id']; ?>">
                          <select onchange="this.parentNode.submit()" name="status">
                            <option value="">Pilih Aksi</option>
                            <option <?= $v['status'] == 1 ? 'selected' : ''; ?> value="1">Konfirmasi</option>
                            <option <?= $v['status'] == 2 ? 'selected' : ''; ?> value="2">Tolak</option>
                          </select>
                        </form>
                      </td>
                      <td><?= $v['nama_bank']; ?></td>
                      <td><?= $v['nomor_rekening']; ?></td>
                      <td><?= $v['pemegang_rekening']; ?></td>
                      <td><?= $v['kode_referensi']; ?></td>
                      <td><a href="../uploads/<?= $v['slip_pembayaran']; ?>" class="text-success"><i class="fa fa-file"></i></a></td>
                      <td><?= $v['merek_kendaraan']; ?></td>
                      <td><?= $v['tipe_kendaraan']; ?></td>
                      <td><?= $v['nomor_polisi']; ?></td>
                      <td><?= $v['status'] == 1 ? 'Dikonfirmasi' : ($v['status'] == 2 ? 'Ditolak' : 'Menunggu'); ?></td>
                      <td><?= $v['tanggal_keberangkatan']; ?></td>
                      <td><?= $v['waktu_keberangkatan']; ?></td>
                      <td><?= $v['nama_kapal']; ?></td>
                      <td><?= $v['nama_bank2']; ?></td>
                      <td><?= $v['nomor_rekening2']; ?></td>
                      <td><?= $v['pemegang_rekening2']; ?></td>
                      <td><?= $v['kode_bank2']; ?></td>
                      <td><?= $v['tanggal_keberangkatan']; ?></td>
                      <td><?= $v['waktu_keberangkatan']; ?></td>
                      <td><?= $v['asal']; ?></td>
                      <td><?= $v['tujuan']; ?></td>
                      <td><?= $v['tiket_status'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                      <td>Rp. <?= $v['harga']; ?></td>
                      <td><?= $v['keterangan']; ?></td>
                      <td><?= $v['pakai_kendaraan'] == 1 ? 'Ya' : 'Tidak'; ?></td>
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