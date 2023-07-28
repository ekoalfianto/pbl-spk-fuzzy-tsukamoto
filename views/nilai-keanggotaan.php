<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Nilai Keanggotaan";
$_SESSION["page-url"] = "nilai-keanggotaan";
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
                  <h2>Nilai Keanggotaan</h2>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
                      <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header border-bottom-0 shadow">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label for="id_kriteria" class="form-label">Nama Kriteria</label>
                                  <select name="id_kriteria" class="form-select" aria-label="Default select example" required>
                                    <option selected value="">Pilih Nama Kriteria</option>
                                    <?php foreach ($kriteria as $data_k) : ?>
                                      <option value="<?= $data_k['id_kriteria'] ?>"><?= $data_k['nama_kriteria'] ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="batas_bawah" class="form-label">Batas Bawah</label>
                                  <input type="number" name="batas_bawah" value="<?php if (isset($_POST['batas_bawah'])) {
                                                                                    echo $_POST['batas_bawah'];
                                                                                  } ?>" class="form-control" id="batas_bawah" placeholder="Batas Bawah" step="0.01" min="0" max="100" required>
                                </div>
                                <div class="mb-3">
                                  <label for="batas_tengah" class="form-label">Batas Tengah</label>
                                  <input type="number" name="batas_tengah" value="<?php if (isset($_POST['batas_tengah'])) {
                                                                                    echo $_POST['batas_tengah'];
                                                                                  } ?>" class="form-control" id="batas_tengah" placeholder="Batas Tengah" step="0.01" min="0" max="100" required>
                                </div>
                                <div class="mb-3">
                                  <label for="batas_atas" class="form-label">Batas Atas</label>
                                  <input type="number" name="batas_atas" value="<?php if (isset($_POST['batas_atas'])) {
                                                                                    echo $_POST['batas_atas'];
                                                                                  } ?>" class="form-control" id="batas_atas" placeholder="Batas Atas" step="0.01" min="0" max="100" required>
                                </div>
                              </div>
                              <div class="modal-footer border-top-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="tambah-nilai-keanggotaan" class="btn btn-primary text-white">Tambah</button>
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
                          <th class="text-center">Batas Bawah</th>
                          <th class="text-center">Batas Tengah</th>
                          <th class="text-center">Batas Atas</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($anggota) > 0) {
                          while ($row = mysqli_fetch_assoc($anggota)) {?>
                            <tr>
                              <td><?= $row['kode_kriteria'] ?></td>
                              <td><?= $row['nama_kriteria'] ?></td>
                              <td><?= $row['batas_bawah'] ?></td>
                              <td><?= $row['batas_tengah'] ?></td>
                              <td><?= $row['batas_atas'] ?></td>
                              <td class="text-center">
                                <a class="btn btn-warning p-2 text-white" class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_keanggotaan'] ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                                <div class="modal fade" id="ubah<?= $row['id_keanggotaan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_kriteria'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id_keanggotaan" value="<?= $row['id_keanggotaan'] ?>">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="id_kriteria" class="form-label">Nama Kriteria</label>
                                            <select name="id_kriteria" class="form-select" aria-label="Default select example" required>
                                              <option selected value="<?= $row['id_kriteria'] ?>"><?= $row['nama_kriteria'] ?></option>
                                              <?php $id_kriteria = $row['id_kriteria'];
                                              $takeKriteria = mysqli_query($conn, "SELECT * FROM kriteria WHERE id_kriteria!='$id_kriteria'");
                                              foreach ($takeKriteria as $data_k) : ?>
                                                <option value="<?= $data_k['id_kriteria'] ?>"><?= $data_k['nama_kriteria'] ?></option>
                                              <?php endforeach; ?>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                  <label for="batas_bawah" class="form-label">Batas Bawah</label>
                                  <input type="number" name="batas_bawah" value="<?php if (isset($_POST['batas_bawah'])) {
                                                                                    echo $_POST['batas_bawah'];
                                                                                  } else {
                                                                                    echo $row['batas_bawah'];
                                                                                  }?>" class="form-control" id="batas_bawah" placeholder="Batas Bawah" step="0.01" min="0" max="100" required>
                                </div>
                                <div class="mb-3">
                                  <label for="batas_tengah" class="form-label">Batas Tengah</label>
                                  <input type="number" name="batas_tengah" value="<?php if (isset($_POST['batas_tengah'])) {
                                                                                    echo $_POST['batas_tengah'];
                                                                                  } else {
                                                                                    echo $row['batas_tengah'];
                                                                                  }?>" class="form-control" id="batas_tengah" placeholder="Batas Tengah" step="0.01" min="0" max="100" required>
                                </div>
                                <div class="mb-3">
                                  <label for="batas_atas" class="form-label">Batas Atas</label>
                                  <input type="number" name="batas_atas" value="<?php if (isset($_POST['batas_atas'])) {
                                                                                    echo $_POST['batas_atas'];
                                                                                  } else {
                                                                                    echo $row['batas_atas'];
                                                                                  }?>" class="form-control" id="batas_atas" placeholder="Batas Atas" step="0.01" min="0" max="100" required>
                                </div>
                                          <script>
                                            const slider<?= $row['id_sub_kriteria'] ?> = document.getElementById("mySlider<?= $row['id_sub_kriteria'] ?>");
                                            const output<?= $row['id_sub_kriteria'] ?> = document.querySelector(".nilaiSub<?= $row['id_sub_kriteria'] ?>");
                                            output<?= $row['id_sub_kriteria'] ?>.innerHTML = slider<?= $row['id_sub_kriteria'] ?>.value;

                                            slider<?= $row['id_sub_kriteria'] ?>.oninput = function() {
                                              output<?= $row['id_sub_kriteria'] ?>.innerHTML = this.value;
                                            }
                                          </script>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-nilai-keanggotaan" class="btn btn-warning p-2 text-white">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_keanggotaan'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                <div class="modal fade" id="hapus<?= $row['id_keanggotaan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['sub_kriteria'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id_sub_kriteria" value="<?= $row['id_sub_kriteria'] ?>">
                                        <div class="modal-body">
                                          <p>Anda yakin ingin menghapus sub kriteria ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="hapus-sub-kriteria" class="btn btn-danger p-2 text-white">Hapus</button>
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
          const output = document.querySelector(".nilaiSub");
          output.innerHTML = slider.value;

          slider.oninput = function() {
            output.innerHTML = this.value;
          }
        </script>
</body>

</html>