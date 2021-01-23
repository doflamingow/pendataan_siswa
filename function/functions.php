<?php

// config
$hostnams = hostname;
$username = username;
$password = password;
$database = database;

// hubungkan ke database
$conn = mysqli_connect($hostname, $username, $password, $database);

// jika gagal terhubung dengan database
if (!$conn) die(mysqli_error());


function query($query) {
  global $conn;
  
  $result = mysqli_query($conn, $query);
  $array = [];
  
  if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
      $array[] = $data;
    }
  }
  
  return $array;
}


function url($target = []) {
  if (filter_var(url, FILTER_VALIDATE_URL)) {
    
    // validasi
    $url = filter_var(url, FILTER_SANITIZE_URL);
    $newTarget = filter_var($target, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $result = (!$newTarget) ? $url : $url . $newTarget;
    
    return $result;
  }
}


function view($file, $data = []) {
  
  // validasi
  $newFile = filter_var($file, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $ekstension = filter_var_array(ekstension, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  
  require_once $newFile . $ekstension['php'];
}


function set_flashdata($name, $message) {
  
  // validasi
  $newName = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $newMessage = filter_var($message, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  
  return $_SESSION[$newName] = ['message' => $newMessage];
}


function flashdata($name) {
  
  // validasi
  $newName = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  
  if (isset($_SESSION[$newName])) {
    return $_SESSION[$newName]['message'];
  }
}


function unset_flashdata($name) {
  
  // validasi
  $newName = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  
  if (isset($_SESSION[$newName])) {
    unset($_SESSION[$newName]);
  }
}


function age($date) {
  
  // pecah menjadi array
  $newDate = explode('-', $date);
  $newDate = array_reverse($newDate);
  
  // ambil hari, bulan dan tahun di array 
  $hariLahir = $newDate[0];
  $bulanLahir = $newDate[1];
  $tahunLahir = $newDate[2];
  
  // hari, bulan dan tahun ini
  $hariIni = date('d');
  $bulanIni = date('m');
  $tahunIni = date('Y');
  
  $result = ($hariIni == $hariLahir && $bulanIni == $bulanLahir) ? $tahunIni - $tahunLahir : $tahunIni - $tahunLahir - 1;
  
  return $result . ' tahun';
}


function spp($nominal) {
  if (filter_var($nominal, FILTER_VALIDATE_INT)) {
    
    // validasi
    $newNominal = filter_var($nominal, FILTER_SANITIZE_NUMBER_INT);
    $paid = 250000;
    
    $result = ($newNominal <= $paid) ? boxSpp('danger', 'belum lunas') : boxSpp('success', 'sudah lunas');
    
    return $result;
  }
}


function boxSpp($type, $text, $color = 'light') {
  
  // validasi
  $newType = filter_var($type, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $newText = filter_var($text, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $newColor = filter_var($color, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  
  return '<span class="badge badge-'. $newType .' p-2 shadow-sm text-'. $newColor .'">'. $newText .'</span>';
}


function lists($list) {
  if (filter_var_array($list)) {
    
    // validasi
    $newList = filter_var_array($list, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    
    return $newList;
  }
}


function tambahSiswa($data) {
  global $conn;
  
  // validasi
  $nama = trim(strip_tags($data['nama']));
  $alamat = trim(strip_tags($data['alamat']));
  $tanggalLahir = trim(strip_tags($data['tanggal_lahir']));
  $gender = trim(strip_tags($data['jenis_kelamin']));
  $kelas = trim(strip_tags($data['kelas']));
  $jurusan = trim(strip_tags($data['jurusan']));
  $spp = trim(strip_tags($data['spp']));
  
  // simpan valuw kedalam session
  $_SESSION['value'] = [
    'nama' => $nama,
    'alamat' => $alamat,
    'tanggal_lahir' => $tanggalLahir,
    'jenis_kelamin' => $gender,
    'kelas' => $kelas,
    'jurusan' => $jurusan,
    'spp' => $spp
  ];
  
  if (!formSiswa($nama, $alamat, $tanggalLahir, $gender, $kelas, $jurusan, $spp)) {
    
    // jika ada error saat memvalidasi, maka arahkan ke form tambah siswa lagi
    header('Location: tambah.php?form');
    exit();
    
  } else {
    
    // perintah query sql
    $query = "INSERT INTO tb_siswa VALUES(NULL, '$nama', '$alamat', '$tanggalLahir', '$gender', '$kelas', '$jurusan', '$spp')";
    
    // jalankan perintah query sql
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
  }
}


function formSiswa($nama, $alamat, $tanggalLahir, $gender, $kelas, $jurusan, $spp) {
  
  // cek method, jika method yang dikirim berupa $_POST, maka lanjutkan validasi
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($nama)) {
      
      // jika input nama kosong
      set_flashdata('form_siswa', 'isi input nama terlebih dahulu');
      
      return false;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
      
      // jika input nama diisi selain huruf
      set_flashdata('form_siswa', 'input nama hanya boleh diisi huruf saja');
      
      return false;
    }
    
    if (empty($alamat)) {
      
      // jika input alamat kosong
      set_flashdata('form_siswa', 'isi input alamat terlebih dahulu');
      
      return false;
    }
    
    if (empty($tanggalLahir)) {
      
      // jika input tanggal lahir kosong
      set_flashdata('form_siswa', 'isi input tanggal lahir terlebih dahulu');
      
      return false;
    }
    
    if (empty($gender)) {
      
      // jika input jenis kelamin kosong
      set_flashdata('form_siswa', 'isi input jenis kelamin terlebih dahulu');
      
      return false;
    }
    
    if (empty($kelas)) {
      
      // jika input kelas kosong
      set_flashdata('form_siswa', 'isi input kelas terlebih dahulu');
      
      return false;
    }
    
    if (empty($jurusan)) {
      
      // jika input jurusan kosong
      set_flashdata('form_siswa', 'isi input jurusan terlebih dahulu');
      
      return false;
    }
    
    if (empty($spp)) {
      
      // jika input spp kosong
      set_flashdata('form_siswa', 'isi input spp terlebih dahulu');
      
      return false;
    } else if (!preg_match("/^[0-9]*$/", $spp)) {
      
      // jika input diisi selain angka
      set_flashdata('form_siswa', 'input spp hanya boleh berisi angka saja dan tanpa spasi');
      
      return false;
    }
    
    // jika lolos validasi
    return true;
  }
}


function hapus($table, $field, $id) {
  global $conn;
  
  // validasi
  $newTable = filter_var($table, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $newField = filter_var($field, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $newId = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
  
  // perintah query sql
  $query = "DELETE FROM {$newTable} WHERE {$newField} = '$newId'";
  
  // jalankan perintah query sql
  mysqli_query($conn, $query);
  
  return mysqli_affected_rows($conn);
}


function ubahSiswa($data, $id) {
  global $conn;
  
  // validasi
  $nama = trim(strip_tags($data['nama']));
  $alamat = trim(strip_tags($data['alamat']));
  $tanggalLahir = trim(strip_tags($data['tanggal_lahir']));
  $gender = trim(strip_tags($data['jenis_kelamin']));
  $kelas = trim(strip_tags($data['kelas']));
  $jurusan = trim(strip_tags($data['jurusan']));
  $spp = trim(strip_tags($data['spp']));
  $newId = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
  
  if (!formSiswa($nama, $alamat, $tanggalLahir, $gender, $kelas, $jurusan, $spp)) {
    
    // jika ada error saat memvalidasi, maka arahkan ke form ubah siswa lagi
    header("Location: ubah.php?id={$newId}");
    exit();
    
  } else {
    
    // perintah query sql
    $query = "UPDATE tb_siswa SET 
                nama = '$nama',
                alamat = '$alamat',
                tanggal_lahir = '$tanggalLahir',
                jenis_kelamin = '$gender',
                kelas = '$kelas',
                jurusan = '$jurusan',
                spp = '$spp' WHERE id = '$newId'";
    
    // jalankan perintah query sql
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
  }
}


function login($data) {
  global $conn;
  
  // validasi
  $email = trim(strip_tags($data['email']));
  $password = trim(strip_tags(mysqli_real_escape_string($conn, $data['password'])));
  
  // simpan value kedalam session
  $_SESSION['value'] = ['email' => $email];
  
  if (!formLogin($email, $password)) {
    
    // jika ada error saat memvalidasi, maka arahkan ke form login lagi
    header("Location: login.php?form");
    exit();
    
  } else {
    
    // ambil data di database sesuai isi dari input email
    $getData = query("SELECT * FROM tb_admin WHERE email = '$email'")[0];
    
    if ($getData) {
      
      // jika menghasilkan true, tandanya ada data yang sesuai dengan email yang diinputkan
      if ($password === $getData['password']) {
        
        // jika password sesuai ddngan data yang ada di database
        $_SESSION['login'] = true;
        $_SESSION['admin'] = ['id' => $getData['id']];
        
        header('Location: admin/index.php?login_berhasil');
        exit();
        
      } else {
        
        // jika password tidak sesuai data manapun yang ada di database
        set_flashdata('form_login', 'password salah');
        
        header('Location: login.php?password_salah');
        exit();
        
      }
    } else {
      
      // jika menghasilkan falze, tandanya tidak ada data yang sesuai email yang diinputkan
      set_flashdata('form_login', 'email atau passwofd salah!');
      
      header('Location: login.php?email_atau_password_salah');
      exit();
      
    }
  }
}


function formLogin($email, $password) {
  
  // cek method, jika method yang dikirim berupa $_POST, maka lanjutkan validasi
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($email)) {
      
      // jika input email kosong
      set_flashdata('form_login', 'isi input email terlebih dahulu');
      
      return false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
      // jika input email tidak berisikan format email yang valid
      set_flashdata('form_login', 'format email tidak valid');
      
      return false;
    }
    
    if (empty($password)) {
      
      // jika input password kosong
      set_flashdata('form_login', 'isi input password terlebih dahulu');
      
      return false;
    }
    
    // jika lolos validasi
    return true;
  }
}


function ubahProfile($data, $id, $emailLama, $gambarLama) {
  global $conn;
  
  // validasi
  $nama = trim(strip_tags($data['nama']));
  $email = trim(strip_tags($data['email']));
  $password = trim(strip_tags($data['password']));
  $newId = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
  
  if (!formProfile($nama, $email, $password)) {
    
    // jika ada error saat memvalidasi, maka arahkan ke form ubah profile lagi
    header("Location: ubah_profile.php?id={$newId}");
    exit();
    
  } else {
    if ($email !== $emailLama) {
      
      // ambil data sesuai isi dari input email
      $cekEmail = query("SELECT email FROM tb_admin WHERE email = '$email'")[0];
      
      if ($cekEmail) {
        
        // jika menghasilkan true, tandanya email sudah digubakan oleh admin lain
        set_flashdata('form_profile', 'email ini sudah digunakan oleh admin lain');
        
        header("Location: ubah_profile.php?id={$newId}");
        exit();
        
      }
    }
    
    $result = ($_FILES['gambar']['error'] === 4) ? $gambar = $gambarLama : $gambar = upload();
    
    if (!$result) {
      
      // jika ada kesalahan dalam mengupload fjle gambar
      header("Location: ubah_profile.php?id={$newId}");
      exit();
      
    }
    
    // perintah query sql
    $query = "UPDATE tb_admin SET 
                nama = '$nama',
                email = '$email',
                password = '$password',
                gambar = '$result' WHERE id = '$newId'";
                
    // jalankan perintah query sql
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
  }
}


function formProfile($nama, $email, $password) {
  
  // cek method, jika method yang dikirim berupa $_POST, maka lanjutkan validasi
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($nama)) {
      
      // jika input nama kosong
      set_flashdata('form_profile', 'isi input nama terlebih dahulu');
      
      return false;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
      
      // jika input nama diisi selain huruf
      set_flashdata('form_profile', 'input nama hanya boleh diisi huruf saja');
      
      return false;
    }
    
    if (empty($email)) {
      
      // jika input email kosong
      set_flashdata('form_profile', 'isi input email terlebih dahulu');
      
      return false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
      // jika input email diisi selain email
      set_flashdata('form_profile', 'bukan berupa format email yang valid');
      
      return false;
    }
    
    if (empty($password)) {
      
      // jika input password kosong
      set_flashdata('form_profile', 'isi input password terlebih dahulu');
      
      return false;
    } else if (strlen($password) < 4) {
      
      // jika password terlalu pendek
      set_flashdata('form_profile', 'password terlalu pendek');
      
      return false;
    }
    
    // jika lolos validasi
    return true;
  }
}


function upload() {
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];
  
  if ($error === 4) {
    
    // jika tidak mengupload gambar
    set_flashdata('form_profile', 'upload file gambar terlebih dahulu');
    
    return false;
  }
  
  $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif'];
  $array = explode('.', $namaFile);
  $ekstensi = strtolower(end($array));
  
  if (!in_array($ekstensi, $ekstensiValid)) {
    
    // jika ekstensi file yang diupload tidak ada yanh sama dengan ekstensi yang diperbolehkan
    set_flashdata('form_profile', 'yang anda upload bukanlah berupa file gambar');
    
    return false;
  }
  
  // 4 mega byte / 4mb
  $ukuranMaximum = 4000000;
  
  if ($ukuranFile > $ukuranMaximum) {
    
    // jika file yang diupload terlalu besar ukuran filenya
    set_flashdata('form_profile', 'file yang anda upload terlalu besar');
    
    return false;
  }
  
  $namaBaru = uniqid();
  $namaBaru .= '.';
  $namaBaru .= $ekstensi;
  
  move_uploaded_file($tmpName, '../../assets/images/admin/' . $namaBaru);
  
  return $namaBaru;
}
