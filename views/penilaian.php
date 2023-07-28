<?php require_once("../controller/script.php");
require_once("../controller/db_connect.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Penilaian";
$_SESSION["page-url"] = "penilaian";
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
                  <h2>Penilaian</h2>
                </div>
                <div class="data-main">
                  <div class="table-responsive mt-3">
                    <table class="display table table-bordered table-striped table-sm" id="datatable">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th class="text-center">Nama Mahasiswa</th>
                          <th class="text-center">Nilai IPK</th>
                          <th class="text-center">Absensi</th>
                          <th class="text-center">Keaktifan</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $no = 1;
                        if (mysqli_num_rows($alternatif) > 0) {
                          while ($row = mysqli_fetch_assoc($alternatif)) {
                            $keaktifan = $row['keaktifan'];

                            /* Mendapatkan sub_kriteria absensi dari tabel sub_kriteria
                            $query_absensi = "SELECT sub_kriteria FROM sub_kriteria WHERE id_kriteria = '34' AND nilai_sub = '$absensi'";
                            $result_absensi = mysqli_query($conn, $query_absensi);
                            $sub_kriteria_absensi = mysqli_fetch_assoc($result_absensi)['sub_kriteria'];
                            */
                            // Mendapatkan sub_kriteria keaktifan dari tabel sub_kriteria
                            $query_keaktifan = "SELECT sub_kriteria FROM sub_kriteria WHERE id_kriteria = '35' AND nilai_sub = '$keaktifan'";
                            $result_keaktifan = mysqli_query($conn, $query_keaktifan);
                            $sub_kriteria_keaktifan = mysqli_fetch_assoc($result_keaktifan)['sub_kriteria'];
                            ?>

                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $row['nama_mahasiswa'] ?></td>
                              <td><?= $row['nilai_ipk'] ?></td>
                              <td><?= $row['absensi'] ?> % </td>
                              <td><?= $sub_kriteria_keaktifan ?></td>
                              <td class="text-center">
                                <a class="btn btn-warning p-2 text-white" class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_alternatif'] ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                                <div class="modal fade" id="ubah<?= $row['id_alternatif'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_mahasiswa'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id_mahasiswa" value="<?= $row['id_mahasiswa'] ?>">
                                        <input type="hidden" name="id_alternatif" value="<?= $row['id_alternatif'] ?>">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="nilai_ipk" class="form-label">Nilai IPK</label>
                                            <input type="number" class="form-control" name="nilai_ipk" step="0.01" min="3" max="4" value="<?= $row['nilai_ipk'] ?>" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="absensi" class="form-label">Absensi</label>
                                            <input type="number" class="form-control" name="absensi" step="1" min="0" max="100" value="<?= $row['absensi'] ?>" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="keaktifan" class="form-label">Keaktifan</label>
                                            <select class="custom-select form-control" name="keaktifan">
                                              <option value="<?= $row['keaktifan'] ?>"><?= $row['keaktifan'] ?></option>
                                              <?php
                                              $keaktifan = $row['keaktifan'];
                                              $query3 = "SELECT * FROM sub_kriteria WHERE id_kriteria='35' AND sub_kriteria!='$keaktifan'";
                                              $keaktifan = mysqli_query($conn, $query3);
                                              while ($data_sub3 = mysqli_fetch_assoc($keaktifan)) {
                                                $nilai_sub3 = $data_sub3['nilai_sub']; // Menyimpan nilai_sub
                                              ?>
                                                <option value="<?= $nilai_sub3 ?>"><?= $data_sub3['sub_kriteria']; ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-alternatif" class="btn btn-warning p-2 text-white">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_alternatif'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                <div class="modal fade" id="hapus<?= $row['id_alternatif'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_mahasiswa'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id_alternatif" value="<?= $row['id_alternatif'] ?>">
                                        <input type="hidden" name="id_mahasiswa" value="<?= $row['id_mahasiswa'] ?>">
                                        <div class="modal-body">
                                          <p>Anda yakin ingin menghapus data penilaian ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="hapus-alternatif" class="btn btn-danger p-2 text-white">Hapus</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>