<?php

session_start();

require_once '../../config/config.php';
require_once '../../function/functions.php';

if (!isset($_SESSION['login'])) {
  
  // jika belum login, maka arahkan ke halaman login
  header('Location: ../../login.php?login_dulu');
  exit();
  
}

// tangkap id yang berada di url
$id = trim(strip_tags(mysqli_real_escape_string($conn, $_SESSION['admin']['id'])));

$data['css'] = null;
$data['judul'] = 'Halaman Profile Admin';
$data['admin'] = query("SELECT * FROM tb_admin WHERE id = '$id'")[0];

view('../../templates/header', $data);

?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-md-6 m-auto">
      <?php if (flashdata('profile_berhasil')) : ?>
      <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <h4 class="alert-heading">Berhasil</h4>
        <span>Profile <strong><?= flashdata('profile_berhasil'); ?></strong></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset_flashdata('profile_berhasil'); ?>
      <?php endif; ?>
      <!-- pemisah -->
      <?php if (flashdata('profile_gagal')) : ?>
      <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <h4 class="alert-heading">Gagal</h4>
        <span>Profile <strong><?= flashdata('profile_gagal'); ?></strong></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset_flashdata('profile_gagal'); ?>
      <?php endif; ?>
      <div class="justify-content-center align-items-center text-center flex-column" id="d-mobile">
        <img src="<?= url('assets/images/admin/' . $data['admin']['gambar']); ?>" width="140" alt="" class="img-fluid rounded-circle mt-5 mb-3 shadow-sm">
        <span class="d-block"><strong><?= $data['admin']['nama']; ?></strong></span>
        <small class="d-block"><?= $data['admin']['email']; ?></small>
        <a href="ubah_profile.php?id=<?= $id; ?>" class="btn btn-primary shadow-sm mt-3">
          <small class="fas fa-fw fa-edit mr-1"></small>
          <small>Edit Profile</small>
        </a>
      </div>
      <div class="justify-content-center align-items-center flex-column text-center" id="d-desktop">
        <img src="<?= url('assets/images/admin/' . $data['admin']['gambar']); ?>" width="150" alt="" class="img-fluid rounded-circle shadow-sm mb-4">
        <a href="ubah_profile.php?id=<?= $id; ?>" class="btn btn-primary shadow-sm">
          <small class="fas fa-fw fa-edit mr-1"></small>
          <small>Edit Profile</small>
        </a>
      </div>
    </div>
    <div class="col-md-6 m-auto">
      <div class="flex-wrap flex-column" id="d-desktop">
        <ul class="list-group shadow-sm rounded mb-3">
          <li class="list-group-item bg-light"><strong>Nama Lengkap</strong></li>
          <li class="list-group-item"><?= $data['admin']['nama']; ?></li>
        </ul>
        <ul class="list-group shadow-sm rounded">
          <li class="list-group-item bg-light"><strong>Email</strong></li>
          <li class="list-group-item"><?= $data['admin']['email']; ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php

$data['javascript'] = null;

view('../../templates/footer', $data);

?>
