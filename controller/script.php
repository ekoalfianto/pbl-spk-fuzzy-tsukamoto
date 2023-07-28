<?php if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
require_once("db_connect.php");
require_once("functions.php");
if (isset($_SESSION["time-message"])) {
  if ((time() - $_SESSION["time-message"]) > 2) {
    if (isset($_SESSION["message-success"])) {
      unset($_SESSION["message-success"]);
    }
    if (isset($_SESSION["message-info"])) {
      unset($_SESSION["message-info"]);
    }
    if (isset($_SESSION["message-warning"])) {
      unset($_SESSION["message-warning"]);
    }
    if (isset($_SESSION["message-danger"])) {
      unset($_SESSION["message-danger"]);
    }
    if (isset($_SESSION["message-dark"])) {
      unset($_SESSION["message-dark"]);
    }
    unset($_SESSION["time-alert"]);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/spkfts-v2/";

$daftarPenerima = mysqli_query($conn, "SELECT * FROM mahasiswa JOIN alternatif ON mahasiswa.id_mahasiswa=alternatif.id_mahasiswa JOIN tabel_hasil ON alternatif.id_mahasiswa=tabel_hasil.id_alternatif ORDER BY tabel_hasil.nilai_total DESC");

if (!isset($_SESSION["data-user"])) {
  if (isset($_POST["masuk"])) {
    if (masuk($_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION["data-user"])) {
  $idUser = valid($_SESSION["data-user"]["id"]);

  $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  if (isset($_POST["ubah-profile"])) {
    if (edit_profile($_POST) > 0) {
      $_SESSION["message-success"] = "Profil akun anda berhasil di ubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  $users = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser' ORDER BY id_user DESC");
  if (isset($_POST["tambah-user"])) {
    if (add_user($_POST) > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-user"])) {
    if (edit_user($_POST) > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["usernameOld"] . " berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-user"])) {
    if (delete_user($_POST) > 0) {
      $_SESSION["message-success"] = "Pengguna " . $_POST["username"] . " berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  // Kriteria
  $kriteria = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria DESC");
  if (isset($_POST["tambah-kriteria"])) {
    if (tambah_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-kriteria"])) {
    if (ubah_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-kriteria"])) {
    if (hapus_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  // Sub Kriteria
  $sub_kriteria = mysqli_query($conn, "SELECT sub_kriteria.*, kriteria.kode_kriteria, kriteria.nama_kriteria FROM sub_kriteria JOIN kriteria ON sub_kriteria.id_kriteria=kriteria.id_kriteria");
  if (isset($_POST["tambah-sub-kriteria"])) {
    if (tambah_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-sub-kriteria"])) {
    if (ubah_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-sub-kriteria"])) {
    if (hapus_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }


  // Keanggotaan
  $anggota = mysqli_query($conn, "SELECT nilai_keanggotaan.*, kriteria.kode_kriteria, kriteria.nama_kriteria FROM nilai_keanggotaan JOIN kriteria ON nilai_keanggotaan.id_kriteria=kriteria.id_kriteria");
  if (isset($_POST["tambah-nilai-keanggotaan"])) {
    if (tambah_nilai_keanggotaan($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-nilai-keanggotaan"])) {
    if (ubah_nilai_keanggotaan($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-sub-kriteria"])) {
    if (hapus_sub_kriteria($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  // mahasiswa
  $mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa");
  if (isset($_POST["tambah-mahasiswa"])) {
    if (tambah_mahasiswa($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["ubah-mahasiswa"])) {
    if (ubah_mahasiswa($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-mahasiswa"])) {
    if (hapus_mahasiswa($_POST) > 0) {
      $_SESSION["message-success"] = "Data berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["tambah-syarat"])) {
    if (tambah_syarat($_POST) > 0) {
      $_SESSION["message-success"] = "Data alternatif berhasil ditambahkan.";
      $_SESSION["time-message"] = time();
      header("Location: mahasiswa");
      exit();
    }
  }

  // Alternatif
  $alternatif = mysqli_query($conn, "SELECT * FROM alternatif JOIN mahasiswa ON alternatif.id_mahasiswa = mahasiswa.id_mahasiswa ORDER BY alternatif.id_alternatif DESC");
  if (isset($_POST["ubah-alternatif"])) {
    if (ubah_alternatif($_POST) > 0) {
      $_SESSION["message-success"] = "Data alternatif berhasil diubah.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }
  if (isset($_POST["hapus-alternatif"])) {
    if (hapus_alternatif($_POST) > 0) {
      $_SESSION["message-success"] = "Data alternatif berhasil dihapus.";
      $_SESSION["time-message"] = time();
      header("Location: " . $_SESSION["page-url"]);
      exit();
    }
  }

  // Laporan
  if (isset($_POST['perhitungan'])) {
    $_SESSION['data-hitung'] = ['akses' => 1];
    header("Location: perhitungan?to=kriteria");
    exit();
  }
  if (isset($_POST['reset-hitung'])) {
    unset($_SESSION['data-hitung']);
    header("Location: perhitungan");
    exit();
  }
  if (isset($_POST['cetak-laporan'])) {
    header("Location: cetak-laporan");
    exit();
  }
}
