<?php

session_start();

require_once '../config/config.php';
require_once '../function/functions.php';

if (!isset($_SESSION['login'])) {
  
  // jika belum login, maka arahkan ke halaman login
  header('Location: ../login.php?login_dulu');
  exit();
  
}

// tangkap id yang berada di url
$id = trim(strip_tags(mysqli_real_escape_string($conn, $_SESSION['admin']['id'])));

$data['css'] = null;
$data['judul'] = 'Halaman Utama Admin';
$data['admin'] = query("SELECT nama FROM tb_admin WHERE id = '$id'")[0];

view('../templates/header', $data);

?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md-5 m-auto">
      <div class="d-flex justify-content-center align-items-center flex-column">
        <img src="<?= url('assets/images/background/dashboard.png'); ?>" alt="" class="img-fluid mb-5">
      </div>
    </div>
    <div class="col-md-7 m-auto">
      <div class="justify-content-center align-items-center flex-column text-center" id="d-mobile">
        <div class="container">
          <h4>Halo, <strong class="text-primary"><?= $data['admin']['nama']; ?></strong></h4>
          <span class="d-block fs-default mb-5">selamat datang di halaman utama admin, dimana anda bisa mengelola semua data siswa sesuka hati anda</span>
        </div>
      </div>
      <div class="flex-column" id="d-desktop">
        <h3>Halo, <strong class="text-primary"><?= $data['admin']['nama']; ?></strong></h3>
        <span class="d-block">selamat datang di halaman utama admin, dimana anda bisa mengelola semua data siswa sesuka hati anda</span>
        <a href="siswa/data.php" class="btn btn-primary shadow-sm mt-3 w-50">
          <small class="fas fa-fw fa-database mr-1"></small>
          <small>Kelola Data</small>
        </a>
      </div>
    </div>
  </div>
</div>

<?php

$data['javascript'] = null;

view('../templates/footer', $data);

?>
