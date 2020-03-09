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
                  <h5 class="m-0 font-weight-bold text-white">Email Kontak</h5>
                </div>
              </div>
               <div class="card shadow row pb-4 pt-4 pl-2 pr-2">
                <div class="card-body row">
                  <div class="col-md-8">
                    <form class="user ml-3 mr-3" method="POST" action="<?= site_url('admin/pengaturan/email_kontak/save') ?>">
                      <div class="form-group">
                        <label for="emailKontak">Email Kontak To</label>
                        <input type="email" name="emailKontak" id="emailKontak" class="form-control form-control-user" value="<?= $this->config->item('EMAIL_KONTAK') ?>" required>
                        <?= form_error('emailKontak', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <input type="submit" name="btn" class="btn btn-primary btn-user btn-block" value="Simpan"/>
                    </form>
                  </div>
                  <div class="col-md-4">
                    <div class="alert alert-warning">Masukan email yang akan menerima email kontak dari user (Contact US)</div>
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
    $("#menu_ek").addClass("active");
});
</script>
</body>
</html>