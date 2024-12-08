<body>
  <div class="container mt-5">
    <h1>Target Sampah</h1>
    <a href="<?= site_url('target/tambah'); ?>" class="btn btn-success mb-3">Tambah Target</a>
    <div class="row">
      <?php foreach ($targets as $target): ?>
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title"><?= $target->nama_kategori; ?></h5>
              <p class="card-text">Target: <?= $target->target_total; ?> kg</p>
              <p class="card-text">Total Terkumpul: <?= $target->total_terkumpul; ?> kg</p>
              <div class="progress mb-3">
                <div class="progress-bar" role="progressbar"
                  style="width: <?= $target->persentase; ?>%;"
                  aria-valuenow="<?= $target->persentase; ?>"
                  aria-valuemin="0" aria-valuemax="100">
                  <?= round($target->persentase); ?>%
                </div>
              </div>
              <a href="<?= site_url('target/detail/' . $target->id_target); ?>" class="btn btn-primary">Lihat Detail</a>
              <a href="<?= site_url('target/hapus/' . $target->id_target); ?>"
                class="btn btn-danger">Hapus</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <section class="footer text-white text-center" style="background-color: #416D19; padding: 1rem; position: absolute; bottom: 0; width: 100%;">
    <p>&copy; Sistem Pengelolaan dan Akses Sampah Yogyakarta (SPASY) - Universitas Amikom Yogyakarta</p>
  </section>
</body>