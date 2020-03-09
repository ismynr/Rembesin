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
         <?= $this->session->flashdata('accept'); ?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header bg-admin py-3">
              <h5 class="m-0 font-weight-bold text-white">List Registrasi Baru Perusahaan</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Nama Perusahaan</th>
                      <th width="15%">No Telepon</th>
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

      <?php $this->load->view("admin/_partials/footer.php") ?>  

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

<!-- Profile Modal-->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Detail Perusahaan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="table-responsive-md">
          <div class="container">
            <div class="row">
              <img src="<?= base_url('assets\img\company_avatar.png') ?>"  alt="Image Profile" style="width: 100px; border-radius: 50%;" class="mx-auto">
            </div>
            <div class="table-responsive-md mt-2">
              <table class="table table-sm table-borderless table-condensed" >
                <tbody>
                  <tr>
                    <td width="35%">Perusahaan</td>
                    <td><p id="text_detail"></p></td>
                  </tr>
                  <tr>
                    <td width="35%">Jml Karyawan</td>
                    <td><p id="text_detail4"></p></td>
                  </tr>
                  <tr>
                    <td width="35%">Dibuat Pada</td>
                    <td><p id="text_detail2"></p></td>
                  </tr>
                  <tr>
                    <td width="35%">Diubah Pada</td>
                    <td><p id="text_detail3"></p></td>
                  </tr>
                  <tr>
                    <td width="35%">Terakhir Login</td>
                    <td><p id="text_detail5" class="text-capitalize"></p></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <div class="container text-center">
            <input type="hidden" name="id" required>
            <h6 class="float-left pt-2"><b>Akun Perusahaan</b></h6>
            <button type="button" name="delete_button" id="delete_button" class="deleteModalButton btn text-white float-right btn-danger ml-1">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modal Dialog Confirm Accept Member --> 
<form action="<?= site_url('admin/new_regist/accept');?>" method="post">
<div class="modal fade" id="acceptModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Setujui Data Perusahaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menyetujuinya ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="accept_id" required>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="accept" class="btn btn-success">Accept</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal Dialog Delete to Trash Member --> 
<form action="<?= site_url('admin/new_regist/delete');?>" method="post">
<div class="modal fade" id="delModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus data</h5>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin untuk hapus data ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="del_id" required>
        <small>Data akan dihapus dan dipindahkan ke trash (data dapat dikembalikan)</small>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="accept" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>
</form>

  <?php $this->load->view("admin/_partials/modal.php") ?>

<?php $this->load->view("admin/_partials/js_footer.php") ?>

<script type="text/javascript">
  $(document).ready(function(){
    $("#sidebar_menu_newRegist").addClass("active");
    
    $('#dataTable').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('admin/new_regist/fetch') ?>",
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

//GET CONFIRM DELETE
$(document).on('click','.acceptModalButton', function(){
    var accept_id = $(this).data('accept_id');
    $('#acceptModal').modal('show');
    $('[name="accept_id"]').val(accept_id);
});
  //GET INFO
$(document).on('click','.infoModalButton', function(){
    var id = $(this).data('info_id');
    var nama = $(this).data('info_nama_perusahaan');
    var created = $(this).data('info_created_at');
    var updated = $(this).data('info_updated_at');
    var jmlKaryawan = $(this).data('info_jml_karyawan');
    var logged_at = $(this).data('info_logged_at');
    $('#detailModal').modal('show');
    $("#text_detail").text(nama);
    $("#text_detail2").text(created);
    $("#text_detail3").text(updated);
    $("#text_detail4").text(jmlKaryawan);
    $("#text_detail5").text(logged_at);
    $('[name="id"]').val(id);
    $('#delete_button').attr('data-del_id', id);
});
//GET CONFIRM DELETE
$(document).on('click','.deleteModalButton', function(){
    var id = $(this).data('del_id');
    $('#detailModal').modal('hide');
    $('#delModal').modal('show');
    $('[name="del_id"]').val(id);
});
</script>    

</body>

</html>
