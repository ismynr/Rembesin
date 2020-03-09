<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("admin/_partials/header.php") ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php $this->load->view("admin/_partials/sidebar.php") ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view("admin/_partials/topbar.php") ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?= $this->session->flashdata('restore'); ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header bg-danger py-3">
              <h5 class="m-0 font-weight-bold text-white">Data Sampah</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th width="5%">No</th>
                      <th>Nama Perusahaan</th>
                      <th width="10%">No Telepon</th>
                      <th>Email Perusahaan</th>
                      <th>Alamat Perusahaan</th>
                      <th width="15%">Action</th>
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

<!-- Modal Dialog Restore to Trash Member --> 
<form action="<?= site_url('admin/trash/restore');?>" method="post">
<div class="modal fade" id="restoreModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Restore Data Perusahaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin untuk restore data perusahaan ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" required>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="accept" class="btn btn-success">Restore</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Modal Dialog Delete Permanen Member --> 
<!-- <form action="<?= site_url('admin/trash/delete');?>" method="post">
<div class="modal fade" id="delModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin untuk hapus data ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="del_id" required>
        <small>Data akan dihapus secara permanent (data tidak dapat dikembalikan)</small>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="accept" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>
</form> -->

       <?php $this->load->view("admin/_partials/footer.php") ?>  

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php $this->load->view("admin/_partials/modal.php") ?>

<?php $this->load->view("admin/_partials/js_footer.php") ?>
<script type="text/javascript">
  $(document ).ready(function(){
    $("#sidebar_menu_trash").addClass("active");
    
    $('#dataTable').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('admin/trash/fetch') ?>",
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
</script> 
<script type="text/javascript">
  $(document).on('click','.restoreModalButton', function(){
      var id = $(this).data('restore_id');
      $('#restoreModal').modal('show');
      $('[name="id"]').val(id);
  });
  $(document).on('click','.deleteModalButton', function(){
    var del = $(this).data('del_id');
    $('#delModal').modal('show');
    $('[name="del_id"]').val(del);
  });
</script>

</body>

</html>
