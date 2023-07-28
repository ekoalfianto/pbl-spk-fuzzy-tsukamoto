<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © EAC. All rights reserved. Powered By Muhamad Eko Alfianto</span>
  </div>
</footer>
</div>
</div>
</div>
<script src="../assets/js/vendor.bundle.base.js"></script>
<script src="../assets/js/Chart.min.js"></script>
<script src="../assets/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/progressbar.min.js"></script>
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/template.js"></script>
<script src="../assets/js/settings.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/Chart.roundedBarCharts.js"></script>
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/datatable/datatables.js"></script>
<script>
  const messageSuccess = $(".message-success").data("message-success");
  const messageInfo = $(".message-info").data("message-info");
  const messageWarning = $(".message-warning").data("message-warning");
  const messageDanger = $(".message-danger").data("message-danger");

  if (messageSuccess) {
    Swal.fire({
      icon: "success",
      title: "Berhasil Terkirim",
      text: messageSuccess,
    })
  }

  if (messageInfo) {
    Swal.fire({
      icon: "info",
      title: "For your information",
      text: messageInfo,
    })
  }
  if (messageWarning) {
    Swal.fire({
      icon: "warning",
      title: "Peringatan!!",
      text: messageWarning,
    })
  }
  if (messageDanger) {
    Swal.fire({
      icon: "error",
      title: "Kesalahan",
      text: messageDanger,
    })
  }
</script>
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
