  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/popper/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('assets/chart.js/Chart.min.js') ?>"></script>
  
  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
  <script src="<?= base_url('assets/js/demo/chart-pie-demo.js') ?>"></script>
  <!-- <script src="<?= base_url('assets/js/bootstrap-datepicker.js') ?>"></script> -->
  <script src="<?= base_url('assets/datepicker/js/gijgo.min.js') ?>" type="text/javascript"></script>
  <script src="<?= base_url('assets/dataTables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('assets/dataTables/dataTables.bootstrap4.min.js') ?>"></script>

<script>
  //GET CONFIRM DELETE
  $(document).on('click','.profileModal', function(){
      $('#profileModal').modal('show');
  });
  //ALERT
  $(".alertAutoClose").delay(3000).fadeTo(1000, 0).slideUp(200, function(){
    $(".alertAutoClose").slideUp(200);
  });
</script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>