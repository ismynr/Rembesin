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
          <div class="container">
            <div class="card mb-4 bg-admin row">
                <div class="card-body p-3">
                  <h5 class="m-0 font-weight-bold text-white">Pengaturan General Website</h5>
                </div>
              </div>
               <div class="card shadow row pb-4 pt-4 pl-2 pr-2 mb-5">
                <div class="card-body row">
                  <div class="col-md-8">
                    <form class="user ml-3 mr-3" method="POST" enctype="multipart/form-data" action="<?= site_url('admin/pengaturan/general/save') ?>">
                      <div class="form-group">
                        <label for="nama_website">Nama Website</label>
                        <input type="text" name="nama_website" id="nama_website" class="form-control form-control-user" value="<?= $this->config->item('SITE_NAME') ?>" required>
                        <?= form_error('nama_website', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group">
                        <label for="deskripsi_website">Deskripsi Website</label>
                        <textarea name="deskripsi_website" id="deskripsi_website" class="form-control form-control-user" required><?= $this->config->item('DESKRIPSI') ?></textarea>
                        <?= form_error('deskripsi_website', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="favicon">Favicon Website</label><br>
                          <input type="hidden" name="last_favicon" id="update_favicon" value="<?= $this->config->item('FAVICON') ?>">
                          <img id="image-previewFavicon" alt="image preview" src="<?= base_url('assets/img/web_config/'.$this->config->item("FAVICON").'') ?>" width="100px" height="100px"/><br>
                          <small>Upload Foto</small>
                          <input type="file" id="image-sourceFavicon" class="form-control-file" name="fileFavicon">
                        </div>
                        <div class="col-md-6">
                          <label for="logo">Logo Website</label><br>
                          <input type="hidden" name="last_logo" id="update_logo" value="<?= $this->config->item('LOGO') ?>">
                          <img id="image-previewLogo" alt="image preview" src="<?= base_url('assets/img/web_config/'.$this->config->item("LOGO").'') ?>" width="100px" height="100px"/><br>
                          <small>Upload Foto</small>
                          <input type="file" id="image-sourceLogo" class="form-control-file" name="fileLogo">
                        </div>
                      </div>
                      

                      <input type="submit" name="btn" class="btn btn-primary btn-user btn-block" value="Simpan"/>
                    </form>
                  </div>
                  <div class="col-md-4">
                    <div class="alert alert-warning">Untuk pengaturan website, biarkan logo dan favicon jika tidak ingin mengubahnya</div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
	  <?php $this->load->view("admin/_partials/modal.php") ?>
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("admin/_partials/modal.php") ?>
<?php $this->load->view("admin/_partials/js_footer.php") ?>
<script type="text/javascript">

$(document ).ready(function(){
    $("#sidebar_menu_sidebar_menu_setting").addClass("active");
    $("#collapse_menu_setting").addClass("show");
    $("#menu_g").addClass("active");
});

var uploadField = document.getElementById("image-sourceFavicon");
uploadField.onchange = function() {
    if(this.files[0].size > 50000){
      alert("File tidak boleh melebihi 200 kb, silahkan kompres gambar terlebih dahulu");
      this.value = "";
    }else{
      document.getElementById("image-previewFavicon").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-sourceFavicon").files[0]);
      oFReader.onload = function(oFREvent) {
      document.getElementById("image-previewFavicon").src = oFREvent.target.result;
    };    
  }
};
var uploadField = document.getElementById("image-sourceLogo");
uploadField.onchange = function() {
    if(this.files[0].size > 200000){
      alert("File tidak boleh melebihi 200 kb, silahkan kompres gambar terlebih dahulu");
      this.value = "";
    }else{
      document.getElementById("image-previewLogo").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-sourceLogo").files[0]);
      oFReader.onload = function(oFREvent) {
      document.getElementById("image-previewLogo").src = oFREvent.target.result;
    };    
  }
};
</script>
</body>
</html>