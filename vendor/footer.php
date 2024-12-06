  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2024.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
<!-- Toast Notification -->
<div id="toast" class="toast">
    <div id="toast-message"></div>
</div>

<style>
    .toast {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #4CAF50;
        color: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        display: none;
    }
</style>

<script>
    function showToast(message) {
        var toast = document.getElementById("toast");
        var toastMessage = document.getElementById("toast-message");
        toastMessage.innerText = message;
        toast.style.display = "block";
        setTimeout(function () {
            toast.style.display = "none";
        }, 3000); // 3000 milliseconds = 3 seconds
    }
</script>

<!-- jQuery -->
<script src="<?= $base_url ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= $base_url ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="<?= $base_url ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= $base_url ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= $base_url ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.js"></script>
<!-- AdminLTE App -->
<script src="<?= $base_url ?>assets/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $('.select2').select2();
    });
</script>

<!-- Toast Notification Script -->
<script>
    // Example usage: showToast('Message to display');
    function showToast(message) {
        var toast = document.getElementById("toast");
        var toastMessage = document.getElementById("toast-message");
        toastMessage.innerText = message;
        toast.style.display = "block";
        setTimeout(function () {
            toast.style.display = "none";
        }, 3000); // 3000 milliseconds = 3 seconds
    }
</script>
</body>
</html>
