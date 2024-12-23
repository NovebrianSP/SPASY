<body class="container mt-5">
  <style>
    .fixed-bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      z-index: 1030;
      /* Pastikan berada di atas elemen lain */
      background-color: #f8f9fa;
      /* Sesuaikan warna latar belakang */
      border-top: 1px solid #dee2e6;
      /* Opsional: Tambahkan garis di atas */
    }
  </style>

  <div id="targetBody" class="container mt-5">
    <table class="table table-bordered">
      <tr>
        <th>#</th>
        <th>Aktivitas Anda</th>
        <th>Tanggal Aktivitas</th>
      </tr>

      <?php
      $index = ($current_page - 1) * $limit + 1; // Gunakan $limit untuk perhitungan
      foreach ($logs as $v):
      ?>
        <tr>
          <td><?php echo $index++; ?></td>
          <td><?php echo htmlspecialchars($v['aktivitas']); ?></td>
          <td><?php echo htmlspecialchars($v['timestamps']); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation" class="fixed-bottom-nav">
      <ul class="pagination justify-content-center">
        <?php if ($current_page > 1): ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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