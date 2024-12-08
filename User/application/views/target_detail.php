<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Target Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-header {
      background-color: #4CAF50;
      color: white;
    }

    .progress-circle span {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 1rem;
      font-weight: bold;
    }

    .btn-circle {
      border-radius: 50%;
    }
  </style>
</head>

<body class="mt-5">
  <div class="container mt-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span class="fw-bold">Limbah Plastik</span>
        <div>
          <button class="btn btn-sm btn-light me-2">Edit</button>
          <a href="<?= site_url('target/hapus/' . $target[0]->id_target) ?>" class="btn btn-sm btn-danger">Hapus</a>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <p class="mb-1 text-muted">Target</p>
            <h5 class="mb-0"><?= $target_total; ?> kg</h5>
          </div>
          <div>
            <p class="mb-1 text-muted">Total</p>
            <h5 class="mb-0"><?= $total_terkumpul; ?> kg</h5>
          </div>
          <div class="progress-circle" style="position: relative; width: 80px; height: 80px; border-radius: 50%; background: conic-gradient(#4CAF50 <?php $progress ?? 0; ?>%, #ddd <?php $progress ?? 0; ?>%);">
            <span><?= round(($total_terkumpul / $target_total) * 100, 2); ?>%</span>
          </div>
        </div>
      </div>
      <a href="<?= site_url('garbage/add_sampah_from_target/'.$target[0]->id_target) ?>" class="btn btn-sm btn-info">Tambah Sampah</a>
    </div>

    <div class="card mt-4">
      <div class="card-header">
        Riwayat Aktivitas Sampah
      </div>
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <?php if (!empty($logs)): ?>
            <?php foreach ($logs as $log): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= date('d-m-Y', strtotime($log->timestamps)); ?>
                <span><?= $log->aktivitas; ?></span>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="list-group-item text-center">Belum ada aktivitas.</li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>