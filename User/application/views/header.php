<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <title>SPASY</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

    nav {
      background-color: #9BCF53;
    }

    body {
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
      padding-top: 50px;
    }

    a {
      color: black;
    }

    a:hover {
      color: #F5F5F5;
    }

    
    footer {
      background-color: #9BCF53;
      width: 100%;
      position: absolute;
      bottom: 0;
    }

    .nav-link.active {
      color: white !important;
      background-color: #416D19 !important;
      padding: 8px 15px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      height: 100%;
    }

    .dropdown-toggle::after {
      display: none;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">

      <!-- Toggle button for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <!-- Menu Home -->
          <li class="nav-item">
            <a class="nav-link <?= (current_url() == site_url('Home') || current_url() == site_url()) ? 'active' : ''; ?>"
              href="<?= site_url('Home'); ?>">Home</a>
          </li>

          <!-- Menu Target Saya -->
          <li class="nav-item">
            <a class="nav-link <?= (current_url() == site_url('Target')) ? 'active' : ''; ?>"
              href="<?= site_url('Target'); ?>">Target Saya</a>
          </li>

          <!-- Menu Sampah Saya -->
          <li class="nav-item">
            <a class="nav-link <?= (current_url() == site_url('Garbage')) ? 'active' : ''; ?>"
              href="<?= site_url('Garbage'); ?>">Sampah Saya</a>
          </li>
        </ul>

        <!-- User Dropdown -->
        <div class="dropdown">
          <button class="btn dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" border: none;">
            <span class="ms-2 text-dark"><?php echo $this->session->userdata('nama'); ?></span>
            <img src="<?php echo $this->config->item('assets_url') ?>person-svgrepo-com.svg" alt="User Image" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="<?= site_url('account'); ?>">Akun</a></li>
            <li><a class="dropdown-item" href="<?= site_url('logout'); ?>">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pcAh3vWZ9bK9DrNy7k8nV4Rk9Ql8UtNLT7lzptGGIjVAN+fABFF3r1a3RT78NBqR" crossorigin="anonymous"></script>
</body>

</html>