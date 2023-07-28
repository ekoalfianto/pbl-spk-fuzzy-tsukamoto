<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION["page-name"] = "";
$_SESSION["page-url"] = "";
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
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <!-- <a class="nav-link action active ps-0" id="overview" data-bs-toggle="tab" role="tab" style="cursor: pointer;" aria-controls="overview" aria-selected="true">Ringkasan</a> -->
                    </li>
                    <li class="nav-item">
                      <!-- <a class="nav-link action border-0" id="maps" data-bs-toggle="tab" style="cursor: pointer;" role="tab" aria-selected="false">Maps</a> -->
                    </li>
                  </ul>
                  <div>
                    <div class="btn-wrapper">
                      <!-- <a href="report" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a> -->
                    </div>
                  </div>
                </div>
                <div class="data-main"></div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>
