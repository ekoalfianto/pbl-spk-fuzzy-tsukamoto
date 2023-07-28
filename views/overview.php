<?php require_once("../controller/script.php"); ?>

<main class="bg-light">

    <style>
        /* Memperbesar ikon dengan properti font-size */
        .larger-icon {
            font-size: 48px; /* Ganti ukuran sesuai kebutuhan */
            margin-left : 30px; 
        }

        .summary-icon {
    width: 4rem;
    height: 4rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--bs-light);
    font-size: 1.5rem;
    border-radius: 50%;
}

        .summary-primary,
        .summary-indigo,
        .summary-success,
        .summary-danger {
            transition: .2s;
        }

        .summary-primary:hover,
        .summary-indigo:hover,
        .summary-success:hover,
        .summary-danger:hover {
            color: var(--bs-light) !important;
        }

        .summary-primary:hover .summary-icon,
        .summary-indigo:hover .summary-icon,
        .summary-success:hover .summary-icon,
        .summary-danger:hover .summary-icon {
            background-color: var(--bs-light) !important;
        }

        .summary-primary:hover .summary-icon {
            color: var(--bs-primary) !important;
        }

        .summary-indigo:hover .summary-icon {
            color: var(--bs-green) !important;
        }

        .summary-success:hover .summary-icon {
            color: var(--bs-success) !important;
        }

        .summary-danger:hover .summary-icon {
            color: var(--bs-danger) !important;
        }

        .summary-primary:hover {
            background-color: var(--bs-primary) !important;
        }

        .summary-indigo:hover {
            background-color: var(--bs-green) !important;
        }

        .summary-success:hover {
            background-color: var(--bs-success) !important;
        }

        .summary-danger:hover {
            background-color: var(--bs-danger) !important;
        }

        .info-card {
            text-align: left;
            justify-content: center;
            margin-top: 1px;
            margin-left : 30px;
            /* border: 1px solid; */
        }

        .info-card .info-card-satuan {
            display: flex;
            justify-content: left;
            margin-top:20px;
            /* border: 1px solid; */

        }

        .info-card-satuan p {
            position: relative;
            margin-left: 0.3rem;
            font-size: 0.98rem;
            text-align: end;
            /* border: 1px solid; */
        }
    </style>
        <div class="p-2">
            <!-- start: Navbar -->
            <nav class="px-3 py-2 bg-white rounded shadow-sm">
                <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
                <h5 class="fw-bold mb-0 me-auto p-1">Dashboard</h5>
            </nav>
            <!-- end: Navbar -->
            <div class="row">
              <h2></h2>
              <div class="col-14">
                <div class="card border-0 rounded-0">
                  <div class="card-body">
                    <h3>Sistem Pendukung Keputusan Penerima Beasiswa Rekayasa Keamanan Siber (Metode Fuzzy Tsukamoto)</h3>
                    <p>Sistem Pendukung Keputusan Penerima Beasiswa Berbasis Web Menggunakan Metode Fuzzy Tsukamoto untuk menghasilkan keputusan yang objektif serta terkomputerisasi. Dapat mempermudah kinerja pihak program studi dalam penyeleksian calon penerima beamsiswa secara akurat, agar beamahasiswa bisa sampai pada orang yang tepat. </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- start: Content -->
            <div class="py-4">
                <!-- start: Summary -->
                <div class="row g-3">
                <div class="col-12 col-sm-6 col-lg-3">
                        <a href="kriteria"
                            class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-start summary-indigo">
                            <div>
                              <i class="bi bi-border-width larger-icon"></i>
                            </div>
                            <div class="info-card">
                                <div class="info-card-satuan">
                                    <h3>Kriteria</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="sub-kriteria"
                            class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-start summary-indigo">
                            <div>
                              <i class="bi bi-border-style larger-icon"></i>
                            </div>
                            <div class="info-card">
                                <div class="info-card-satuan">
                                    <h3>Sub-Kriteria</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3 card-dashboard">
                        <a href="mahasiswa"
                            class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-start summary-success">
                            <div>
                              <i class="bi bi-people-fill larger-icon"></i>
                            </div>
                            <div class="info-card">
                                <div class="info-card-satuan">
                                    <h3>Mahasiswa</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="penilaian"
                            class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-start summary-danger">
                            <div>
                              <i class="bi bi-person-lines-fill larger-icon"></i>
                            </div>
                            <div class="info-card">
                                <div class="info-card-satuan">
                                    <h3>Alternatif</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- end: Summary -->
            </div>
            <!-- end: Content -->
        </div>
    </main>

<script src="../assets/datatable/datatables.js"></script>
<script>
  $(document).ready(function() {
    $("#datatable").DataTable();
  });
</script>
<script>
  (function() {
    function scrollH(e) {
      e.preventDefault();
      e = window.event || e;
      let delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
      document.querySelector(".table-responsive").scrollLeft -= (delta * 40);
    }
    if (document.querySelector(".table-responsive").addEventListener) {
      document.querySelector(".table-responsive").addEventListener("mousewheel", scrollH, false);
      document.querySelector(".table-responsive").addEventListener("DOMMouseScroll", scrollH, false);
    }
  })();
</script>