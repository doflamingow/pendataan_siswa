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
$id = trim(strip_tags(mysqli_real_escape_string($conn, $_GET['id'])));

$data['css'] = null;
$data['judul'] = 'Halaman Ubah Profile Admin';
$data['admin'] = query("SELECT * FROM tb_admin WHERE id = '$id'")[0];

$emailLama = $data['admin']['email'];
$gambarLama = $data['admin']['gambar'];

view('../../templates/header', $data);

if (isset($_POST['submit'])) {
  if (ubahProfile($_POST, $id, $emailLama, $gambarLama) > 0) {

    // jika berhasil mengubah profile
    set_flashdata('profile_berhasil', 'berhasil diubah');

    header('Location: profile.php?berhasil');
    exit();

  } else {

    // jika gagal mengubah profile
    set_flashdata('profile_gagal', 'gagal diubah');

    header('Location: profile.php?gagal');
    exit();

  }
}

?>

<div class="container mt-4 mb-4">
  <div class="row">
    <div class="col-md-5">
      <div class="justify-content-center align-items-center flex-column" id="d-desktop">
        <div class="alert alert-primary alert-dismissible fade show shadow-sm mb-5" role="alert">
          <span class="d-block">isi semua input dengan benar</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <img src="<?= url('assets/images/background/blog_post.png'); ?>" alt="" class="img-fluid">
      </div>
    </div>
    <div class="col-md-6 m-auto">
      <div class="card shadow-sm rounded">
        <div class="card-header">
          <small class="fab fa-fw fa-wpforms mr-1"></small>
          <small>Form Ubah Profile</small>
        </div>
        <div class="card-body">
          <?php if (flashdata('form_profile')) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="d-block"><?= flashdata('form_profile'); ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset_flashdata('form_profile'); ?>
          <?php endif; ?>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nama"><small>Nama Lengkap</small></label>
              <input type="text" name="nama" class="form-control" id="nama" placeholder="nama lengkap" autocomplete="off" value="<?= $data['admin']['nama']; ?>">
            </div>
            <div class="form-group">
              <label for="email"><small>Email</small></label>
              <input type="text" name="email" class="form-control" id="email" placeholder="example@example.com" autocomplete="off" value="<?= $data['admin']['email']; ?>">
            </div>
            <div class="form-group">
              <label for="password"><small>Password</small></label>
              <div class="input-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="password" autocomplete="off" value="<?= $data['admin']['password']; ?>">
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2">
                    <span class="icon-box">
                      <i class="fas fa-fw fa-eye" id="eye"></i>
                      <i class="fas fa-fw fa-eye-slash d-none" id="eye-slash"></i>
                    </span>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="d-flex justify-content-center align-items-center flex-column">
                <img src="<?= url('assets/images/admin/' . $data['admin']['gambar']); ?>" width="150" alt="" class="img-fluid mt-3 mb-3">
              </div>
              <label for="gambar"><small>Gambar</small></label>
              <div class="custom-file">
                <input type="file" name="gambar" class="custom-file-input" id="gambar">
                <label class="custom-file-label" for="gambar">pilih file</label>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary shadow-sm float-right">
              <small class="fas fa-fw fa-edit mr-1"></small>
              <small>Ubah Profile</small>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

$data['javascript'] = 'hide.js';

view('../../templates/footer', $data);

?>
