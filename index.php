<?php
include 'function.php';
$nav_on = 'index';
include 'header.php'; ?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <div class="row">
      <div class="col-xl-6">
        <h1>FerryWaai</h1>
        <h2>Solusi Mudah Pemesanan Tiket Feri Online</h2>
        <a href="#about" class="btn-get-started scrollto">Selanjutnya</a>
      </div>
    </div>
  </div>

</section><!-- End Hero -->

<main id="main">

  <!-- ======= Clients Section ======= -->
  <section id="clients" class="clients">
    <div class="container" data-aos="zoom-in">

      <div class="clients-slider swiper">
        <div class="swiper-wrapper align-items-center">
          <div class="swiper-slide"><img src="admin/dist/img/icon_kapal.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="admin/dist/img/LOGO-KABUPATEN-MALUKU-TENGAH-MALUKU.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="admin/dist/img/LOGO_KEMENTERIAN_PERHUBUNGAN_REPUBLIK_INDONESIA.png" class="img-fluid" alt=""></div>
          <div class="swiper-slide"><img src="admin/dist/img/logo-siwalima.jpg" class="img-fluid" alt=""></div>
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section>
  <!-- End Clients Section -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about section-bg">
    <div class="container" data-aos="fade-up">

      <div class="row no-gutters">
        <div class="content col-xl-5 d-flex align-items-stretch">
          <div class="content">
            <h3>Tentang Kami</h3>
            <p>Mengenal FeriWay, Pemimpin dalam Pemesanan Tiket Feri Online</p>
            <a href="tiket.php" class="about-btn"><span>Pesan Sekarang</span> <i class="bx bx-chevron-right"></i></a>
          </div>
        </div>
        <div class="col-xl-7 d-flex align-items-stretch">
          <div class="icon-boxes d-flex flex-column justify-content-center">
            <div class="row">
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-card"></i>
                <h4>Solusi Praktis Pemesanan Tiket Feri Online</h4>
                <p>Pemesanan tiket feri praktis dengan FeriWay! Mudah dan cepat.</p>
              </div>
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                <i class="bx bx-git-repo-forked"></i>
                <h4>Keandalan Terpercaya Pemesanan Tiket Feri Online</h4>
                <p>Keandalan terpercaya! Aman dan terjamin bersama FeriWay.</p>
              </div>
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                <i class="bx bx-book-content"></i>
                <h4>Inovasi Terkini Pemesanan Tiket Feri Secara Online</h4>
                <p>Inovasi terkini! Modern dan canggih dengan FeriWay.</p>
              </div>
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                <i class="bx bx-shield"></i>
                <h4>Pengalaman Pelanggan Memuaskan Pemesanan Tiket Feri</h4>
                <p>Pengalaman memuaskan! Pelanggan puas dengan FeriWay.</p>
              </div>
            </div>
          </div><!-- End .content-->
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= Counts Section ======= -->
  <section id="tentang" class="counts">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-people"></i>
            <span data-purecounter-start="0" data-purecounter-end="<?= db_count('pengguna'); ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Banyak Pengguna</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
          <div class="count-box">
            <i class="bi bi-journal-richtext"></i>
            <span data-purecounter-start="0" data-purecounter-end="<?= db_count('pemesanan', ['status' => 1]); ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Tiket Terjual</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="bi bi-radioactive"></i>
            <span data-purecounter-start="0" data-purecounter-end="<?= db_count('data_kapal'); ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Banyak Feri</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="bi bi-people-fill"></i>
            <span data-purecounter-start="0" data-purecounter-end="<?= db_count('pengguna', ['level' => 1]); ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p>Banyak Admin</p>
          </div>
        </div>

      </div>

    </div>
  </section>
  <!-- End Counts Section -->

  <!-- ======= Tabs Section ======= -->
  <section id="pengumuman" class="tabs">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-12 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
          <h3 class="text-center" style="font-weight: 700;">Pengumuman <i class="fa fa-volume-high text-danger"></i></h3>
          <p class="fst-italic fw-bold text-center">
            Pengumuman Terkini untuk Penumpang Kapal Feri!
          </p>
          <style>
            .linfo:hover {
              background-color: red;
              color: #fff;
            }
          </style>
          <ul style="list-style: none; padding-left: 0;">
            <?php $i = 1; ?>
            <?php foreach (db_findAll('pengumuman') as $pmmn) : ?>
              <li class="linfo" onclick="window.location.href='pengumuman.php?id=<?= $pmmn['id']; ?>'" style="cursor: pointer;"><i class="fa fa-circle-dot text-danger me-3"></i> <?= $pmmn['judul']; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

    </div>
  </section>

  <!-- ======= Services Section ======= -->
  <section id="agenda" class="services section-bg ">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Agenda</h2>
        <p>Tetap Up-to-Date dengan Agenda Keberangkatan</p>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="icon-box bg-transparent p-0" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
              <style>
                table {
                  width: 100%;
                  border-collapse: collapse;
                  border: 1px solid #fff;
                  font-size: 14px;
                }

                table th,
                table td {
                  padding: 12px;
                  text-align: left;
                  border: 1px solid #ddd;
                }

                table th {
                  background-color: #f9f9f9;
                  color: #333;
                  font-weight: bold;
                }

                table tr:hover {
                  background-color: #F9F9F9;
                  color: #333;
                }
              </style>
              <div class="col-12 table-responsive">
                <table>
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Waktu</th>
                      <th>Lintasan</th>
                      <th>Kapal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (db_query('SELECT * FROM data_tiket WHERE status = 1 ORDER BY tanggal_keberangkatan ASC') as $tkt) : ?>
                      <tr onclick="window.location.href='harga.php?id=<?= $tkt['id']; ?>';" style="cursor: pointer;">
                        <td><?= ubahHari(date('l', strtotime($tkt['tanggal_keberangkatan']))) . date(', d-m-Y', strtotime($tkt['tanggal_keberangkatan'])); ?></td>
                        <td><?= $tkt['waktu_keberangkatan']; ?></td>
                        <td><?= $tkt['asal']; ?> - <?= $tkt['tujuan']; ?></td>
                        <td><?= db_find('data_kapal', ['id' => $tkt['kapal_id']])->nama; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="col-12 text-end mt-3">
                <a href="tiket.php" class="btn btn-danger">Selengkapnya</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Pricing Section ======= -->
  <!-- <section id="pricing" class="pricing section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Pricing</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea.</p>
      </div>

      <div class="row">

        <div class="col-lg-4 col-md-6">
          <div class="box" data-aos="fade-up" data-aos-delay="100">
            <h3>Free</h3>
            <h4><sup>$</sup>0<span> / month</span></h4>
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li class="na">Pharetra massa</li>
              <li class="na">Massa ultricies mi</li>
            </ul>
            <div class="btn-wrap">
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
          <div class="box featured" data-aos="fade-up" data-aos-delay="200">
            <h3>Business</h3>
            <h4><sup>$</sup>19<span> / month</span></h4>
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li>Pharetra massa</li>
              <li class="na">Massa ultricies mi</li>
            </ul>
            <div class="btn-wrap">
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
          <div class="box" data-aos="fade-up" data-aos-delay="300">
            <h3>Developer</h3>
            <h4><sup>$</sup>29<span> / month</span></h4>
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li>Pharetra massa</li>
              <li>Massa ultricies mi</li>
            </ul>
            <div class="btn-wrap">
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section> -->
  <!-- End Pricing Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Kontak</h2>
        <p>Kami Siap Membantu Anda</p>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-6">

          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3>Alamat Kami</h3>
                <p>Desa Waai, Kecamatan Salahutu, Maluku Tengah</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-envelope"></i>
                <h3>Email Kami</h3>
                <p>feriway@gmail.com<br>admin@feriway.com</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-phone-call"></i>
                <h3>Hubungi Kami</h3>
                <p>+62 8131 88120 27<br>+62 8124 88085 75</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col form-group">
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Kamu" required>
              </div>
              <div class="col form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Kamu" required>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" required>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="pesan" rows="5" placeholder="Pesan" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Menunggu</div>
              <div class="error-message"></div>
              <div class="sent-message">Pesan anda terkirim. Terimakasih!</div>
            </div>
            <div class="text-center"><button type="submit">Kirim Pesan</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->

<?php include 'footer.php'; ?>