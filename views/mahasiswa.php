<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "mahasiswa";
$_SESSION["page-url"] = "mahasiswa";
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
                  <h2>Data Mahasiswa</h2>
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
                      <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header border-bottom-0 shadow">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label for="nim" class="form-label">NIM</label>
                                  <input type="number" name="nim" value="<?php if (isset($_POST['nim'])) {
                                                                            echo $_POST['nim'];
                                                                          } ?>" class="form-control" id="nim" placeholder="NIM" required>
                                </div>
                                <div class="mb-3">
                                  <label for="nama_mahasiswa" class="form-label">Nama mahasiswa</label>
                                  <input type="text" name="nama_mahasiswa" value="<?php if (isset($_POST['nama_mahasiswa'])) {
                                                                                echo $_POST['nama_mahasiswa'];
                                                                              } ?>" class="form-control" id="nama_mahasiswa" placeholder="Nama Mahasiswa" required>
                                </div>
                                <div class="mb-3">
                                  <label for="prodi" class="form-label">Program Studi</label>
                                  <select name="prodi" class="form-control" id="prodi" required>
                                    <option value="">Pilih Program Studi</option>
                                    <option value="RKS 2021/2022" <?php if(isset($_POST['prodi']) && $_POST['prodi'] == 'RKS 2021/2022') { echo 'selected'; } ?>>RKS 2021/2022</option>
                                    <option value="RKS 2022/2023" <?php if(isset($_POST['prodi']) && $_POST['prodi'] == 'RKS 2022/2023') { echo 'selected'; } ?>>RKS 2022/2023</option>
                                    <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer border-top-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="tambah-mahasiswa" class="btn btn-primary text-white">Tambah</button>
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
                          <th class="text-center">No.</th>
                          <th class="text-center">NIM</th>
                          <th class="text-center">Nama Mahasiswa</th>
                          <th class="text-center">Program Studi</th>
                          <th class="text-center">Tgl Buat</th>
                          <th class="text-center">Tgl Ubah</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (mysqli_num_rows($mahasiswa) > 0) {
                          $no = 1;
                          while ($row = mysqli_fetch_assoc($mahasiswa)) { ?>
                            <tr>
                              <td><?= $no++ ?></td>
                              <td><?= $row['nim'] ?></td>
                              <td><?= $row['nama_mahasiswa'] ?></td>
                              <td><?= $row['prodi'] ?></td>
                              <td>
                                <div class="badge badge-opacity-success">
                                  <?php $dateCreate = date_create($row["created_at"]);
                                  echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td>
                                <div class="badge badge-opacity-warning">
                                  <?php $dateUpdate = date_create($row["updated_at"]);
                                  echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                                </div>
                              </td>
                              <td class="text-center">
                                <?php $id_mahasiswa = $row['id_mahasiswa'];
                                $checkAlternatif = mysqli_query($conn, "SELECT * FROM alternatif WHERE id_mahasiswa='$id_mahasiswa'");
                                if (mysqli_num_rows($checkAlternatif) == 0) { ?>
                                  <a class="btn btn-warning p-2 text-white" class="btn btn-danger p-2 text-white" href="tambahKriteria.php?id_mahasiswa=<?php echo $row['id_mahasiswa']; ?>">Lengkapi Data</a>
                                <?php } ?>
                                <a class="btn btn-warning p-2 text-white" class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_mahasiswa'] ?>"><i class="bi bi-pencil-square"></i> Ubah</a>
                                <div class="modal fade" id="ubah<?= $row['id_mahasiswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_mahasiswa'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id_mahasiswa" value="<?= $row['id_mahasiswa'] ?>">
                                        <input type="hidden" name="nimOld" value="<?= $row['nim'] ?>">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="nim" class="form-label">nim</label>
                                            <input type="number" name="nim" value="<?php if (isset($_POST['nim'])) {
                                                                                      echo $_POST['nim'];
                                                                                    } else {
                                                                                      echo $row['nim'];
                                                                                    } ?>" class="form-control" id="nim" placeholder="nim" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="nama_mahasiswa" class="form-label">Nama mahasiswa</label>
                                            <input type="text" name="nama_mahasiswa" value="<?php if (isset($_POST['nama_mahasiswa'])) {
                                                                                    echo $_POST['nama_mahasiswa'];
                                                                                  } else {
                                                                                    echo $row['nama_mahasiswa'];
                                                                                  } ?>" class="form-control" id="nama_mahasiswa" placeholder="Nama mahasiswa" required>
                                          </div>
                                          <div class="mb-3">
                                            <label for="prodi" class="form-label">Program Studi</label>
                                            <select name="prodi" class="form-control" id="prodi" required>
                                              <option value="">Pilih Program Studi</option>
                                              <option value="RKS 2021/2022" <?php if(isset($_POST['prodi']) && $_POST['prodi'] == 'RKS 21') { echo 'selected'; } elseif(isset($row['prodi']) && $row['prodi'] == 'RKS 2021/2022') { echo 'selected'; } ?>>RKS 2021/2022</option>
                                              <option value="RKS 2022/2023" <?php if(isset($_POST['prodi']) && $_POST['prodi'] == 'RKS 22') { echo 'selected'; } elseif(isset($row['prodi']) && $row['prodi'] == 'RKS 2022/2023') { echo 'selected'; } ?>>RKS 2022/2023</option>
                                             </select>
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="ubah-mahasiswa" class="btn btn-warning p-2 text-white">Ubah</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <a class="btn btn-danger p-2 text-white" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_mahasiswa'] ?>"><i class="bi bi-trash3"></i> Hapus</a>
                                <div class="modal fade" id="hapus<?= $row['id_mahasiswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header border-bottom-0 shadow">
                                        <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_mahasiswa'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post">
                                        <input type="hidden" name="id_mahasiswa" value="<?= $row['id_mahasiswa'] ?>">
                                        <div class="modal-body">
                                          <p>Anda yakin ingin menghapus mahasiswa ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary p-2" data-bs-dismiss="modal">Batal</button>
                                          <button type="submit" name="hapus-mahasiswa" class="btn btn-danger p-2 text-white">Hapus</button>
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