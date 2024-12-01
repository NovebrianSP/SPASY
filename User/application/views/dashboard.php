<body>
  <div class="container mt-5">
    <h1 class="text-center mb-4">Grafik Sampah</h1>
    <div class="row">
      <div class="col-md-6">
        <div id="grafik-organik"></div>
      </div>
      <div class="col-md-6">
        <div id="grafik-anorganik"></div>
      </div>
    </div>
  </div>


  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>

  <div id="container-organik" style="width: 48%; display: inline-block;"></div>
  <div id="container-anorganik" style="width: 48%; display: inline-block;"></div>

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
            format: '<b>{point.name}</b>: {point.y}%' // Format label
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
            format: '<b>{point.name}</b>: {point.y}%' // Format label
          }
        }
      },
      series: [{
        name: 'Anorganik',
        data: dataAnorganik
      }]
    });
  </script>
</body>