<?php

session_start();

require_once 'config/config.php';
require_once 'function/functions.php';

if (isset($_SESSION['login'])) {
  
  // jika sudah pernah login, maka arahkan ke halaman utama admin
  header('Location: admin/index.php?anda_adalah_admin');
  exit();
  
}

$author = filter_var(author, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$year = date('Y');

if (isset($_POST['submit'])) login($_POST);

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- meta -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- title -->
  <title>Halaman Login</title>

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
        <div class="justify-content-center align-items-center flex-column" id="d-desktop">
          <img src="<?= url('assets/images/background/dashboard.png'); ?>" alt="" class="img-fluid">
        </div>
      </div>
      <div class="col-md-6 m-auto">
        <div class="container">
          <?php if (flashdata('form_login')) : ?>
          <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <span class="d-block"><?= flashdata('form_login'); ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset_flashdata('form_login'); ?>
          <?php endif; ?>
          <div class="d-flex justify-content-center align-items-center flex-column">
            <h4 class="mt-5 mb-5" id="d-mobile">Login</h4>
            <h4 class="mb-5" id="d-desktop">Halaman Login</h4>
          </div>
          <form action="" method="post">
            <div class="form-group">
              <input type="text" name="email" class="form-control p-4" placeholder="email address" autocomplete="off" value="<?= $_SESSION['value']['email']; ?>">
            </div>
            <div class="form-group">
              <div class="input-group mb-3">
                <input type="password" name="password" class="form-control p-4" id="password" placeholder="password" autocomplete="off">
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
            <button type="submit" name="submit" class="btn btn-primary btn-block shadow-sm p-3">
              <span>Login</span>
              <i class="fas fa-fw fa-sign-in-alt ml-1"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container mt-5">
      <div class="row">
        <div class="col">
          <span class="d-block text-center">© <?= $author; ?> - <?= $year; ?></span>
        </div>
      </div>
    </div>
  </footer>

  <!-- javascript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.12.5/sweetalert2.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= url('assets/'); ?>js/hide.js"></script>
  <script src="<?= url('assets/'); ?>js/script.js"></script>

</body>
</html>
