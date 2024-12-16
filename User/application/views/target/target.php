<body>
  <style>
    /* Gaya untuk tombol */
    .btn-primary {
      background-color: #4CAF50;
      border: none;
      font-weight: bold;
    }

    .btn-primary:hover {
      background-color: #45A049;
    }

    /* Modal body background styling */
    .modal-body {
      color: #fff;
      padding: 2rem;
    }

    /* Header styling */
    .modal-header h5 {
      font-weight: bold;
      color: #333;
      text-align: center;
      font-size: 1.25rem;
    }
  </style>

  <div id="targetBody" class="container mt-5">
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
              <a href="<?= site_url('target/hapus/' . $target->id_target); ?>" class="btn btn-danger">Hapus</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title text-center" id="subscriptionModalLabel">
            Halaman ini hanya tersedia untuk pengguna berlangganan. Pilih salah satu paket langganan untuk melanjutkan akses:
          </h5>
        </div>

        <!-- Modal Body -->
        <div class="modal-body p-0" style="background-image: url('<?php echo $this->config->item("assets_url") . "modal-bg.jpg"; ?>'); background-size: cover; background-position: center;">
          <div class="container-fluid py-4">
            <div class="row justify-content-center g-4">
              <!-- Paket Bulanan -->
              <div class="col-md-4">
                <div class="card border-0 shadow-lg text-center h-100">
                  <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title fw-bold">Berlangganan 1 Bulan</h5>
                    <p class="mb-3">Benefit:</p>
                    <ul class="list-unstyled">
                      <li>Akses Fitur Target</li>
                      <li>Akses Fitur Riwayat Aktivitas Anda</li>
                    </ul>
                    <a href="<?php echo site_url('Subs/pay_subscription/1bulan') ?>" class="btn btn-primary mt-auto">Rp 35.000</a>
                  </div>
                </div>
              </div>

              <!-- Paket 6 Bulan -->
              <div class="col-md-4">
                <div class="card border-0 shadow-lg text-center h-100">
                  <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title fw-bold">Berlangganan 6 Bulan</h5>
                    <p class="mb-3">Benefit:</p>
                    <ul class="list-unstyled">
                      <li>Akses Fitur Target</li>
                      <li>Akses Fitur Riwayat Aktivitas Anda</li>
                      <li>Diskon Sebesar 5%</li>
                    </ul>
                    <a href="<?php echo site_url('Subs/pay_subscription/6bulan') ?>" class="btn btn-primary mt-auto">Rp 199.000</a>
                  </div>
                </div>
              </div>

              <!-- Paket 1 Tahun -->
              <div class="col-md-4">
                <div class="card border-0 shadow-lg text-center h-100">
                  <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title fw-bold">Berlangganan 1 Tahun</h5>
                    <p class="mb-3">Benefit:</p>
                    <ul class="list-unstyled">
                      <li>Akses Fitur Target</li>
                      <li>Akses Fitur Riwayat Aktivitas Anda</li>
                      <li>Diskon Sebesar 10%</li>
                    </ul>
                    <a href="<?php echo site_url('Subs/pay_subscription/1tahun') ?>" class="btn btn-primary mt-auto">Rp 378.000</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <a href="Home" class="btn btn-secondary">Kembali ke Dashboard Anda</a>
        </div>
      </div>
    </div>
  </div>

  <section id="targetFooter" class="footer text-white text-center" style="background-color: #416D19; padding: 1rem; position: absolute; bottom: 0; width: 100%;">
    <p>&copy; Sistem Pengelolaan dan Akses Sampah Yogyakarta (SPASY) - Universitas Amikom Yogyakarta</p>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      <?php if ($this->session->userdata('status_pengguna') !== 'Active') : ?>
        var target = document.getElementById('targetBody');
        var footer = document.querySelector('.footer');
        var nav = document.getElementById('navBar');
        var subscriptionModal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
        subscriptionModal.show();

        // Blurring content behind the modal
        target.style.filter = 'blur(8px)';
        footer.style.filter = 'blur(8px)';
        if (nav) {
          nav.style.filter = 'blur(8px)';
        }
      <?php endif; ?>
    });
  </script>
</body>