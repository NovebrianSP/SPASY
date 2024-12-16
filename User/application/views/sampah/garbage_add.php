<body>
  <div class="container mt-5">
    <h3 class="text-center mb-4">Tambah Catatan Pemasukan Sampah Anda</h3>
    <div class="card mx-auto" style="max-width: 50rem;">
      <div class="card-body">
        <form action="<?= site_url('Garbage/store_sampah') ?>" method="post">
          <div class="mb-3">
            <input hidden class="form-control" type="text" name="id_kategori" id="id_kategori" value="<?= $target->id_kategori; ?>">
          </div>

          <input type="hidden" name="id_target" value="<?= $id_target; ?>">

          <div class="mb-3">
            <label for="jumlahBerat" class="form-label">Jumlah Berat</label>
            <div class="input-group">
              <input type="number" class="form-control" id="jumlahBerat" name="jumlah_berat" step="0.01" min="0" required>
              <span class="input-group-text">kg</span>
            </div>
          </div>

          <div class="mb-3">
            <label for="datetime" class="form-label">Tanggal Masuk</label>
            <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
          </div>

          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <section class="footer text-white text-center" style="background-color: #416D19; padding: 1rem; position: fixed; bottom: 0; width: 100%;">
    <p>&copy; Sistem Pengelolaan dan Akses Sampah Yogyakarta (SPASY) - Universitas Amikom Yogyakarta</p>
  </section>

  <script>
    // Mengatur nilai default input datetime-local ke waktu sekarang
    document.addEventListener('DOMContentLoaded', function() {
      const now = new Date();
      const year = now.getFullYear();
      const month = String(now.getMonth() + 1).padStart(2, '0'); // Bulan mulai dari 0
      const day = String(now.getDate()).padStart(2, '0');
      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');

      // Format: YYYY-MM-DDTHH:mm (format yang diharapkan oleh datetime-local)
      const currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

      const datetimeInput = document.getElementById('datetime');
      if (datetimeInput) {
        datetimeInput.value = currentDateTime; // Set nilai default
      }
    });
  </script>
</body>