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

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header bg-admin py-3">
              <h5 class="m-0 font-weight-bold text-white float-left">List Jenis Bank</h5>
              <div class="float-left ml-2" data-toggle="tooltip" data-placement="bottom" title="Jenis bank yang ingin ditransfer pada karyawan page saat submit rembes"><i class="fas fa-question-circle text-white" style="font-size: 15px;cursor: pointer;"></i></div>
              <button type="button" name="accept" class="btn btn-warning float-right addModalButton p-0"><i class="fas fa-plus mr-2 ml-2"></i></button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th width="5%">No</th>
                      <th>Jenis Bank</th>
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
       <?php $this->load->view("admin/_partials/footer.php") ?>  

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php $this->load->view("admin/_partials/modal.php") ?>

<?php $this->load->view("admin/_partials/js_footer.php") ?>

<form action="<?= site_url('admin/jenis_bank/add');?>" method="post" class="user" id="addForm">
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="updateDetail" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateDetail">Tambah Jenis Bank</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" placeholder="Masukan jenis nota ..." name="jenis_bank" class="form-control form-control-user" id="jenis_bank" required>
            <?= form_error('jenis_bank', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" required>
          <button type="submit" name="accept" class="btn btn-warning">Tambah</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Profile Modal-->
<form action="<?= site_url('admin/jenis_bank/update');?>" method="post" class="user" id="updateForm">
  <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateDetail" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateDetail">Ubah Jenis Bank</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="jenis_bank">Jenis Bank</label>
            <input type="text" placeholder="Jenis bank" name="jenis_bank" class="form-control form-control-user" id="jenis_bank" required>
            <?= form_error('jenis_bank', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" required>
          <button type="submit" name="accept" class="btn btn-success">Ubah</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal Dialog Restore to Trash Member --> 
<form action="<?= site_url('admin/jenis_bank/delete');?>" method="post" class="user">
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Jenis Bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin untuk menghapus "<b id="textJenis"></b>" ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" required>
        <button type="submit" name="accept" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
  $(document ).ready(function(){
    $("#sidebar_menu_dataMaster").addClass("active");
    $("#collapse_menu").addClass("show");
    $("#menu_jb").addClass("active");
    
    $('#dataTable').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('admin/jenis_bank/fetch') ?>",
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
});
</script> 
<script type="text/javascript">
  $(document).on('click','.addModalButton', function(){
    $('#addForm')[0].reset();
    $('#addModal').modal('show');
  });
  $(document).on('click','.updateModalButton', function(){
    $('#updateForm')[0].reset();
    var id = $(this).data('update_id');
    var jenis = $(this).data('update_jenis');
    $('[name="id"]').val(id);
    $('[name="jenis_bank"]').val(jenis);
    $('#updateModal').modal('show');
  });
  //GET INFO
  $(document).on('click','.deleteModalButton', function(){
    $('#deleteModal').modal('show');
    var id = $(this).data('del_id');
    var jenis = $(this).data('del_jenis');
    $('[name="id"]').val(id);      
    $("#textJenis").text(jenis);
  });
</script>

</body>

</html>
