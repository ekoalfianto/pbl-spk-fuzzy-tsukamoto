<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Kriteria";
$_SESSION["page-url"] = "kriteria";
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
                  <h2>Kriteria</h2>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
                      <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header border-bottom-0 shadow">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form action="" method="post">
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                  <input type="text" name="nama_kriteria" value="<?php if (isset($_POST['nama_kriteria'])) {
                                                                              echo $_POST['nama_kriteria'];
                                                                            } ?>" class="form-control" id="nama_kriteria" placeholder="Nama Kriteria" required>
                                </div>
                                <div class="mb-3">
                                  <label for="type" class="form-label">Tipe</label>
                                  <select name="type" class="form-select" aria-label="Default select example" required>
                                    <option selected value="">Pilih Tipe</option>
                                    <option value="Akademik">Akademik</option>
                                    <option value="Sosial">Sosial</option>
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer border-top-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="tambah-kriteria" class="btn btn-primary text-white">Tambah</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="data-main">
                  <div class="table-responsive mt-3">
                    <table class="display table table-bordered table-striped table-sm" id="datatable">
                      <thead>
                        <tr>
                          <th class="text-center">Kode Kriteria</th>
                          <th class="text-center">Nama Kriteria</th>
                          <th class="text-center">Tipe</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($kriteria) > 0) {
                          while ($row = mysqli_fetch_assoc($kriteria)) { ?>
                            <tr>
                              <td><?= $row['kode_kriteria'] ?></td>
                              <td><?= $row['nama_kriteria'] ?></td>
                              <td><?= $row['type'] ?></td>
                              <td class="text-center">
                                <a class="btn btn-warning p-2 text-white" class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_kriteria'] ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                                <div class="modal fade" id="ubah<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_kriteria'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id_kriteria" value="<?= $row['id_kriteria'] ?>">
                                        <input type="hidden" name="nama_kriteriaOld" value="<?= $row['nama_kriteria'] ?>">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                            <input type="text" name="nama_kriteria" value="<?php if (isset($_POST['nama_kriteria'])) {
                                                                                        echo $_POST['nama_kriteria'];
                                                                                      } else {
                                                                                        echo $row['nama_kriteria'];
                                                                                      } ?>" class="form-control" id="nama_kriteria" placeholder="Nama Kriteria" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="type" class="form-label">Tipe</label>
                                            <select name="type" class="form-select" aria-label="Default select example" required>
                                              <?php if ($row['type'] == "Akademik") { ?>
                                                <option value="Akademik">Akademik</option>
                                              <?php } else { ?>
                                                <option value="Sosial">Sosial</option>
                                              <?php }
                                              if ($row['type'] == "Sosial") { ?>
                                                <option value="Akademik">Akademik</option>
                                              <?php } else { ?>
                                                <option value="Sosial">Sosial</option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-kriteria" class="btn btn-warning p-2 text-white">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_kriteria'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                <div class="modal fade" id="hapus<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_kriteria'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id_kriteria" value="<?= $row['id_kriteria'] ?>">
                                        <div class="modal-body">
                                          <p>Anda yakin ingin menghapus kriteria ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="hapus-kriteria" class="btn btn-danger p-2 text-white">Hapus</button>
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
        <script>
          const slider = document.getElementById("mySlider");
          const output = document.querySelector(".nilaiBobot");
          output.innerHTML = slider.value;

          slider.oninput = function() {
            output.innerHTML = this.value;
          }
        </script>
</body>

</html>