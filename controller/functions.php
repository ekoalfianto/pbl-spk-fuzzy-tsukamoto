<?php
function valid($value)
{
  global $conn;
  $valid = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $value))));
  return $valid;
}
if (!isset($_SESSION["data-user"])) {
  function masuk($data)
  {
    global $conn;
    $email = valid($data["email"]);
    $password = valid($data["password"]);

    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $_SESSION["message-danger"] = "Maaf, akun yang anda masukan belum terdaftar.";
      $_SESSION["time-message"] = time();
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($password, $row["password"])) {
        $_SESSION["data-user"] = [
          "id" => $row["id_user"],
          "role" => $row["id_role"],
          "email" => $row["email"],
          "username" => $row["username"],
        ];
      } else {
        $_SESSION["message-danger"] = "Maaf, kata sandi yang anda masukan salah.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
  }
}
if (isset($_SESSION["data-user"])) {
  function edit_profile($data)
  {
    global $conn, $idUser;
    $username = valid($data["username"]);
    $password = valid($data["password"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id_user='$idUser'");
    return mysqli_affected_rows($conn);
  }
  function add_user($data)
  {
    global $conn;
    $username = valid($data["username"]);
    $email = valid($data["email"]);
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
      $_SESSION["message-danger"] = "Maaf, email yang anda masukan sudah terdaftar.";
      $_SESSION["time-message"] = time();
      return false;
    }
    $password = valid($data["password"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')");
    return mysqli_affected_rows($conn);
  }
  function edit_user($data)
  {
    global $conn, $time;
    $id_user = valid($data["id-user"]);
    $username = valid($data["username"]);
    $email = valid($data["email"]);
    $emailOld = valid($data["emailOld"]);
    if ($email != $emailOld) {
      $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if (mysqli_num_rows($checkEmail) > 0) {
        $_SESSION["message-danger"] = "Maaf, email yang anda masukan sudah terdaftar.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
    $updated_at = date("Y-m-d " . $time);
    mysqli_query($conn, "UPDATE users SET username='$username', email='$email', updated_at='$updated_at' WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function delete_user($data)
  {
    global $conn;
    $id_user = valid($data["id-user"]);
    mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
    return mysqli_affected_rows($conn);
  }
  function tambah_kriteria($data)
  {
    global $conn;
    $checkKode = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria DESC LIMIT 1");
    if (mysqli_num_rows($checkKode) == 0) {
      $kode_kriteria = "C1";
    } else {
      $row = mysqli_fetch_assoc($checkKode);
      $kode = $row['kode_kriteria'];
      $kode = preg_replace('/\D/', '', $kode);
      $kode = $kode + 1;
      $kode_kriteria = "C" . $kode;
    }
    $nama_kriteria = valid($data['nama_kriteria']);
    $nama_kriteria = strtoupper($nama_kriteria);
    $checkNama = mysqli_query($conn, "SELECT * FROM kriteria WHERE nama_kriteria='$nama_kriteria'");
    if (mysqli_num_rows($checkNama) > 0) {
      $_SESSION["message-danger"] = "Maaf, Nama Kriteria sudah ada.";
      $_SESSION["time-message"] = time();
      return false;
    }
    $type = valid($data['type']);
    mysqli_query($conn, "INSERT INTO kriteria(kode_kriteria,nama_kriteria,type) VALUES('$kode_kriteria','$nama_kriteria', '$type')");
    return mysqli_affected_rows($conn);
  }
  function ubah_kriteria($data)
  {
    global $conn;
    $id_kriteria = valid($data['id_kriteria']);
    $nama_kriteria = valid($data['nama_kriteria']);
    $nama_kriteria = strtoupper($nama_kriteria);
    $nama_kriteriaOld = valid($data['nama_kriteriaOld']);
    if ($nama_kriteria != $nama_kriteriaOld) {
      $checkNama = mysqli_query($conn, "SELECT * FROM kriteria WHERE nama_kriteria='$nama_kriteria'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION["message-danger"] = "Maaf, Nama Kriteria sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
    $type = valid($data['type']); 
    mysqli_query($conn, "UPDATE kriteria SET nama_kriteria='$nama_kriteria', type='$type' WHERE id_kriteria='$id_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function hapus_kriteria($data)
  {
    global $conn;
    $id_kriteria = valid($data['id_kriteria']);
    mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function tambah_sub_kriteria($data)
  {
    global $conn;
    $id_kriteria = valid($data['id_kriteria']);
    $sub_kriteria = $data['sub_kriteria'];
    $nilai_sub = valid($data['nilai_sub']);
    mysqli_query($conn, "INSERT INTO sub_kriteria(id_kriteria,sub_kriteria,nilai_sub) VALUES('$id_kriteria','$sub_kriteria','$nilai_sub')");
    return mysqli_affected_rows($conn);
  }
  function ubah_sub_kriteria($data)
  {
    global $conn;
    $id_sub_kriteria = valid($data['id_sub_kriteria']);
    $id_kriteria = valid($data['id_kriteria']);
    $sub_kriteria = $data['sub_kriteria'];
    $nilai_sub = valid($data['nilai_sub']);
    mysqli_query($conn, "UPDATE sub_kriteria SET id_kriteria='$id_kriteria', sub_kriteria='$sub_kriteria', nilai_sub='$nilai_sub' WHERE id_sub_kriteria='$id_sub_kriteria'");
    return mysqli_affected_rows($conn);
  }
  function hapus_sub_kriteria($data)
  {
    global $conn;
    $id_sub_kriteria = valid($data['id_sub_kriteria']);
    mysqli_query($conn, "DELETE FROM sub_kriteria WHERE id_sub_kriteria='$id_sub_kriteria'");
    return mysqli_affected_rows($conn);
  }


  //Tambah Nilai Keanggotaan
  function tambah_nilai_keanggotaan($data)
  {
    global $conn;
    $id_kriteria = valid($data['id_kriteria']);
    $batasBawah = $data['batas_bawah'];
    $batasTengah = $data['batas_tengah'];
    $batasAtas = $data['batas_atas'];
    mysqli_query($conn, "INSERT INTO nilai_keanggotaan(id_kriteria,batas_bawah,batas_tengah,batas_atas) VALUES('$id_kriteria','$batasBawah','$batasTengah','$batasAtas')");
    return mysqli_affected_rows($conn);
  }

  function ubah_nilai_keanggotaan($data)
  {
    global $conn;
    $id_keanggotaan = valid($data['id_keanggotaan']);
    $id_kriteria = valid($data['id_kriteria']);
    $batasBawah = $data['batas_bawah'];
    $batasTengah = $data['batas_tengah'];
    $batasAtas = $data['batas_atas'];
    mysqli_query($conn, "UPDATE nilai_keanggotaan SET id_kriteria='$id_kriteria', batas_bawah='$batasBawah', batas_tengah='$batasTengah', batas_atas='$batasAtas' WHERE id_keanggotaan='$id_keanggotaan'");
    return mysqli_affected_rows($conn);
  }
  
  /*
  function hapus_sub_kriteria($data)
  {
    global $conn;
    $id_sub_kriteria = valid($data['id_sub_kriteria']);
    mysqli_query($conn, "DELETE FROM sub_kriteria WHERE id_sub_kriteria='$id_sub_kriteria'");
    return mysqli_affected_rows($conn);
  }
*/

  //Tambah Mahasiswa
  function tambah_mahasiswa($data)
  {
    global $conn;
    $nim = valid($data['nim']);
    $checknim = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
    if (mysqli_num_rows($checknim) > 0) {
      $_SESSION["message-danger"] = "Maaf, nim mahasiswa sudah ada.";
      $_SESSION["time-message"] = time();
      return false;
    }
    $nama_mahasiswa = valid($data['nama_mahasiswa']);
    $prodi = valid($data['prodi']);
    mysqli_query($conn, "INSERT INTO mahasiswa(nim,nama_mahasiswa,prodi) VALUES('$nim','$nama_mahasiswa','$prodi')");
    return mysqli_affected_rows($conn);
  }
  function ubah_mahasiswa($data)
  {
    global $conn;
    $id_mahasiswa = valid($data['id_mahasiswa']);
    $nim = valid($data['nim']);
    $nimOld = valid($data['nimOld']);
    if ($nim != $nimOld) {
      $checknim = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
      if (mysqli_num_rows($checknim) > 0) {
        $_SESSION["message-danger"] = "Maaf, NIM mahasiswa sudah ada.";
        $_SESSION["time-message"] = time();
        return false;
      }
    }
    $nama_mahasiswa = valid($data['nama_mahasiswa']);
    $prodi = valid($data['prodi']);
    mysqli_query($conn, "UPDATE mahasiswa SET nim='$nim', nama_mahasiswa='$nama_mahasiswa', prodi='$prodi', updated_at=CURRENT_TIMESTAMP WHERE id_mahasiswa='$id_mahasiswa'");
    return mysqli_affected_rows($conn);
  }
  function hapus_mahasiswa($data)
  {
    global $conn;
    $id_mahasiswa = valid($data['id_mahasiswa']);
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");
    return mysqli_affected_rows($conn);
  }
  function tambah_syarat($data)
  {
    global $conn;
    $id_mahasiswa = valid($data['id_mahasiswa']);
    $data_sub = $data['data_sub'];
  
    $nilai_ipk = $_POST['data_sub'][0];
    $absensi = $_POST['data_sub'][1];
    $keaktifan = null;
  
    foreach ($data_sub as $key => $value) {
      $takeData = mysqli_query($conn, "SELECT * FROM sub_kriteria WHERE id_sub_kriteria='$value'");
      $row = mysqli_fetch_assoc($takeData);
      $id_kriteria = $row['id_kriteria'];
      $sub_kriteria = $row['sub_kriteria'];
      $nilai_sub = $row['nilai_sub'];
  
      // Memeriksa kriteria dan menyimpan nilai ke dalam kolom yang sesuai
      if ($id_kriteria === '35') {
        $keaktifan = $nilai_sub;
      }
    }
    // Memasukkan nilai-nilai ke dalam tabel_nilai
    mysqli_query($conn, "INSERT INTO tabel_nilai (id_mahasiswa, nilai_ipk, absensi, keaktifan) VALUES ('$id_mahasiswa', '$nilai_ipk', '$absensi', '$keaktifan')");
  
    $query = "INSERT INTO alternatif (id_mahasiswa, nilai_ipk, absensi, keaktifan) VALUES ('$id_mahasiswa', '$nilai_ipk', '$absensi', '$keaktifan')";
    mysqli_query($conn, $query);
  
    return mysqli_affected_rows($conn);
  }
  
  
  
  function ubah_alternatif($data)
  {
    global $conn;
    $id_mahasiswa = valid($data['id_mahasiswa']);
    $id_alternatif = valid($data['id_alternatif']);
    $nilai_ipk = valid($data['nilai_ipk']);
    $absensi = valid($data['absensi']);
    $keaktifan = valid($data['keaktifan']);
  
    mysqli_query($conn, "UPDATE tabel_nilai SET nilai_ipk='$nilai_ipk', absensi='$absensi', keaktifan='$keaktifan' WHERE id_mahasiswa='$id_mahasiswa'");
  
    mysqli_query($conn, "UPDATE alternatif SET nilai_ipk='$nilai_ipk', absensi='$absensi', keaktifan='$keaktifan' WHERE id_alternatif='$id_alternatif'");
  
    return mysqli_affected_rows($conn);
  }
  
  
  function hapus_alternatif($data)
  {
    global $conn;
    $id_alternatif = valid($data['id_alternatif']);
    $id_mahasiswa = valid($data['id_mahasiswa']);
    mysqli_query($conn, "DELETE FROM tabel_nilai WHERE id_mahasiswa='$id_mahasiswa'");
    mysqli_query($conn, "DELETE FROM alternatif WHERE id_alternatif='$id_alternatif'");
    return mysqli_affected_rows($conn);
  }
}
