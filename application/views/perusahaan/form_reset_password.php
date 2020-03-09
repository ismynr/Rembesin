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
                  <h5 class="m-0 font-weight-bold text-white">Reset Password Akun Karyawan</h5>
                </div>
              </div>
               <div class="card shadow row pb-4 pt-4 pl-2 pr-2">
                <div class="card-body row">
                  <div class="col-md-8">
                    <form class="user ml-3 mr-3" method="POST" action="<?= site_url('perusahaan/data_karyawan/password/reset') ?>">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control form-control-user" id="username" value="<?= $this->input->post('username') ?>" readonly>
                      </div>
                      <div class="form-group">
                        <?= $this->session->flashdata('formPassword') ?>
                      </div>
                      <?= $this->session->flashdata('success') ?>
                      <input type="submit" name="btn" class="btn btn-primary btn-user" id="submitPassword" value="Reset Password"/>
                      <?= $this->session->flashdata('FormPasswordButton') ?>
                    </form>
                  </div>
                  <div class="col-md-4">
                    
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
<?= $this->session->flashdata('js_hiddenButton') ?>
<script>
    $(document ).ready(function(){
    $("#sidebar_menu_dataKaryawan").addClass("active");
    $("#sidebar_menu_ajukanKegiatan").addClass("active");
      $("#tanggal").datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        todayHighlight: true,
        format: 'yyyy-mm-dd'
      });
    });
  </script>

</body>
</html>