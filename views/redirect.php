<?php if (!isset($_SESSION["data-user"])) {
  header("Location: ../auth/");
  exit();
}
