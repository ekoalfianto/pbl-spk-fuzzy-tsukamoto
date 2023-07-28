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
            <h6 class="text-uppercase fw-bold">Alamat</h6>
            <span>Jl. Argoluwih No. 15, Kel.Ledok, Kec.Argomulyo, Kota Salatiga, Jawa Tengah 50732</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 text-center border-start border-end py-3">
        <div class="d-inline-flex align-items-center">
          <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
          <div class="text-start">
            <h6 class="text-uppercase fw-bold">Email</h6>
            <span>rks@bhaktisemesta.ac.id​</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 text-center py-3">
        <div class="d-inline-flex align-items-center">
          <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
          <div class="text-start">
            <h6 class="text-uppercase fw-bold">Telp</h6>
            <span>+62 838-0692-9225​</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <?php require_once("resources/navbar.php"); ?>
  <!-- Navbar End -->


  <!-- Carousel Start -->
  <div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="w-100" src="assets/images/Screenshot_1.jpg" alt="Image">
          <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
            <div class="p-3" style="max-width: 1200px;">
              <h1 class="display-2 text-uppercase text-white mb-md-4">Sistem Pendukung Keputusan Penerima Beasiswa Rekayasa Keamanan Siber</h1>
              <h3 class="text-white">Menggunakan Metode Fuzzy Tsukamoto</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Carousel End -->

  <?php require_once("resources/footer.php"); ?>
  
</body>

</html>