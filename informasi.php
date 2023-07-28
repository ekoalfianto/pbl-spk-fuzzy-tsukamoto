<?php require_once("controller/script.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("resources/header.php"); ?>
</head>

<body>
  <!-- Topbar Start -->
  <div class="container-fluid px-5 d-none d-lg-block">
    <div class="row gx-5">
      <div class="col-lg-4 text-center py-3">
        <div class="d-inline-flex align-items-center">
          <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
          <div class="text-start">
            <h6 class="text-uppercase fw-bold">Alamat Sekolah</h6>
            <span>Jl. Dua Lontar, Kayu Putih, Kec. Oebobo, Kota Kupang Prov. Nusa Tenggara Timur</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 text-center border-start border-end py-3">
        <div class="d-inline-flex align-items-center">
          <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
          <div class="text-start">
            <h6 class="text-uppercase fw-bold">Email</h6>
            <span>sdinpresoebufu@gmail.com</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 text-center py-3">
        <div class="d-inline-flex align-items-center">
          <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
          <div class="text-start">
            <h6 class="text-uppercase fw-bold">Telp</h6>
            <span>(0380) 8553858</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <?php require_once("resources/navbar.php"); ?>
  <!-- Navbar End -->


  <!-- Page Header Start -->
  <div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Informasi</h1>
    <div class="d-inline-flex text-white">
      <h6 class="text-uppercase m-0"><a href="./">Beranda</a></h6>
      <h6 class="text-white m-0 px-3">/</h6>
      <h6 class="text-uppercase text-white m-0">Informasi</h6>
    </div>
  </div>
  <!-- Page Header Start -->

  <!-- Informasi Start -->
  <div class="container-fluid py-6 px-5">
    <div class="row g-5">
      <div class="col-lg-8">
        <h1 class="display-5 text-uppercase mb-4">Daftar Penerima <span class="text-primary">Beasiswa</span></h1>
        <div class="table-responsive">
          <!-- Table for Prodi A -->
          <table class="table table-striped table-hover table-borderless table-sm display" id="datatable_prodi_a">
            <thead>
              <tr>
                <th scope="col" class="text-center">#Rank</th>
                <th scope="col" class="text-center">NIM</th>
                <th scope="col" class="text-center">Nama mahasiswa</th>
                <th scope="col" class="text-center">Angkatan</th>
                <th scope="col" class="text-center">Nilai Penerima</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($daftarPenerima) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($daftarPenerima)) {
                  if ($row["prodi"] == "RKS 2021/2022") { // Change "Prodi A" to the actual name of your first study program
              ?>
                    <tr>
                      <th scope="row" class="text-center"><?= $no; ?></th>
                      <td class="text-center"><?= $row["nim"] ?></td>
                      <td><?= $row["nama_mahasiswa"] ?></td>
                      <td class="text-center"><?= $row["prodi"] ?></td>
                      <td class="text-center"><?= $row["nilai_total"] ?></td>
                    </tr>
              <?php
                    $no++;
                  }
                }
              }
              ?>
            </tbody>
          </table>

          <!-- Table for Prodi B -->
          <table class="table table-striped table-hover table-borderless table-sm display" id="datatable_prodi_b">
            <thead>
              <tr>
                <th scope="col" class="text-center">#Rank</th>
                <th scope="col" class="text-center">NIM</th>
                <th scope="col" class="text-center">Nama mahasiswa</th>
                <th scope="col" class="text-center">Angkatan</th>
                <th scope="col" class="text-center">Nilai Penerima</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($daftarPenerima) > 0) {
                $no = 1;
                mysqli_data_seek($daftarPenerima, 0); // Reset the pointer to the beginning of the data
                while ($row = mysqli_fetch_assoc($daftarPenerima)) {
                  if ($row["prodi"] == "RKS 2022/2023") { // Change "Prodi B" to the actual name of your second study program
              ?>
                    <tr>
                      <th scope="row" class="text-center"><?= $no; ?></th>
                      <td class="text-center"><?= $row["nim"] ?></td>
                      <td><?= $row["nama_mahasiswa"] ?></td>
                      <td class="text-center"><?= $row["prodi"] ?></td>
                      <td class="text-center"><?= $row["nilai_total"] ?></td>
                    </tr>
              <?php
                    $no++;
                  }
                }
              }
              ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
  <!-- About End -->

  <?php require_once("resources/footer.php"); ?>

</body>

</html>