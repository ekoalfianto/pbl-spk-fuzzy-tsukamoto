<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "Tambah Kriteria";
$_SESSION["page-url"] = "tambahKriteria";
$id_mahasiswa = $_GET['id_mahasiswa'];
$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");
$data = mysqli_fetch_assoc($query);
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
                  <h2>Penerima Beamahasiswa</h2>
                </div>
                <div class="data-main">
                  <p>
                    <center>
                      <h2>Persyaratan Pemenuhan Kriteria<h2>
                    </center>
                  </p>
                  <br>
                  <form role="form" method="post">
                    <div class="form-group">
                      <label>Nama Penerima</label>
                      <input class="form-control" value="<?= $data['nama_mahasiswa']; ?>" readonly>
                      <input type="hidden" name="id_mahasiswa" value="<?= $data['id_mahasiswa']; ?>">
                    </div>
                    <?php
                      $countKriteria = mysqli_query($conn, "SELECT * FROM kriteria");
                      if (mysqli_num_rows($countKriteria) > 0) {
                        while ($data = mysqli_fetch_assoc($countKriteria)) {
                          ?>
                          <div class="form-group">
                            <label><?= $data['nama_kriteria'] ?></label>
                            <?php if ($data['nama_kriteria'] === 'NILAI IPK') { ?>
                              <input type="number" name="data_sub[]" class="form-control" step="0.01" min="3" max="4" required>
                            <?php } else if ($data['nama_kriteria'] === 'ABSENSI') { ?>
                              <input type="number" name="data_sub[]" class="form-control" step="1" min="0" max="100" required>
                            <?php } else { ?>
                              <select name="data_sub[]" class="custom-select form-control" required>
                                <option value="">PILIH <?= $data['nama_kriteria'] ?></option>
                                <?php
                                $id_kriteria = $data['id_kriteria'];
                                $result = mysqli_query($conn, "SELECT * FROM sub_kriteria where id_kriteria='$id_kriteria'");
                                while ($data_sub = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <option value="<?= $data_sub['id_sub_kriteria'] ?>"><?= $data_sub['sub_kriteria']; ?></option>
                                <?php } ?>
                              </select>
                            <?php } ?>
                          </div>
                        <?php }
                      } ?>
                    <button type="submit" name="tambah-syarat" class="btn btn-primary pull-right">Simpan</button>
                    <a href="mahasiswa" class="btn btn-success pull-right" style="margin-right:1%;">Batal</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>