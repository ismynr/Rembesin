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
          <div class="container">
            <div class="card bg-company mb-4 row">
              <div class="card-body p-3">
                <h5 class="m-0 font-weight-bold text-white">Ubah Password</h5>
              </div>
            </div>
               <div class="card shadow row pb-4 pt-4 pl-2 pr-2">
                <div class="card-body row">
                  <div class="col-md-8">
                    <?= $this->session->flashdata('success'); ?>
                    <form class="user ml-3 mr-3" method="POST" action="<?= site_url('perusahaan/password/update') ?>">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control form-control-user" value="<?= $this->session->userdata('username') ?>" required>
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group">
                          <label for="password">Masukan Password Lama</label>
                          <input type="password" name="password" id="password" class="form-control form-control-user" required>
                          <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label for="passwordBaru">Masukan Password Baru</label>
                          <input type="password" name="passwordBaru" id="passwordBaru" class="form-control form-control-user" required>
                          <?= form_error('passwordBaru', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="col-md-6">
                          <label for="passwordBaru2">Konfirmasi Password Baru</label>
                          <input type="password" name="passwordBaru2" id="passwordBaru2" class="form-control form-control-user" required>
                          <?= form_error('passwordBaru2', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                      </div>
                      <input type="submit" name="btn" class="btn btn-primary btn-user btn-block" value="Simpan"/>
                    </form>
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
	  <?php $this->load->view("perusahaan/_partials/modal.php") ?>
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("perusahaan/_partials/modal.php") ?>
<?php $this->load->view("perusahaan/_partials/js_footer.php") ?>
</body>
</html>