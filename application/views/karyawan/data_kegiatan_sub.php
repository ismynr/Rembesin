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
        
          <div class="card bg-primary mb-4 row ml-1 mr-1">
            <div class="card-body p-3">
              <h5 class="m-0 font-weight-bold text-white"><a href="<?= site_url('karyawan/kegiatan') ?>" class="text-white"><i class="fas fa-arrow-alt-circle-left mr-3" style="font-size: 20px;" data-toggle="tooltip" data-placement="bottom" title="Kembali"></i></a>Detail Kegiatan</h5>
            </div>
          </div>
          <?php $getKegiatan = $this->db->get_where('tb_master_rembes', ['id_master_rembes'=>$id_master_rembes])->row(); ?>
          <?php $getRembes = $this->db->query("SELECT SUM(total_rembes) as total_rembes FROM tb_rembes WHERE id_master_rembes='".$getKegiatan->id_master_rembes."'")->row(); ?>
          <?php $countRembes = $this->db->get_where('tb_rembes', ['id_master_rembes'=>$id_master_rembes])->num_rows(); ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless table-sm" width="100%" cellspacing="0">
                  <thead>
                    <?php $total_rembes = $getRembes->total_rembes == '' ? '0':$getRembes->total_rembes ?>
                     <tr>
                      <th width="15%">Kegiatan </th>
                      <th width="2%">:</th>
                      <th width="50%"><?= $getKegiatan->nama_kegiatan ?></th>
                      <th width="15%">Tanggal Kegiatan</th>
                      <th width="2%">:</th>
                      <th><?= date("d M Y", strtotime($getKegiatan->tanggal_kegiatan))?></th>
                    </tr>
                    <tr>
                      <th width="15%">Uang Dinas</th>
                      <th width="2%">:</th>
                      <th width="50%">Rp. <?= number_format($getKegiatan->uang_lumpsum,0,',','.') ?></th>
                      <th width="15%">Total Rembes</th>
                      <th width="2%">:</th>
                      <th width="50%">Rp. <?= number_format($total_rembes,0,',','.') ?></th>
                    </tr>
                    <tr>
                      <th width="15%">Keterangan Sisa</th>
                      <th width="2%">:</th>
                      <th>Rp. <?= number_format($getKegiatan->uang_lumpsum - $total_rembes,0,',','.')?></th>
                      <th width="15%">Jumlah Nota</th>
                      <th width="2%">:</th>
                      <th><?= $countRembes ?></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 mt-4">
            <div class="card-header bg-primary py-3">
              <h5 class="m-0 font-weight-bold text-white float-left">List Nota Rembes</h5> 
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                      <th width="5%">No</th>
                      <th>Rembes </th>
                      <th>Jenis Nota</th>
                      <th>Tanggal</th>
                      <th>Total</th>
                      <th>Foto Nota</th>
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
      </div>
      <!-- End of Main Content -->

    <?php $this->load->view("karyawan/_partials/modal.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php $this->load->view("karyawan/_partials/modal.php") ?>
<?php $this->load->view("karyawan/_partials/js_footer.php") ?>

<!-- Modal Dialog Update Member --> 
<form action="<?= site_url('karyawan/kegiatan/list_rembes/update');?>" method="post" id="updateForm" class="user" enctype="multipart/form-data">
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Data Rembes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $getJenisNota = $this->db->get('tb_jenis_nota')->result(); ?>
        <div class="form-group">
          <label for="jenis_nota">Pilih jenis nota</label>
          <select class="custom-select" style="border-radius: 10rem;" id="jenis_nota" required name="jenis_nota" value="<?= $getj ?>">
            <option disabled selected value readonly>Pilih Jenis Nota</option>
            <?php foreach($getJenisNota as $jn): ?>
              <option value="<?= $jn->jenis_nota ?>" class="text-uppercase " id="selected"><?= $jn->jenis_nota ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="total_rembes">Total rembes</label>
          <input type="text" placeholder="Total" name="total_rembes" class="form-control form-control-user" id="total_rembes" required onkeypress="javascript:return isNumber(event)">
          <?= form_error('total_rembes', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <div class="form-group">
          <label for="nama_rembes">Catatan</label>
          <input type="text" placeholder="Catatan" name="nama_rembes" class="form-control form-control-user" id="nama_rembes" required>
          <?= form_error('nama_rembes', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
        <input type="hidden" id="getJenisNota" name="getJenisNota">
        <input type="hidden" name="update_foto_nota" id="update_foto_nota" required>
        <input type="hidden" name="last_foto_nota" id="update_foto_nota" required>
        <div class="form-group ml-2">
          <img id="image-preview" alt="image preview"/><br>
          <small>Ganti Foto Nota</small>
          <input type="file" id="image-source" class="form-control-file" name="file">
        </div>
       </div>
      <div class="modal-footer">
        <input type="hidden" name="update_id" required>
        <input type="hidden" name="id_master_rembes" value="<?= $id_master_rembes ?>" required>
        <button type="submit" name="update" class="btn btn-success">Update</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Modal Dialog Confirm Delete Member --> 
<form action="<?= site_url('karyawan/kegiatan/list_rembes/delete')?>" method="post">
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Kegiatan</h5>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus kegiatan "<strong id="id_delete_text"></strong>" ?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="delete_id" id="text_delete_id" required>
        <input type="hidden" name="id_master_rembes" value="<?= $id_master_rembes ?>" required>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="btn_hapus" id="btn_hapus" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
  $(document ).ready(function(){
    $("#sidebar_menu_dataKegiatan").addClass("active");

    $('#dataTable').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= site_url('karyawan/kegiatan/list_rembes/fetch') ?>",
        type:"POST",
        data:function(data){
          data.id_master_rembes = <?= $this->input->post('id_master_rembes',true) ?>;
        }
      },
      "columDefs":[
        {
          "target":[0],
          "orderable":false
        }
      ]
    });
});

  function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    }

  //GET DATA UPDATE
  $(document).on('click','.updateModalButton', function(){
      $('#updateForm')[0].reset();
      var update_id = $(this).data('id');
      var update_nama = $(this).data('nama');
      var update_total = $(this).data('total');
      var update_jenis_nota = $(this).data('jenis_nota');
      var update_foto = $(this).data('foto');
      $('[name="update_id"]').val(update_id);
      $('[name="nama_rembes"]').val(update_nama);
      $('[name="total_rembes"]').val(formatNumber(update_total));
      $('[name="getJenisNota"]').val(update_jenis_nota);
      document.getElementById('jenis_nota').value=update_jenis_nota;
      $('[name="last_foto_nota"]').val(update_foto);
      document.getElementById("image-preview").style.display = "block";
      document.getElementById("image-preview").src = "<?= base_url('assets/document/karyawan/images') ?>/"+update_foto; 
      $('#updateModal').modal('show');
  });

  //GET DELETE
  $(document).on('click','.deleteModalButton', function(){
      var delete_id = $(this).data('id');
      var delete_nama = $(this).data('nama');
      $("#id_delete_text").text(delete_nama);
      $('[name="delete_id"]').val(delete_id);
      $('#deleteModal').modal('show');
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
    } ;

  var total_rembes = document.getElementById('total_rembes');
    total_rembes.addEventListener('keyup', function(e){
      total_rembes.value = formatRupiah(this.value);
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
