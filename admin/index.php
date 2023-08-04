<?php
include 'function.php';
$sidebar_on = 'dashboard';
include 'header.php'; ?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= db_count('data_kapal'); ?></h3>

            <p>Ferry</p>
          </div>
          <div class="icon">
            <i class="fa-solid fa-ferry"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= db_count('pengguna'); ?></h3>

            <p>Pengguna</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= db_count('data_tiket', ['status' => 1]); ?></h3>

            <p>Tiket Aktif</p>
          </div>
          <div class="icon">
            <i class="fa fa-ticket"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= db_count('pemesanan'); ?></h3>

            <p>Pemesanan</p>
          </div>
          <div class="icon">
            <i class="fa fa-table"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<?php include 'footer.php'; ?>