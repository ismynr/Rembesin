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
              <h5 class="m-0 font-weight-bold text-white float-left">List Jenis Nota</h5>
               <div class="float-left ml-2" data-toggle="tooltip" data-placement="bottom" title="Kategori nota yang tersedia"><i class="fas fa-question-circle text-white" style="font-size: 15px;cursor: pointer;"></i></div>
              <button type="button" name="accept" class="btn btn-warning float-right addModalButton p-0"><i class="fas fa-plus mr-2 ml-2"></i></button>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th width="5%">No</th>
                      <th>Jenis Nota</th>
                      <th>Deskripsi Nota</th>
                      <th>Gambar Nota</th>
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

<form action="<?= site_url('admin/jenis_nota/add');?>" method="post" class="user" enctype="multipart/form-data" id="addForm">
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="updateDetail" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateDetail">Tambah Jenis Nota</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" placeholder="Masukan jenis nota ..." name="jenis_nota" class="form-control form-control-user" id="jenis_nota" required>
            <?= form_error('jenis_nota', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
          <div class="form-group">
            <textarea name="deskripsi_nota" placeholder="Deskripsi nota" class="form-control form-control-user" id="deskripsi_nota" required maxlength='70' required></textarea>
            <?= form_error('deskripsi_nota', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
          <div class="form-group">
            <img id="image-previewAdd" alt="image preview"/><br>
            <small>Upload Foto</small>
            <input type="file" id="image-sourceAdd" class="form-control-file" name="file" required>
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

<!-- Update Modal-->
<form action="<?= site_url('admin/jenis_nota/update');?>" method="post" class="user" enctype="multipart/form-data" id="updateForm">
  <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateDetail" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateDetail">Ubah Jenis Nota</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="jenis_nota">Jenis Nota</label>
            <input type="text" placeholder="Jenis nota" name="jenis_nota" class="form-control form-control-user" id="jenis_nota" required>
            <?= form_error('jenis_nota', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
          <div class="form-group">
            <label for="jenis_nota">Deskripsi</label>
            <textarea name="deskripsi_nota" class="form-control form-control-user" id="deskripsi_nota" required maxlength='70'></textarea>
            <?= form_error('deskripsi_nota', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
          <div class="form-group">
            <input type="hidden" name="last_foto_nota" id="update_foto_nota">
            <img id="image-preview" alt="image preview"/><br>
            <small>Ganti Foto Jenis Nota</small>
            <input type="file" id="image-source" class="form-control-file" name="file">
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="update_id" required>
          <button type="submit" name="accept" class="btn btn-success" onclick="console.log();">Ubah</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal Dialog Restore to Trash Member --> 
<form action="<?= site_url('admin/jenis_nota/delete');?>" method="post" class="user">
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Jenis Nota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin untuk menghapusnya ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" required>
        <input type="hidden" name="gambar_nota" required>
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
    $("#menu_jn").addClass("active");
    
    $('#dataTable').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('admin/jenis_nota/fetch') ?>",
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

  $(document).on('click','.addModalButton', function(){
    $('#addForm')[0].reset();
    document.getElementById("image-preview").style.display = "none";
    document.getElementById("image-previewAdd").src = "";
    $('#addModal').modal('show');
  });
  $(document).on('click','.updateModalButton', function(){
    $('#updateForm')[0].reset();
    $('#updateModal').modal('show');
    var id = $(this).data('update_id');
    var jenis = $(this).data('update_jenis');
    var deskripsi_nota = $(this).data('update_deskripsi');
    var gambar_nota = $(this).data('update_gambar');
    $('[name="update_id"]').val(id);
    $('[name="jenis_nota"]').val(jenis);
    $('[name="deskripsi_nota"]').val(deskripsi_nota);
    $('[name="last_foto_nota"]').val(gambar_nota);
    document.getElementById("image-preview").style.display = "block";
    document.getElementById("image-preview").src = "<?= base_url('assets/document/admin/images') ?>/"+gambar_nota; 
  });
  //GET INFO
  $(document).on('click','.deleteModalButton', function(){
    $('#deleteModal').modal('show');
    var id = $(this).data('del_id');
    var gambar_nota = $(this).data('del_gambar_nota');
    $('[name="id"]').val(id);      
    $('[name="gambar_nota"]').val(gambar_nota);      
    $("#textJenis").text(jenis);
  });

  var uploadField = document.getElementById("image-source");
  uploadField.onchange = function() {
      if(this.files[0].size >= 200000){
        alert("File tidak boleh melebihi 200 kb, silahkan kompres gambar terlebih dahulu");
        this.value = "";
      }else{
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
        oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview").src = oFREvent.target.result;
      };    
    };
  
  };
    var uploadField = document.getElementById("image-sourceAdd");
uploadField.onchange = function() {
    if(this.files[0].size > 200000){
      alert("File tidak boleh melebihi 200 kb, silahkan kompres gambar terlebih dahulu");
      this.value = "";
    }else{
      document.getElementById("image-previewAdd").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-sourceAdd").files[0]);
      oFReader.onload = function(oFREvent) {
      document.getElementById("image-previewAdd").src = oFREvent.target.result;
    };    
  }
};
  
</script>
<script>

</script>

</body>

</html>

