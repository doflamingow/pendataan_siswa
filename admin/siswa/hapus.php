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

if (hapus('tb_siswa', 'id', $id) > 0) {
  
  // jika berhasil menghapus data siswa
  set_flashdata('siswa_berhasil', 'berhasil dihapus');
  
  header('Location: data.php?berhasil');
  exit();
  
} else {
  
  // jika gagal menghapus data siswa
  set_flashdata('siswa_gagal', 'gagal dihapus');
  
  header('Location: data.php?gagal');
  exit();
  
}