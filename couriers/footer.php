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

  <!-- jQuery -->
  <script src="<?= $base_url ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= $base_url ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
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
  <!-- AdminLTE App -->
  <script src="<?= $base_url ?>assets/dist/js/adminlte.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(document).ready(function() {
      const mysidebar = document.getElementById(".mySideBar")
      var currentPageUrl = window.location.href;
      $('.nav-link').each(function() {
        var navLinkUrl = $(this).attr('href');
        if (currentPageUrl.includes(navLinkUrl)) {
          $(this).closest('li a').addClass('active');
          // $('.mySideBar').removeClass('active');
        }
      });
    });
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $('.select2').select2();

      $('#payment_method').on('change', function() {
        console.log($(this).val());
        var method = $(this).val();
        if (method == 'Cash') {
          $('#gcash_reference_number').attr('hidden', 'hidden');
        } else {
          $('#gcash_reference_number').removeAttr('hidden');
        }
      });

      $('input[name="amount"]').on('keyup', function() {
        var amount = parseInt($(this).val());
        var total_payment = parseInt($('input[name="hid_total_payment"]').val());
        if (amount >= total_payment) {
          $('button[name="payment"]').removeAttr('disabled');
        } else {
          $('button[name="payment"]').attr('disabled', 'disabled');
        }
      });
    });
  </script>
  </body>

  </html>