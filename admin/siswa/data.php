<?php

session_start();

require_once '../../config/config.php';
require_once '../../function/functions.php';

if (!isset($_SESSION['login'])) {
  
  // jika belum login, maka arahkan ke halaman login
  header('Location: ../../login.php?login_dulu');
  exit();
  
}

$data['css'] = null;
$data['judul'] = 'Halaman Data Siswa';
$data['siswa'] = query("SELECT * FROM tb_siswa ORDER BY id DESC");

view('../../templates/header', $data);

?>

<div class="container mt-4 mb-4">
  <div class="row">
    <div class="col-md-6">
      <?php if (flashdata('siswa_berhasil')) : ?>
      <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <h4 class="alert-heading">Berhasil</h4>
        <span class="d-block">Data Siswa <strong><?= flashdata('siswa_berhasil'); ?></strong></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset_flashdata('siswa_berhasil'); ?>
      <?php endif; ?>
      <!-- pemisah -->
      <?php if (flashdata('siswa_gagal')) : ?>
      <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <h4 class="alert-heading">Gagal</h4>
        <span class="d-block">Data Siswa <strong><?= flashdata('siswa_gagal'); ?></strong></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset_flashdata('siswa_gagal'); ?>
      <?php endif; ?>
      <a href="tambah.php" class="btn btn-primary shadow-sm mb-3">
        <small class="fas fa-fw fa-plus mr-1"></small>
        <small>Tambah Siswa</small>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-striped shadow-sm rounded" id="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>Umur</th>
              <th>Alamat</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kelamin</th>
              <th>Kelas</th>
              <th>Jurusan</th>
              <th>Spp</th>
              <th>Keterangan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data['siswa'] as $siswa) : ?>
            <tr>
              <td><small><?= $no++; ?></small></td>
              <td><small><?= $siswa['nama']; ?></small></td>
              <td><small><?= age($siswa['tanggal_lahir']); ?></small></td>
              <td><small><?= $siswa['alamat']; ?></small></td>
              <td><small><?= $siswa['tanggal_lahir']; ?></small></td>
              <td><small><?= $siswa['jenis_kelamin']; ?></small></td>
              <td><small><?= $siswa['kelas']; ?></small></td>
              <td><small><?= $siswa['jurusan']; ?></small></td>
              <td><small><?= $siswa['spp']; ?></small></td>
              <td><small><?= spp($siswa['spp']); ?></small></td>
              <td class="d-flex justify-content-center align-items-center">
                <a href="ubah.php?id=<?= $siswa['id']; ?>" class="badge badge-success p-2 shadow-sm mr-1">
                  <small class="fas fa-fw fa-edit mr-1"></small>
                  <small>Ubah</small>
                </a>
                <a href="" class="badge badge-danger p-2 shadow-sm badge-delete" data-target="hapus.php?id=<?= $siswa['id']; ?>">
                  <small class="fas fa-fw fa-trash-alt mr-1"></small>
                  <small>Hapus</small>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php

$data['javascript'] = 'table.js';

view('../../templates/footer', $data);

?>
