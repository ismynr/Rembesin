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

        <?= $this->session->flashdata('klaim'); ?>
        <?= $this->session->flashdata('delete'); ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header bg-company py-3">
              <h5 class="m-0 font-weight-bold text-white float-left">List Rembes Belum Di Klaim</h5>
              <div class="float-right" data-toggle="tooltip" data-placement="bottom" title="Data rembes yang belum diklaim oleh perusahaan"><i class="fas fa-question-circle text-white" style="font-size: 20px;cursor: pointer;"></i></div>
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
                      <th width="12%">Tgl Submit</th>
                      <th width="18%">Action</th>
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

<!-- Modal Dialog Confirm Klaim Rembes --> 
<form action="<?= site_url('perusahaan/klaim_rembes/klaim');?>" method="post">
<div class="modal fade" id="klaimModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Klaim Rembes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin klaim kegiatan "<b class="text_nama"></b>" ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="klaim_id" required>
        <small>Data rembes yang sudah diklaim tidak dapat dikembalikan</small>
        <button type="submit" name="accept" class="btn btn-success">Klaim</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal Dialog Confirm Klaim Rembes --> 
<form action="<?= site_url('perusahaan/klaim_rembes/delete');?>" method="post">
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Rembes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin hapus kegiatan "<b class="text_nama"></b>" ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="delete_id" required>
        <button type="submit" name="accept" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>
</form>



<script type="text/javascript">
  $(document ).ready(function(){
    $("#sidebar_menu_klaimRembes").addClass("active");

    $('#dataTable').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= site_url('perusahaan/klaim_rembes/fetch') ?>",
        type:"POST"
      },
      "columDefs":[
        {
          "target":[0],
          "orderable":false
        }
      ]
    });
});

//GET CONFIRM DELETE
  $(document).on('click','.deleteModalButton', function(){
      var id = $(this).data('delete_id');
      var nama = $(this).data('delete_nama');
      $('#deleteModal').modal('show');
      $('[name="delete_id"]').val(id);
      $('.text_nama').text(nama);
  });

  //GET CONFIRM DELETE
  $(document).on('click','.klaimModalButton', function(){
      var id = $(this).data('klaim_id');
      var nama = $(this).data('klaim_nama');
      $('#klaimModal').modal('show');
      $('[name="klaim_id"]').val(id);
      $('.text_nama').text(nama);
  });
</script>   
</body>
</html>


