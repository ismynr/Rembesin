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
            
          <?= $this->session->flashdata('delete'); ?>
          <div class="card shadow mb-4">
            <div class="card-header bg-company py-3">
              <h5 class="m-0 font-weight-bold text-white">Data Karyawan</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                      <th width="5%">No</th>
                      <th width="10%">Kode</th>
                      <th>Nama Karyawan</th>
                      <th>Kelamin</th>
                      <th>Email</th>
                      <th width="18%">Jabatan Karyawan</th>
                      <th>Alamat</th>
                      <th width="12%">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header bg-company py-3">
              <h5 class="m-0 font-weight-bold text-white float-left">Aktifitas Karyawan</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTableActivity" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                    <th>Waktu</th>
                    <th>User</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                    <th>Item</th>
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

<!-- Profile Modal-->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Detail Karyawan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <img src="<?= base_url('assets\img\karyawan_avatar.png') ?>"  alt="Image Profile" style="width: 100px; border-radius: 50%;" class="mx-auto">
            </div>
            <table class="table table-sm table-borderless mt-2 table-condensed">
              <tbody>
                <tr>
                  <td width="35%">Nama Karyawan</td>
                  <td><p id="text_detail"></p></td>
                </tr>
                <tr>
                  <td width="35%">Jenis Identitas</td>
                  <td><p id="text_detail4"></p></td>
                </tr>
                <tr>
                  <td width="35%">No Identitas</td>
                  <td><p id="text_detail5"></p></td>
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
                  <td><p id="text_detail6" class="text-capitalize"></p></td>
                </tr>
                <tr>
                  <td width="35%">Jabatan</td>
                  <form class="user ml-3 mr-3" method="post" action="<?= site_url('perusahaan/data_karyawan/update') ?>">
                  <td width="50%"><input type="text" name="jabatan" class="form-control form-control-user" id="jabatan" placeholder="Jabatan Karyawan" required></td>
                  <input type="hidden" name="update_id">
                  <td><button type="submit" name="accept" class="btn text-white btn-user bg-success"> Ubah </button></td>
                  </form>
                </tr>
              </tbody>
            </table>
          </div>
          
          <div class="container text-center">
            <form action="<?= site_url('perusahaan/data_karyawan/password') ?>" method="POST">
              <h6 class="text-center float-left mt-2"><b>Akun Karyawan</b></h6>
              <input type="hidden" name="username">
              <button type="submit" name="accept" class="btn text-white float-right bg-primary">Reset Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal Dialog Delete to Trash Member --> 
<form action="<?= site_url('perusahaan/data_karyawan/delete');?>" method="post">
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin untuk hapus data "<strong id="text_nama"></strong>"?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" required>
        <small>Dengan menghapus data karyawan, semua data rembes yang berkaitan dengan karyawan akan ikut terhapus</small>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="accept" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>
</form>

  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("perusahaan/_partials/modal.php") ?>

<?php $this->load->view("perusahaan/_partials/js_footer.php") ?>

<script type="text/javascript">
  $(document ).ready(function(){
    $('.infoModalButton').tooltip({
      placement:'bottom'
    });
    $("#sidebar_menu_dataKaryawan").addClass("active");

    $('#dataTable').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('perusahaan/data_karyawan/fetch') ?>",
        type:"POST"
      },
      "columDefs":[
        {
          "target":[0],
          "orderable":false
        }
      ]
    });

    var table = $('#dataTableActivity').DataTable({
      // "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('perusahaan/data_karyawan/activity/fetch') ?>",
        type:"POST"
      },
      "columDefs":[
        {
          "target":[0],
          "orderable":false
        }
      ]
    });
    setInterval (function test() {
        table.ajax.reload( null, false); 
    }, 3000);

  $(function() {
    $('#dataTable_filter').addClass('float-right');
  });

  //GET CONFIRM DELETE
  $(document).on('click','.deleteModalButton', function(){
      var id = $(this).data('delete_id');
      var nama = $(this).data('delete_nama_karyawan');
      $('#deleteModal').modal('show');
      $('[name="id"]').val(id);
      $('#text_nama').text(nama);
  });

  //GET INFO DELETE
  $(document).on('click','.infoModalButton', function(){
      var id = $(this).data('info_id');
      var nama = $(this).data('info_nama_karyawan');
      var created = $(this).data('info_created_at');
      var updated = $(this).data('info_updated_at');
      var username = $(this).data('info_username');
      var jabatan = $(this).data('info_jabatan');
      var jenis_identitas = $(this).data('info_jenis_identitas');
      var no_identitas = $(this).data('info_no_identitas');
      var logged_at = $(this).data('info_logged_at');
      $('#detailModal').modal('show');
      $("#text_detail").text(nama);
      $("#text_detail2").text(created);
      $("#text_detail3").text(updated);
      $("#text_detail4").text(jenis_identitas);
      $("#text_detail5").text(no_identitas);
      $("#text_detail6").text(logged_at);
      $('[name="update_id"]').val(id);
      $('[name="jabatan"]').val(jabatan);
      $("[name='username']").val(username);
  });
});
</script>   
</body>
</html>
