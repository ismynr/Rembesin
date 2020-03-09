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

          
          <div class="container">
            <div class="card bg-primary mb-4 row">
                <div class="card-body p-3">
                  <h5 class="m-0 font-weight-bold text-white">Ajukan Kegiatan</h5>
                </div>
              </div>
               <div class="card shadow row pb-4 pt-4 pl-2 pr-2">
                <div class="card-body row">
                  <div class="col-md-8">
                    <form class="user ml-3 mr-3" method="POST" action="<?= site_url('karyawan/kegiatan/add') ?>">
                      <div class="form-group">
                        <textarea name="nama_kegiatan" class="form-control form-control-user" id="nama_kegiatan" placeholder="Masukan nama kegiatan" value="<?= set_value('nama_kegiatan'); ?>"></textarea>
                        <?= form_error('nama_kegiatan', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group">
                        <input type="text" name="uang_lumpsum" class="form-control form-control-user" id="uang_lumpsum" placeholder="Uang dinas" value="<?= set_value('uang_lumpsum'); ?>" onkeypress="javascript:return isNumber(event)">
                        <?= form_error('uang_lumpsum', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group">
                        <input type="text" name="tanggal" class="form-control form-control-user" id="tanggal" placeholder="Tanggal" value="<?= set_value('tanggal'); ?>">
                        <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <input type="submit" name="btn" class="btn btn-primary btn-user btn-block" value="Simpan"/>
                    </form>
                    <?= $this->session->flashdata('success'); ?>
                  </div>
                  <div class="col-md-4">
                    <div class="alert alert-warning mt-3">Harap untuk input data dengan benar</div>
                  </div>
                </div>
              </div>
          </div>
          
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

	  <?php $this->load->view("karyawan/_partials/modal.php") ?>     

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("karyawan/_partials/modal.php") ?>

<?php $this->load->view("karyawan/_partials/js_footer.php") ?>
<script>
  $(document ).ready(function(){
    $("#sidebar_menu_ajukanKegiatan").addClass("active");
      $("#tanggal").datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        todayHighlight: true,
        format: 'yyyy-mm-dd'
      });
    });
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)){
          alert("Gunakan number!");
          return false;
        }
        return true;
    };

    var rupiah = document.getElementById('uang_lumpsum');
    rupiah.addEventListener('keyup', function(e){
      rupiah.value = formatRupiah(this.value);
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