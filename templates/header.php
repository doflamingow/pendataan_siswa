<?php

if (!isset($_SESSION['login'])) {
  
  // jika belum login, maka arahkan ke halaman login
  header('Location: ../login.php?login_dulu');
  exit();
  
}

// validasi
$judul = filter_var($data['judul'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$css = filter_var($data['css'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$id = filter_var($_SESSION['admin']['id'], FILTER_SANITIZE_NUMBER_INT);

$data = query("SELECT * FROM tb_admin WHERE id = '$id'")[0];

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- meta -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- title -->
  <title><?= $judul; ?></title>

  <!-- css -->
  <link rel="stylesheet" href="<?= url('assets/'); ?>css/style.css">
  <link rel="stylesheet" href="<?= url('assets/'); ?>css/<?= $css; ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.12.5/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

</head>
<body>
  
  <div class="container mt-3 mb-3" id="d-mobile">
    <nav class="navbar navbar-light bg-light shadow rounded p-3">
      <div class="d-flex justify-content-center align-items-center">
        <img src="<?= url('assets/images/admin/' . $data['gambar']); ?>" width="40" alt="" class="img-fluid rounded-circle ml-3">
      </div>
      <button class="navbar-toggler mr-3" id="outline-none" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav px-3 py-4">
          <a class="nav-item nav-link fs-default" href="<?= url('admin'); ?>">
            <i class="fas fa-fw fa-home mr-1"></i>
            <span>Beranda</span>
          </a>
          <a class="nav-item nav-link fs-default" href="<?= url('admin/siswa/data.php'); ?>">
            <i class="fas fa-fw fa-users mr-1"></i>
            <span>Data Siswa</span>
          </a>
          <a class="nav-item nav-link fs-default" href="<?= url('admin/profile/profile.php'); ?>">
            <i class="fas fa-fw fa-user mr-1"></i>
            <span>Profile</span>
          </a>
          <a class="nav-item nav-link fs-default" href="<?= url('admin/logout.php'); ?>">
            <i class="fas fa-fw fa-sign-out-alt mr-1"></i>
            <span>Logout</span>
          </a>
        </div>
      </div>
    </nav>
  </div>

  <nav class="navbar navbar-light bg-light p-3 shadow-sm" id="d-desktop">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center flex-wrap">
        <img src="<?= url('assets/images/admin/' . $data['gambar']); ?>" width="40" alt="" class="img-fluid rounded-circle mr-3 shadow-sm">
        <span><?= $data['nama']; ?></span>
      </div>
      <nav class="nav d-flex justify-content-center align-items-center">
        <a class="nav-link" href="<?= url('admin'); ?>">Beranda</a>
        <a class="nav-link" href="<?= url('admin/siswa/data.php'); ?>">Data Siswa</a>
        <a class="nav-link" href="<?= url('admin/profile/profile.php'); ?>">Profile</a>
        <a class="nav-link" href="<?= url('admin/logout.php'); ?>">Logout</a>
      </nav>
    </div>
  </nav>
