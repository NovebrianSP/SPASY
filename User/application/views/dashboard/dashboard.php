<body>
  <style>
    .image-wrapper {
      display: flex;
      justify-content: flex-start;
    }

    .shifted-image {
      position: relative;
      left: -14rem;
    }

    .grafikSampah {
      background-color: #F5F5F5;
      padding: 2rem;
      width: 100%;
    }

    .pendapatanSampah {
      background-color: #9BCF53;
      padding: 2rem;
      margin-bottom: 5rem;
      margin-top: 2rem;
    }
  </style>


  <section class="jumbotron" id="jumbotron">
    <div class="container">
      <div class="image-wrapper">
        <img src="<?= $this->config->item('assets_url'); ?>Landing1.png" class="shifted-image">
      </div>
    </div>
  </section>

  <section class="grafikSampah" id="grafik">
    <h1 class="text-center mb-4">Grafik Sampah</h1>
    <div class="row">
      <div class="col-6">
        <div id="grafik-organik"></div>
      </div>
      <div class="col-6">
        <div id="grafik-anorganik"></div>
      </div>
    </div>
  </section>

  <section class="pendapatanSampah" id="pendapatan">
    <h3 class="text-center mb-4 display-2"><strong>TOTAL PENDAPATAN SAMPAH</strong></h3>
    <div class="row text-center">
      <P class="display-5">Pendapatan Sampah diperoleh dari jumlah hitungan kilogram limbah sampah rumah tangga maupun industri yang telah ditampung oleh pengepul</P>
      <p class="h5"><strong>Data di bawah ini merupakan hasil dari pengimpitan yang dilakukan oleh pengepul pada tahun 2024</strong></p>
      <?php
      foreach ($totalSampah as $value):
      ?>
        <div class="col-md-3 mb-3">
          <div class="card p-3 bg-success text-white">
            <p><?php echo $value['nama_kategori']; ?></p>
            <h5>Total: <?php echo number_format($value['total'], 2) ?> Kg</h5>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </section>

  <section class="info" style="background-color: #9BCF53; padding: 2rem;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <img src="<?= $this->config->item('assets_url'); ?>spasy.png" alt="Logo SPASY" class="img-fluid">
        </div>
        <div class="col-md-8">
          <h2 class="display-3"><strong>Sistem Pengelolaan dan Akses Sampah Yogyakarta (SPASY)</strong></h2>
          <p>Kami membuat proyek ini untuk membantu para pengepul dalam mengelola sampah yang mereka kumpulkan agar lebih efisien, itu adalah langkah penting dalam mendukung pengelolaan sampah berkelanjutan. Dengan adanya website ini, pengepul bisa lebih terorganisir dan produktif dalam memilah sampah.</p>
        </div>
      </div>

      <div class="row mt-4" style="display: flex; align-items: center;">
        <span class="col-md-4 text-end display-6">
          <i class="bi bi-whatsapp"></i>
        </span>
        <h4 class="col-md-8">
          <a href="tel:+6289537373838">0895-3737-3838</a><br>
        </h4>
      </div>

      <div class="row mt-2" style="display: flex; align-items: center;">
        <span class="col-md-4 text-end display-6">
          <i class="bi bi-envelope"></i>
        </span>

        <h4 class="col-md-8">
          <a href="mailto:spasy@gmail.com" style="vertical-align: middle;">spasy@gmail.com</a>
        </h4>
      </div>
    </div>
  </section>

  <section class="footer text-white text-center" style="background-color: #416D19; padding: 1rem;">
    <p>&copy; Sistem Pengelolaan dan Akses Sampah Yogyakarta (SPASY) - Universitas Amikom Yogyakarta</p>
  </section>

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>

  <script>
    // Data Organik dari PHP
    const dataOrganik = <?= json_encode(array_map(function ($row) {
                          $colors = [
                            'Minyak' => '#FF0000',      // Merah
                            'Sisa Makanan' => '#FFFF00', // Kuning
                            'Kayu' => '#008000',       // Hijau
                            'Kertas' => '#0000FF'      // Biru
                          ];
                          return [
                            'name' => $row['nama_kategori'],
                            'y' => (float)$row['total'],
                            'color' => $colors[$row['nama_kategori']] ?? '#CCCCCC' // Default: Abu-abu
                          ];
                        }, $organik)); ?>;

    // Data Anorganik dari PHP
    const dataAnorganik = <?= json_encode(array_map(function ($row) {
                            $colors = [
                              'Plastik' => '#FF0000',    // Merah
                              'Besi' => '#FFFF00',       // Kuning
                              'Kaca' => '#0000FF'        // Biru
                            ];
                            return [
                              'name' => $row['nama_kategori'],
                              'y' => (float)$row['total'],
                              'color' => $colors[$row['nama_kategori']] ?? '#CCCCCC' // Default: Abu-abu
                            ];
                          }, $anorganik)); ?>;

    // Grafik Organik
    Highcharts.chart('grafik-organik', {
      chart: {
        type: 'pie'
      },
      title: {
        text: 'Organik'
      },
      plotOptions: {
        pie: {
          innerSize: '50%',
          dataLabels: {
            enabled: true,
            style: {
              color: 'black', // Warna teks label
              fontWeight: 'bold'
            },
            format: '<b>{point.name}</b>: {point.y:,.2f}kg' // Format label
          }
        }
      },
      series: [{
        name: 'Organik',
        data: dataOrganik
      }]
    });

    // Grafik Anorganik
    Highcharts.chart('grafik-anorganik', {
      chart: {
        type: 'pie'
      },
      title: {
        text: 'Anorganik'
      },
      plotOptions: {
        pie: {
          innerSize: '50%',
          dataLabels: {
            enabled: true,
            style: {
              color: 'black', // Warna teks label
              fontWeight: 'bold'
            },
            format: '<b>{point.name}</b>: {point.y:,.2f}kg' // Format label
          }
        }
      },
      series: [{
        name: 'Anorganik',
        data: dataAnorganik
      }]
    });
  </script>

  <script>
    const sections = document.querySelectorAll('section[id]');
    const nav = document.querySelector('nav');
    const dropdown = document.querySelector('.dropdown');

    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(section => {
        const sectionTop = section.offsetTop - 50; // Sesuaikan offset sesuai kebutuhan
        if (scrollY >= sectionTop) {
          current = section.getAttribute('id');
        }
      });

      nav.className = 'navbar navbar-expand-lg fixed-top ' + current;

      if (current === 'jumbotron') {
        nav.style.backgroundColor = '#9BCF53';
      } else if (current === 'grafik') {
        nav.style.backgroundColor = '#9BCF53';
      } else {
        nav.style.backgroundColor = 'transparent';
        dropdown.style.backgroundColor = 'transparent';
      }
    });
  </script>
</body>