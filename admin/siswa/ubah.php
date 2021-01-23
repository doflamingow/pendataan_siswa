<?php

session_start();

require_once '../../config/config.php';
require_once '../../function/functions.php';

if (!isset($_SESSION['login'])) {
  
  // jika belum login, maka arahkan ke halaman login
  header('Location: ../../login.php?login_dulu');
  exit();
  
}

// ambil id yang berada di url 
$id = trim(strip_tags(mysqli_real_escape_string($conn, $_GET['id'])));

$data['css'] = null;
$data['judul'] = 'Halaman Ubah Data Siswa';
$data['jenis_kelamin'] = lists(gender);
$data['kelas'] = lists(kelas);
$data['jurusan'] = lists(jurusan);
$data['siswa'] = query("SELECT * FROM tb_siswa WHERE id = '$id'")[0];

view('../../templates/header', $data);

if (isset($_POST['submit'])) {
  if (ubahSiswa($_POST, $id) > 0) {
    
    // jika berhasil mengubah data siswa
    set_flashdata('siswa_berhasil', 'berhasil diubah');
    
    header('Location: data.php?berhasil');
    exit();
    
  } else {
    
    // jika gagal mengubah data siswa
    set_flashdata('siswa_gagal', 'gagal diubah');
    
    header('Location: data.php?gagal');
    exit();
    
  }
}

?>

<div class="container mt-4 mb-4">
  <div class="row">
    <div class="col-md-5">
      <div class="justify-content-center align-items-center flex-column" id="d-desktop">
        <div class="alert alert-primary alert-dismissible fade show shadow-sm mb-5" role="alert">
          <span>isi semua field dengan benar</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <img src="<?= url('assets/images/background/blog_post.png'); ?>" alt="images" class="img-fluid">
      </div>
    </div>
    <div class="col-md-6 m-auto">
      <div class="card shadow-sm rounded">
        <div class="card-header">
          <small class="fab fa-fw fa-wpforms mr-1"></small>
          <small>Form Ubah Data Siswa</small>
        </div>
        <div class="card-body">
          <?php if (flashdata('form_siswa')) : ?>
          <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <span class="d-block"><?= flashdata('form_siswa'); ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset_flashdata('form_siswa'); ?>
          <?php endif; ?>
          <form action="" method="post">
            <div class="form-group">
              <label for="nama"><small>Nama Lengkap</small></label>
              <input type="text" name="nama" class="form-control" id="nama" placeholder="nama lengkap" autocomplete="off" value="<?= $data['siswa']['nama']; ?>">
            </div>
            <div class="form-group">
              <label for="alamat"><small>Alamat</small></label>
              <input type="text" name="alamat" class="form-control" id="alamat" placeholder="alamat" autocomplete="off" value="<?= $data['siswa']['alamat']; ?>">
            </div>
            <div class="form-group">
              <label for="tanggal_lahir"><small>Tanggal Lahir</small></label>
              <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" placeholder="dd/mm/yy" autocomplete="off" value="<?= $data['siswa']['tanggal_lahir']; ?>">
            </div>
            <div class="form-group">
              <label for="jenis_kelamin"><small>Jenis Kelamin</small></label>
              <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                <?php foreach ($data['jenis_kelamin'] as $jenisKelamin) : ?>
                <?php if ($jenisKelamin === $data['siswa']['jenis_kelamin']) : ?>
                <option value="<?= $jenisKelamin; ?>" selected><?= $jenisKelamin; ?></option>
                <?php else : ?>
                <option value="<?= $jenisKelamin; ?>"><?= $jenisKelamin; ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="kelas"><small>Kelas</small></label>
              <select name="kelas" id="kelas" class="form-control">
                <?php foreach ($data['kelas'] as $kelas) : ?>
                <?php if ($kelas === $data['siswa']['kelas']) : ?>
                <option value="<?= $kelas; ?>" selected><?= $kelas; ?></option>
                <?php else : ?>
                <option value="<?= $kelas; ?>"><?= $kelas; ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="jurusan"><small>Jurusan</small></label>
              <select name="jurusan" id="jurusan" class="form-control">
                <?php foreach ($data['jurusan'] as $jurusan) : ?>
                <?php if ($jurusan === $data['siswa']['jurusan']) : ?>
                <option value="<?= $jurusan; ?>" selected><?= $jurusan; ?></option>
                <?php else : ?>
                <option value="<?= $jurusan; ?>"><?= $jurusan; ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="spp"><small>Spp</small></label>
              <input type="text" name="spp" class="form-control" id="spp" placeholder="nominal spp" autocomplete="off" value="<?= $data['siswa']['spp']; ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary shadow-sm float-right">
              <small class="fas fa-fw fa-edit mr-1"></small>
              <small>Ubah Siswa</small>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

$data['javascript'] = null;

view('../../templates/footer', $data);

?>