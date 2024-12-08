<body>
  <div class="container mt-5">
    <div class="card mx-auto" style="max-width: 50rem;">
      <div class="card-body">
        <h1>Tambah Target</h1>
        <form action="<?= site_url('target/tambah'); ?>" method="post">
          <div class="mb-3">
            <label for="id_kategori" class="form-label">Kategori Sampah</label>
            <select class="form-control" id="id_kategori" name="id_kategori" required>
              <option disabled>Pilih Kategori</option>
              <?php foreach ($kategori as $item): ?>
                <option value="<?= $item['id_kategori'] ?>"><?php echo $item['nama_kategori'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="target_total" class="form-label">Target (kg)</label>
            <input type="number" step="0.1" min="0" class="form-control" id="target_total" name="target_total" placeholder="Berat target sampah dalam satuan Kilogram" required>
          </div>
          <div class="mb-3">
            <label for="tanggal_target" class="form-label">Tanggal Target</label>
            <input type="datetime-local" class="form-control" id="tanggal_target" name="tanggal_target" required>
          </div>
          <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>

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

      const datetimeInput = document.getElementById('tanggal_target');
      if (datetimeInput) {
        datetimeInput.value = currentDateTime; // Set nilai default
      }
    });
  </script>
</body>