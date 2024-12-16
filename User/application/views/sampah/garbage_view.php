<body>
  <div class="container mt-5">
    <h3 class="text-center mb-4">Tambah Catatan Pemasukan Sampah Anda</h3>
    <div class="card mx-auto" style="max-width: 50rem;">
      <div class="card-body">
        <form method="post">
          <div class="mb-3">
            <label for="jenisSampah" class="form-label">Jenis Sampah</label>
            <select name="jenis_sampah" id="jenisSampah" class="form-select" required>
              <option value="" selected disabled>Pilih Jenis Sampah</option>
              <?php foreach ($kategori as $item): ?>
                <option value="<?= $item['id_kategori'] ?>"><?php echo $item['nama_kategori'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

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