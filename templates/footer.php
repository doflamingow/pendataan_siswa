<?php

if (!isset($_SESSION['login'])) {
  
  // jika belum login, maka arahkan ke halaman login
  header('Location: ../login.php?login_dulu');
  exit();
  
}

// validasi
$javascript = filter_var($data['javascript'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$author = filter_var(author, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$year = date('Y');

?>

  <!-- footer -->
  <footer>
    <div class="container mt-5 mb-5">
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
  <script src="<?= url('assets/'); ?>js/<?= $javascript; ?>"></script>
  <script src="<?= url('assets/'); ?>js/script.js"></script>

</body>
</html>
