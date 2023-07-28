<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Perhitungan";
$_SESSION["page-url"] = "perhitungan";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body>
  <?php if (isset($_SESSION["message-success"])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION["message-success"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-info"])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION["message-info"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-warning"])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION["message-warning"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-danger"])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION["message-danger"] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <h2>Perhitungan</h2>
                </div>
                <div class="data-main">
                  <div class="row mt-3">
                    <div class="col-lg-3">
                      <div class="card border-0 rounded-0 shadow">
                        <div class="card-body">
                          <nav class="sidebar sidebar-offcanvas bg-transparent" id="sidebar">
                            <ul class="nav">
                              <li class="nav-item">
                                <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='perhitungan?to=kriteria'">
                                  <i class="mdi mdi-subdirectory-arrow-right menu-icon text-dark"></i>
                                  <span class="menu-title text-dark">Kriteria</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='perhitungan?to=alternatif'">
                                  <i class="mdi mdi-subdirectory-arrow-right menu-icon text-dark"></i>
                                  <span class="menu-title text-dark">Alternatif</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='perhitungan?to=rank'">
                                  <i class="mdi mdi-subdirectory-arrow-right menu-icon text-dark"></i>
                                  <span class="menu-title text-dark">Perangkingan</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <form action="" method="post">
                                  <button type="submit" name="reset-hitung" class="nav-link border-0 bg-transparent">
                                    <i class="mdi mdi-refresh menu-icon text-dark"></i>
                                    <span class="menu-title text-dark">Reset</span>
                                  </button>
                                </form>
                              </li>
                            </ul>
                          </nav>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <?php if (!isset($_SESSION['data-hitung'])) { ?>
                        <div class="row">
                          <div class="col-lg-6 m-auto">
                            <form class="text-center" action="" method="post">
                              <h1>Penerima Beasiswa Rekayasa Keamanan Siber</h1>
                              <button type="submit" name="perhitungan" class="btn btn-primary btn-lg text-white rounded-0 border-0 shadow">Lakukan Perhitungan</button>
                              <button type="submit" name="cetak-laporan" class="btn btn-outline-success btn-lg rounded-0 shadow">Cetak Laporan</button>
                            </form>
                          </div>
                          <div class="col-lg-6">
                            <img src="../assets/images/banner-hitung.png" style="width: 100%;" alt="">
                          </div>
                        </div>
                      <?php } else if (isset($_SESSION['data-hitung'])) {
                        if (isset($_GET['to'])) {
                          $mahasiswa = array();
                          $query_alternatif = mysqli_query($conn, "SELECT * FROM alternatif JOIN mahasiswa ON alternatif.id_mahasiswa = mahasiswa.id_mahasiswa ORDER BY alternatif.id_alternatif DESC");
                          while ($row = mysqli_fetch_assoc($query_alternatif)) {
                              $nilai_ipk = $row['nilai_ipk'];
                              $absensi = $row['absensi'];
                              $keaktifan = $row['keaktifan'];
                              $mahasiswa[$row['id_mahasiswa']] = array(
                                  'nama_mahasiswa' => $row['nama_mahasiswa'],
                                  'nilai_ipk' => $nilai_ipk,
                                  'absensi' => $absensi,
                                  'keaktifan' => $keaktifan,
                                  'prodi' => $row['prodi'],
                              );
                          }

                          // Fungsi Keanggotaan
                          function keanggotaan($nilai, $batasBawah, $batasTengah, $batasAtas)
                          {
                              $hasil = [];
                              $hasil['rendah'] = max(0, min(($batasTengah - $batasBawah) != 0 ? ($batasTengah - $nilai) / ($batasTengah - $batasBawah) : 1, 1));
                              $hasil['sedang'] = max(0, min((($nilai - $batasBawah) != 0 ? ($nilai - $batasBawah) / ($batasTengah - $batasBawah) : 1), (($batasAtas - $nilai) != 0 ? ($batasAtas - $nilai) / ($batasAtas - $batasTengah) : 1)));
                              $hasil['tinggi'] = max(0, min((($nilai - $batasTengah) != 0 ? ($nilai - $batasTengah) / ($batasAtas - $batasTengah) : 1), 1));
                              //var_dump($hasil);
                              return $hasil;
                          }

                          $anggota = array();
                          $query_anggota = mysqli_query($conn, "SELECT * FROM nilai_keanggotaan");
                          while ($row = mysqli_fetch_assoc($query_anggota)) {
                              $batas_bawah = $row['batas_bawah'];
                              $batas_tengah = $row['batas_tengah'];
                              $batas_atas = $row['batas_atas'];
                              $anggota[$row['id_kriteria']] = array(
                                  'batas_bawah' => $batas_bawah,
                                  'batas_tengah' => $batas_tengah,
                                  'batas_atas' => $batas_atas,
                              );
                          }

                          // Perhitungan Fuzzy
                          function perhitunganFuzzy($ipk, $absensi, $keaktifan)
                          {
                              global $anggota;
                              // Batas-Batas IPK
                              $batasIpkRendah = $anggota[33]['batas_bawah'];
                              $batasIpkTengah = $anggota[33]['batas_tengah'];
                              $batasIpkTinggi = $anggota[33]['batas_atas'];

                              // Batas-Batas Absensi
                              $batasAbsensiRendah = $anggota[34]['batas_bawah'];
                              $batasAbsensiTengah = $anggota[34]['batas_tengah'];
                              $batasAbsensiTinggi = $anggota[34]['batas_atas'];

                              // Batas-Batas Keaktifan
                              $batasKeaktifanRendah = $anggota[35]['batas_bawah'];
                              $batasKeaktifanTengah = $anggota[35]['batas_tengah'];
                              $batasKeaktifanTinggi = $anggota[35]['batas_atas'];

                              // Fungsi Keanggotaan IPK
                              $keanggotaanIpk = keanggotaan($ipk, $batasIpkRendah, $batasIpkTengah, $batasIpkTinggi);

                              // Fungsi Keanggotaan Absensi
                              $keanggotaanAbsensi = keanggotaan($absensi, $batasAbsensiRendah, $batasAbsensiTengah, $batasAbsensiTinggi);

                              // Fungsi Keanggotaan Keaktifan
                              $keanggotaanKeaktifan = keanggotaan($keaktifan, $batasKeaktifanRendah, $batasKeaktifanTengah, $batasKeaktifanTinggi);

                              //Derajat Keanggotaan
                              $derajatAnggota = [
                                'ipk' => $keanggotaanIpk,
                                'absensi' => $keanggotaanAbsensi,
                                'keaktifan' => $keanggotaanKeaktifan,
                              ];

                              // Aturan Fuzzy (Hardcoded)
                              $aturanFuzzy = [
                                  ['rendah', 'rendah', 'rendah', 'tidak_layak'],
                                  ['rendah', 'rendah', 'sedang', 'tidak_layak'],
                                  ['rendah', 'rendah', 'tinggi', 'layak'],
                                  ['rendah', 'sedang', 'rendah', 'tidak_layak'],
                                  ['rendah', 'sedang', 'sedang', 'tidak_layak'],
                                  ['rendah', 'sedang', 'tinggi', 'layak'],
                                  ['rendah', 'tinggi', 'rendah', 'tidak_layak'],
                                  ['rendah', 'tinggi', 'sedang', 'tidak_layak'],
                                  ['rendah', 'tinggi', 'tinggi', 'layak'],
                                  ['sedang', 'rendah', 'rendah', 'tidak_layak'],
                                  ['sedang', 'rendah', 'sedang', 'tidak_layak'],
                                  ['sedang', 'rendah', 'tinggi', 'layak'],
                                  ['sedang', 'sedang', 'rendah', 'tidak_layak'],
                                  ['sedang', 'sedang', 'sedang', 'layak'],
                                  ['sedang', 'sedang', 'tinggi', 'layak'],
                                  ['sedang', 'tinggi', 'rendah', 'tidak_layak'],
                                  ['sedang', 'tinggi', 'sedang', 'layak'],
                                  ['sedang', 'tinggi', 'tinggi', 'layak'],
                                  ['tinggi', 'rendah', 'rendah', 'tidak_layak'],
                                  ['tinggi', 'rendah', 'sedang', 'layak'],
                                  ['tinggi', 'rendah', 'tinggi', 'layak'],
                                  ['tinggi', 'sedang', 'rendah', 'tidak_layak'],
                                  ['tinggi', 'sedang', 'sedang', 'layak'],
                                  ['tinggi', 'sedang', 'tinggi', 'layak'],
                                  ['tinggi', 'tinggi', 'rendah', 'layak'],
                                  ['tinggi', 'tinggi', 'sedang', 'layak'],
                                  ['tinggi', 'tinggi', 'tinggi', 'layak'],
                              ];

                              // Derajat Aktivasi
                              $derajatAktivasi = [];
                              foreach ($aturanFuzzy as $aturan) {
                                  $derajatAktivasi[] = min($keanggotaanIpk[$aturan[0]], $keanggotaanAbsensi[$aturan[1]], $keanggotaanKeaktifan[$aturan[2]]);
                              }

                              // Himpunan Keluaran
                              $himpunanKeluaran = [
                                  'layak' => [],
                                  'tidak_layak' => [],
                              ];
                              $index = 0;
                              foreach ($aturanFuzzy as $aturan) {
                                  if ($himpunanKeluaran[$aturan[3]] == []) {
                                      $himpunanKeluaran[$aturan[3]] = $derajatAktivasi[$index];
                                  } else {
                                      $himpunanKeluaran[$aturan[3]] = max($himpunanKeluaran[$aturan[3]], $derajatAktivasi[$index]);
                                  }
                                  $index++;
                              }

                              // Defuzzifikasi (Centroid Method)
                              $total = 1;
                              $jumlah = 1;
                              foreach ($himpunanKeluaran as $himpunan => $derajat) {
                                  $total += (float)$himpunan * $derajat;
                                  $jumlah += $derajat;
                              }

                              $hasil = $ipk + ($total / $jumlah);

                              return $hasil;
                          }

                          // Perhitungan untuk setiap mahasiswa
                          $hasilPerhitungan = [];
                          foreach ($mahasiswa as $id_alternatif => $mhs) {
                              $hasil = perhitunganFuzzy($mhs['nilai_ipk'], $mhs['absensi'], $mhs['keaktifan']);

                              $hasilPerhitungan[] = [
                                  'id_alternatif' => $id_alternatif,
                                  'nama_mahasiswa' => $mhs['nama_mahasiswa'],
                                  'hasil' => $hasil,
                                  'program_studi' => $mhs['prodi'],
                              ];
                          }

                          foreach ($hasilPerhitungan as $hasil) {
                              $id_alternatif = mysqli_real_escape_string($conn, $hasil['id_alternatif']);
                              $nilai_total = mysqli_real_escape_string($conn, $hasil['hasil']);
                              mysqli_query($conn, "REPLACE INTO tabel_hasil (id_alternatif, nilai_total) VALUES ('$id_alternatif', '$nilai_total')");
                          }
                        }

                          if ($_GET['to'] == "kriteria") {
                            // Menampilkan Data Kriteria
                            echo "<div class='card border-0 rounded-0 shadow'><div class='card-body'><h4>Data Kriteria</h4><hr><div class='table-responsive'>";
                            echo "<table class='table table-striped table-hover table-borderless table-sm'>";
                            echo "<tr><th>Kode Kriteria</th><th>Nama Kriteria</th><th>Type</th></tr>";
                            foreach ($kriteria as $id_kriteria => $data) {
                              echo "<tr>";
                              echo "<td>" . $data['kode_kriteria'] . "</td>";
                              echo "<td>" . $data['nama_kriteria'] . "</td>";
                              echo "<td>" . $data['type'] . "</td>";
                              echo "</tr>";
                            }
                            echo "</table></div></div></div>";
                          }
                          if ($_GET['to'] == "alternatif") {
                            // Menampilkan Nilai Alternatif
                            echo "<div class='card border-0 rounded-0 shadow'><div class='card-body'><h4>Nilai Alternatif - RKS 2021/2022</h4><hr><div class='table-responsive'>";
                            echo "<table class='table table-striped table-hover table-borderless table-sm'>";
                            echo "<tr><th>Alternatif</th>";
                            foreach ($kriteria as $id_kriteria => $data) {
                              echo "<th>" . $data['nama_kriteria'] . "</th>";
                            }
                            echo "</tr>";
                          
                            foreach ($alternatif as $id_warga => $row) {
                              if ($row['prodi'] == "RKS 2021/2022") {
                                echo "<tr>";
                                echo "<td>" . $row['nama_mahasiswa'] . "</td>";
                                echo "<td>" . $row['keaktifan'] . "</td>";
                                echo "<td>" . $row['absensi'] . "</td>";
                                echo "<td>" . $row['nilai_ipk'] . "</td>";
                                echo "</tr>";
                              }
                            }
                          
                            echo "</table></div></div></div>";
                          
                            echo "<div class='card border-0 rounded-0 shadow'><div class='card-body'><h4>Nilai Alternatif - RKS 2022/2023</h4><hr><div class='table-responsive'>";
                            echo "<table class='table table-striped table-hover table-borderless table-sm'>";
                            echo "<tr><th>Alternatif</th>";
                            foreach ($kriteria as $id_kriteria => $data) {
                              echo "<th>" . $data['nama_kriteria'] . "</th>";
                            }
                            echo "</tr>";
                          
                            foreach ($alternatif as $id_warga => $row) {
                              if ($row['prodi'] == "RKS 2022/2023") {
                                echo "<tr>";
                                echo "<td>" . $row['nama_mahasiswa'] . "</td>";
                                echo "<td>" . $row['keaktifan'] . "</td>";
                                echo "<td>" . $row['absensi'] . "</td>";
                                echo "<td>" . $row['nilai_ipk'] . "</td>";
                                echo "</tr>";
                              }
                            }
                          
                            echo "</table></div></div></div>";
                          }
                          if ($_GET['to'] == "konversi") {
                            // Menampilkan hasil pengurutan
                            echo "<div class='card border-0 rounded-0 shadow'><div class='card-body'><h4>Perankingan</h4><hr>";
                        
                            // Mengelompokkan hasil perhitungan berdasarkan program studi
                            $hasilPerProgramStudi = array();
                            foreach ($hasilPerhitungan as $hasil) {
                                $programStudi = $hasil['program_studi'];
                                if (!isset($hasilPerProgramStudi[$programStudi])) {
                                    $hasilPerProgramStudi[$programStudi] = array();
                                }
                                $hasilPerProgramStudi[$programStudi][] = $hasil;
                            }
                        
                            // Tampilkan hasil peringkat per program studi
                            foreach ($hasilPerProgramStudi as $programStudi => $hasilPeringkat) {
                                echo "<h5>Angkatan: " . $programStudi . "</h5>";
                                echo "<div class='table-responsive'>";
                                echo "<table class='table table-striped table-hover table-borderless table-sm'><thead><tr><th>Ranking</th><th>Nama Mahaiswa</th><th>Nilai Total</th></tr></thead><tbody>";
                                usort($hasilPeringkat, function ($a, $b) {
                                    return $b['hasil'] <=> $a['hasil'];
                                });
                                foreach ($hasilPeringkat as $peringkat => $hasil) {
                                    echo "<tr><td>" . ($peringkat + 1) . "</td>";
                                    echo "<td>" . $hasil['nama_mahasiswa'] . "</td>";
                                    echo "<td>" . (float)$hasil['hasil'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody></table></div>";
                                echo "<br>"; // Tambahkan jarak pemisah antar tabel
                            }
                            echo "</div></div>"; // Closing tags for the card and card-body elements
                          }
                          if ($_GET['to'] == "rank") {
                            // Menampilkan hasil pengurutan
                            echo "<div class='card border-0 rounded-0 shadow'><div class='card-body'><h4>Perankingan</h4><hr>";
                        
                            // Mengelompokkan hasil perhitungan berdasarkan program studi
                            $hasilPerProgramStudi = array();
                            foreach ($hasilPerhitungan as $hasil) {
                                $programStudi = $hasil['program_studi'];
                                if (!isset($hasilPerProgramStudi[$programStudi])) {
                                    $hasilPerProgramStudi[$programStudi] = array();
                                }
                                $hasilPerProgramStudi[$programStudi][] = $hasil;
                            }
                        
                            // Tampilkan hasil peringkat per program studi
                            foreach ($hasilPerProgramStudi as $programStudi => $hasilPeringkat) {
                                echo "<h5>Angkatan: " . $programStudi . "</h5>";
                                echo "<div class='table-responsive'>";
                                echo "<table class='table table-striped table-hover table-borderless table-sm'><thead><tr><th>Ranking</th><th>Nama Mahaiswa</th><th>Nilai Total</th></tr></thead><tbody>";
                                usort($hasilPeringkat, function ($a, $b) {
                                    return $b['hasil'] <=> $a['hasil'];
                                });
                                foreach ($hasilPeringkat as $peringkat => $hasil) {
                                    echo "<tr><td>" . ($peringkat + 1) . "</td>";
                                    echo "<td>" . $hasil['nama_mahasiswa'] . "</td>";
                                    echo "<td>" . (float)$hasil['hasil'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody></table></div>";
                                echo "<br>"; // Tambahkan jarak pemisah antar tabel
                            }
                            echo "</div></div>"; // Closing tags for the card and card-body elements
                          }                       
                      } ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>