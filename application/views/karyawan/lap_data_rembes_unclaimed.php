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
        
          <div class="card shadow mb-4">
            <div class="card-header bg-primary py-3">
              <h5 class="m-0 font-weight-bold text-white float-left ">Rembes Belum Diklaim</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="data_table" width="100%" cellspacing="0" role="tabpanel" aria-labelledby="home-tab">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Kategori</th>
                      <th>Kegiatan</th>
                      <th width="10%">Uang Dinas</th>
                      <th width="10%">Total Rembes</th>
                      <th width="10%">Keterangan</th>
                      <th width="12%">Tanggal</th>
                      <th width="16%">Action</th>
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

    <?php $this->load->view("karyawan/_partials/footer.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
<?php $this->load->view("karyawan/_partials/modal.php") ?>
<?php $this->load->view("karyawan/_partials/js_footer.php") ?>

<!-- Modal Dialog Confirm Delete --> 
<form action="<?= site_url('karyawan/lap_dataRembes/unclaimed/submit');?>" method="post" class="user" id="formSubmitModal">
<div class="modal fade" id="submitModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Submit Rembes</h5>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin mengajukan rembes "<strong id="submitText"></strong>" ?</p>
        <div class="form-group">
          <input type="text" name="tanggal_selesai" class="form-control form-control-user mb-3" id="tanggal_selesai1" placeholder="Masukan tanggal berakhir kegiatan ..." required>  
        </div>

          <div class="form-group radioButton">
            <label for="rembes">Rembes</label><br>
            <div class="custom-control custom-radio custom-control-inline mt-2">
              <input type="radio" id="cash" required name="radio" onclick="validate();" class="custom-control-input" value="cash">
              <label class="custom-control-label" for="cash">Cash</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="transfer" required name="radio" onclick="validate();" class="custom-control-input" value="transfer">
              <label class="custom-control-label" for="transfer">Transfer</label>
            </div>
          </div>

          <div class="form-group" id="rekening">
            <?php $getJenisBank = $this->db->get('tb_jenis_bank')->result(); ?>
            <div class="form-group">
              <select class="custom-select" name="jenis_bank" style="border-radius: 10rem;" id="jenis_bank">
                <option selected disabled="disabled">Pilih Bank</option>
                <?php foreach($getJenisBank as $ji): ?>
                  <option value="<?= $ji->jenis_bank ?>" class="text-uppercase"><?= $ji->jenis_bank ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <input type="text" name="nama_rekening" class="form-control form-control-user mb-3" id="nama_rekening" placeholder="Nama Rekening">
            <?= form_error('nama_rekening', '<small class="text-danger pl-3">', '</small>') ?>
            <input type="text" name="no_rekening" class="form-control form-control-user mb-3" id="no_rekening" placeholder="No Rekening" onkeypress="javascript:return isNumber(event)">
            <?= form_error('no_rekening', '<small class="text-danger pl-3">', '</small>') ?>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="submit_id" required>
        <input type="hidden" name="kategori_rembes" required>
        <small>Dengan menyutujuinya anda mengajukan data rembes ke perusahaan untuk diklaim</small>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </div>
</div>
</form>

<form action="<?= site_url('karyawan/lap_dataRembes/unclaimed/submit');?>" method="post" class="user" id="formNoRadioModal">
<div class="modal fade" id="submitNoRadioModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Submit Rembes</h5>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin mengajukan rembes "<strong id="submit2Text"></strong>" ?</p>
        <div class="form-group">
          <input type="text" name="tanggal_selesai" class="form-control form-control-user mb-3" id="tanggal_selesai2" placeholder="Masukan tanggal berakhir kegiatan ..." required>  
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="submit_id" required>
        <input type="hidden" name="kategori_rembes" required>
        <small>Dengan menyutujuinya anda mengajukan data rembes ke perusahaan untuk diklaim</small>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Modal Dialog Confirm Submit  --> 
<form action="<?= site_url('karyawan/lap_dataRembes/unclaimed/cancel_submit');?>" method="post">
<div class="modal fade" id="cancelSubmitModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cancel Submit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin membatalkan pengajuan rembes <strong id="cancelSubmit_text"></strong>?</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="submit_id" required>
        <small>Dengan menyutujuinya anda membatalkan pengajuan data rembes ke perusahaan</small>
        <button type="submit" name="delete" class="btn btn-danger">Cancel&nbsp;Submit</button>
      </div>
    </div>
  </div>
</div>
</form>

<script type="text/javascript">
  $(document ).ready(function(){
      $("#tanggal_selesai2").datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        format: 'yyyy-mm-dd'
      });
      $("#tanggal_selesai1").datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        format: 'yyyy-mm-dd'
      });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#sidebar_menu_dataRembesin").addClass("active");
    $("#collapse_menu").addClass("show");
    $("#menu_unclaimed").addClass("active");
    
    $('#data_table').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
          url:"<?= base_url('karyawan/lap_dataRembes/unclaimed/fetch') ?>",
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
function validate() {
    if (document.getElementById("cash").checked == true) {
      document.getElementById("rekening").style.display = "none";
      document.getElementById("jenis_bank").removeAttribute("required");
      document.getElementById("nama_rekening").removeAttribute("required");
      document.getElementById("no_rekening").removeAttribute("required");
    }else if (document.getElementById("transfer").checked == true) {
      document.getElementById("rekening").style.display = "block";
      document.getElementById("jenis_bank").setAttribute("required", "required");
      document.getElementById("nama_rekening").setAttribute("required", "required");
      document.getElementById("no_rekening").setAttribute("required", "required");
    }
}
//GET DELETE
  $(document).on('click','.submitModalButton', function(){
      $('#formNoRadioModal')[0].reset();
      $('#formSubmitModal')[0].reset();
      document.getElementById("rekening").style.display = "none";
      var id = $(this).data('id');
      $('[name="submit_id"]').val(id);
      $('[name="kategori_rembes"]').val($(this).data('rekening'));
      if($(this).data('rekening') == "Nota"){
        $("#submit2Text").text( $(this).data('nama'));
        $('#submitNoRadioModal').modal('show');
      }else{
        $("#submitText").text( $(this).data('nama'));
        $('#submitModal').modal('show');
      }
  });
  $(document).on('click','.cancelSubmitModalButton', function(){
      var id = $(this).data('id');
      $('[name="submit_id"]').val(id);
      $("#cancelSubmit_text").text($(this).data('nama'));
      $('#cancelSubmitModal').modal('show');
  });
  function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)){
      alert("Gunakan number!");
      return false;
    }
    return true;
}    


</script>

</body>
</html>
