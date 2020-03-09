<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("karyawan/_partials/header.php") ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php $this->load->view("karyawan/_partials/sidebar.php") ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view("karyawan/_partials/topbar.php") ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?= $this->session->flashdata('success'); ?>
        <?= $this->session->flashdata('gagal'); ?>
        
          <div class="card shadow mb-4">
            <div class="card-header bg-primary py-3">
              <h5 class="m-0 font-weight-bold text-white float-left">List Data Kegiatan</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="data_table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Nama Kegiatan</th>
                      <th width="12%">Uang Dinas</th>
                      <th width="12%">Tanggal Kegiatan </th>
                      <th width="5%">Jml Nota</th>
                      <th width="25%">Action</th>
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

  <!-- Add Rembes Modal-->
  <div class="modal fade" id="tambahRembes" tabindex="-1" role="dialog" aria-labelledby="tambahRembesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="profileModalLabel">Tambah Rembes</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form class="user" id="addForm" method="POST" action="<?= site_url('karyawan/rembes/add') ?>" enctype="multipart/form-data" onsubmit = "return(validate());" name="myForm">
        <div class="modal-body">
            <input type="hidden" name="id_master_rembes" class="form-control form-control-user" id="id_master_rembes">
            <div class="form-group">
              <input type="text" name="kegiatan" class="form-control form-control-user" id="kegiatan" placeholder="Kegiatan"  readonly required>
              <?= form_error('kegiatan', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <?php $getJenisNota = $this->db->get('tb_jenis_nota')->result(); ?>
            <div class="form-group">
              <select class="custom-select" style="border-radius: 10rem;" required name="jenis_nota">
                <option disabled selected value readonly>Pilih Jenis Nota</option>
                <?php foreach($getJenisNota as $jn): ?>
                  <option value="<?= $jn->jenis_nota ?>" class="text-uppercase"><?= $jn->jenis_nota ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="total" class="form-control form-control-user" id="total" placeholder="Total" required onkeypress="javascript:return isNumber(event)">
              <?= form_error('total', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
              <input type="text" name="nama_rembes" class="form-control form-control-user" id="nama_rembes" placeholder="Masukan catatan rembes" required>
              <?= form_error('nama_rembes', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group ml-2">
              <img id="image-preview" alt="image preview"/><br>
              <small>Updad Foto Nota</small>
              <input type="file" class="form-control-file" id="image-source" class="image-source" name="file" required>
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="btn" class="btn btn-info" id="submit" value="Simpan"/>
        </div>
        </form>
      </div>
    </div>
  </div>      

<!-- Modal Dialog Update Member --> 
<form action="<?= site_url('karyawan/kegiatan/update');?>" class="user" method="post" id="updateForm">
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Data Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="kegiatan">Nama Kegiatan</label>
          <textarea name="nama_kegiatan" class="form-control form-control-user" required></textarea>
          <?= form_error('nama_kegiatan', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
          <label for="uang_lumpsum">Uang Dinas</label>
          <input type="text" placeholder="Uang Lumpsum" name="uang_lumpsum" class="form-control form-control-user" id="uang_lumpsum" required onkeypress="javascript:return isNumber(event)">
          <?= form_error('uang_lumpsum', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
          <label for="tanggal">Tanggal Kegiatan</label>
          <input type="text" placeholder="Tanggal" name="tanggal" class="form-control form-control-user" id="tanggal" required>
          <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
       </div>
      <div class="modal-footer">
        <input type="hidden" name="update_id" required>
        <button type="submit" name="update" class="btn btn-success">Update</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal Dialog Confirm Delete Member --> 
<form action="<?= site_url('karyawan/kegiatan/delete');?>" method="post">
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Kegiatan</h5>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus kegiatan "<strong id="delete_text"></strong>" ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="delete_id" required>
        <small>Dengan menyutujuinya nota rembes yang berkaitan dengan kegiatan ini akan terhapus!</small>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
</form>

    <?php $this->load->view("karyawan/_partials/footer.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("karyawan/_partials/modal.php") ?>

<?php $this->load->view("karyawan/_partials/js_footer.php") ?>

<script type="text/javascript">
  $(function () {
    $(".tooltipsku").tooltip();
  });
  $(document).ready(function(){
    $("#sidebar_menu_dataKegiatan").addClass("active");
    $('#data_table').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('karyawan/kegiatan/fetch') ?>",
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
    $('#data_table_filter').addClass('float-right');
  });
  $('[name="tanggal"]').datepicker({
    autoclose: true,
    todayHighlight: true,
    orientation: "top auto",
    format: 'yyyy-mm-dd'
  });
});
  function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    }

  //GET DATA UPDATE
  $(document).on('click','.addModalButton', function(){
      $('#addForm')[0].reset();
      document.getElementById("image-preview").style.display = "none";
      $('[name="id_master_rembes"]').val($(this).data('id'));
      $('[name="kegiatan"]').val($(this).data('nama'));
      $('#tambahRembes').modal('show');
  });
  //GET DATA UPDATE
  $(document).on('click','.updateModalButton', function(){
      $('#updateForm')[0].reset();
      var update_id = $(this).data('id');
      var update_nama_kegiatan = $(this).data('nama_kegiatan');
      var update_uang_lumpsum = $(this).data('uang_lumpsum');
      var update_tanggal_kegiatan = $(this).data('tanggal_kegiatan');
      console.log(update_tanggal_kegiatan);
      $('#updateModal').modal('show');
      $('[name="update_id"]').val(update_id);
      $('[name="nama_kegiatan"]').text(update_nama_kegiatan);
      $('[name="uang_lumpsum"]').val(formatNumber(update_uang_lumpsum));
      $('[name="tanggal"]').val(update_tanggal_kegiatan);
  });
  // GET CONFIRM DELETE
  $(document).on('click','.deleteModalButton',function(){
      var delete_id = $(this).data('id');
      var delete_nama_kegiatan = $(this).data('nama_kegiatan');
      $('#deleteModal').modal('show');
      $('[name="delete_id"]').val(delete_id);
      $("#delete_text").text(delete_nama_kegiatan);
  });
var uploadField = document.getElementById("image-source");
uploadField.onchange = function() {
    if(this.files[0].size > 200000){
      alert("File tidak boleh melebihi 200 kb, silahkan kompres gambar terlebih dahulu");
      this.value = "";
    }else{
      document.getElementById("image-preview").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
      oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };    
  }
};

function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)){
      alert("Gunakan number!");
      return false;
    }
    return true;
}    
    var total = document.getElementById('total');
    total.addEventListener('keyup', function(e){
      total.value = formatRupiah(this.value);
    });
    var uang_lumpsum = document.getElementById('uang_lumpsum');
    uang_lumpsum.addEventListener('keyup', function(e){
      uang_lumpsum.value = formatRupiah(this.value);
    });
 
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    } 
</script>

</body>
</html>
