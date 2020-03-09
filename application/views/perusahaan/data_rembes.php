<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("perusahaan/_partials/header.php") ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php $this->load->view("perusahaan/_partials/sidebar.php") ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view("perusahaan/_partials/topbar.php") ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header bg-company py-3">
              <h5 class="m-0 font-weight-bold float-left text-white">List Data Rembes</h5>
              <!-- <a href="<?= site_url('perusahaan/data_rembes/report') ?>" target="_blank" class="pt-0 pr-2 pb-0 pl-2 ml-3 btn btn-info float-right"><i class="fas fa-file-pdf mr-2"></i>Report</a> -->
              <button type="button" target="_blank" class="pt-0 pr-2 pb-0 pl-2 ml-3 btn btn-info float-right reportModalButton" data-toggle="modal"><i class="fas fa-file-pdf mr-2"></i>Report</button>
              <div class="float-right" data-toggle="tooltip" data-placement="bottom" title="Data rembes yang sudah diklaim oleh perusahaan"><i class="fas fa-question-circle text-white" style="font-size: 20px;cursor: pointer;"></i></div>
            </div>
           <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                      <th>No</th>
                      <th>Kategori</th>
                      <th>Kegiatan</th>
                      <th>Karyawan</th>
                      <th>Uang Dinas</th>
                      <th width="12%">Tgl Kegiatan</th>
                      <th width="12%">Tgl Selesai</th>
                      <th width="12%">Tgl Klaim</th>
                      <th width="5%">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    <?php $this->load->view("perusahaan/_partials/modal.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("perusahaan/_partials/modal.php") ?>

<?php $this->load->view("perusahaan/_partials/js_footer.php") ?>


<form class="user ml-3 mr-3" id="reportFormByDate" method="POST" action="<?= site_url('perusahaan/data_rembes/report') ?>">
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report Rembes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Berdasarkan tanggal klaim perusahaan</p>
        <div class="form-group">
          <label for="startDate">Dari</label>
          <input type="text" name="startDate" class="form-control form-control-user" id="startDate" placeholder="Tanggal" value="<?= set_value('startDate'); ?>" required>
          <?= form_error('startDate', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
          <label for="endDate">Sampai</label>
          <input type="text" name="endDate" class="form-control form-control-user" id="endDate" placeholder="Tanggal" value="<?= set_value('endDate'); ?>" required>
          <?= form_error('endDate', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" formtarget="_blank" class="btn btn-info">Cetak</button>
      </div>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
  $(document ).ready(function(){
    $("#sidebar_menu_dataRembes").addClass("active");

    $("#startDate").datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        maxDate: function() {
            var date = new Date();
            date.setDate(date.getDate());
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
        },
        todayHighlight: true,
        format: 'yyyy-mm-dd'
      });
    $("#endDate").datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        maxDate: function() {
            var date = new Date();
            date.setDate(date.getDate());
            return new Date(date.getFullYear(), date.getMonth(), date.getDate());
        },
        todayHighlight: true,
        format: 'yyyy-mm-dd'
      });

    $('#dataTable').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('perusahaan/data_rembes/fetch') ?>",
        type:"POST"
      },
      "columDefs":[
        {
          "target":[0],
          "orderable":false
        }
      ]
    });

  $(function() {
    $('#dataTable_filter').addClass('float-right');
  });

  $(document).on('click','.reportModalButton', function(){
    $('#reportFormByDate')[0].reset();
    $('#reportModal').modal('show');
  });

});
</script>   
</body>
</html>
