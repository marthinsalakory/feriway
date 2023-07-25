<?php
include 'function.php';
if (!db_count('pengumuman', ['id' => $_GET['id']])) redirectBack();
$data = db_find('pengumuman', ['id' => $_GET['id']]);
$nav_on = 'login';
include 'header.php'; ?>

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="index.php">Beranda</a></li>
      <li>Pengumuman</li>
    </ol>
    <h2>Pengumuman</h2>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">

    <div class="row">

      <div class="col-12 entries">

        <article class="entry entry-single">

          <h2 class="entry-title">
            <a href="blog-single.html"><?= $data->judul; ?></a>
          </h2>

          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01"><?= $data->tanggal; ?> <?= $data->waktu; ?></time></a></li>
            </ul>
          </div>

          <div class="entry-content">
            <p><?= nl2br($data->isi); ?></p>

          </div>

        </article><!-- End blog entry -->

      </div><!-- End blog entries list -->

    </div>

  </div>
</section><!-- End Blog Single Section -->

</main><!-- End #main -->

<?php include 'footer.php'; ?>