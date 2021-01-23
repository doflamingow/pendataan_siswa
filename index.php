<?php

session_start();

require_once 'config/config.php';
require_once 'function/functions.php';

if (isset($_SESSION['login'])) {
  
  // jika sudah pernah login, maka arahkan ke halaman utama admin
  header('Location: admin/index.php?anda_adalah_admin');
  exit();
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- meta -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- title -->
  <title>Halaman Utama</title>

  <!-- css -->
  <link rel="stylesheet" href="<?= url('assets/'); ?>css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.12.5/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
  
</head>
<body>

  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-5 m-auto">
        <div class="d-flex justify-content-center align-items-center flex-wrap flex-column">
          <img src="<?= url('assets/images/background/dashboard.png'); ?>" alt="" class="img-fluid mb-5">
        </div>
      </div>
      <div class="col-md-6 m-auto">
        <div class="justify-content-center align-items-center flex-column text-center" id="d-mobile">
          <div class="container">
            <h4>Selamat Datang</h4>
            <span class="d-block fs-default">selamat datang di aplikasi pendataan siswa, dimana aplikasi ini bertujuan untuk mengelola data para siswa</span>
            <a href="login.php" class="btn btn-primary shadow-sm mt-3">
              <small>Login</small>
              <small class="fas fa-fw fa-sign-in-alt ml-1"></small>
            </a>
          </div>
        </div>
        <div class="flex-column" id="d-desktop">
          <h3>Selamat Datang</h3>
          <span class="d-block">selamat datang di aplikasi pendataan siswa, dimana aplikasi ini bertujuan untuk mengelola data para siswa</span>
          <a href="login.php" class="btn btn-primary shadow-sm mt-3 w-25">
            <small>Login</small>
            <small class="fas fa-fw fa-sign-in-alt ml-1"></small>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- javascript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.12.5/sweetalert2.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= url('assets/'); ?>js/script.js"></script>

</body>
</html>
