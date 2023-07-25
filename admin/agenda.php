<?php
$sidebar_on = 'agenda';
include 'header.php'; ?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <div class="card">
          <div class="card-header">
            <h5>Aksi Lainnya</h5>
          </div>
          <div class="card-body">
            <button class="btn btn-primary w-100">Tambah Data</button>
          </div>
        </div>
      </div>
      <div class="col-9">
        <div class="card">
          <div class="card-header">
            <h5>Data Agenda Keberangkatan</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive overflow-auto">
              <table class="table table-bordered" id="example3">
                <thead class="bg-primary text-light text-center">
                  <tr>
                    <th>AKSI</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Rute</th>
                    <th>Kapal</th>
                    <th>Durasi</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Rute</th>
                    <th>Kapal</th>
                    <th>Durasi</th>
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
                    <td>2023-07-05</td>
                    <td>09:00</td>
                    <td>Pelabuhan A - Pelabuhan B</td>
                    <td>Kapal Feri 1</td>
                    <td>2 jam 30 menit</td>
                    <td>2023-07-05</td>
                    <td>09:00</td>
                    <td>Pelabuhan A - Pelabuhan B</td>
                    <td>Kapal Feri 1</td>
                    <td>2 jam 30 menit</td>
                  </tr>
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