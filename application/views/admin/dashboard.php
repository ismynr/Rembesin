<?php 
$tbKry = "tb_karyawan";
$tbPrs = "tb_perusahaan";
$tbUsr = "tb_user";
$getCountPerusahaan = $this->db->get_where($tbPrs)->num_rows();
$getCountKaryawan = $this->db->get_where($tbKry)->num_rows();
$getCountKaryawan = $this->db->get_where($tbKry)->num_rows();
$getLastLogin = $this->db->get_where($tbUsr, ['id_user'=>$this->session->userdata('id_user')])->row();
 ?>
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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 float-left">Dashboard</h1>
            <h6 class=" mb-0 text-gray-800 float-right">Last Login : <?= date("d, M Y H:i:s", strtotime($getLastLogin->logged_at)) ?></h6>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Perusahaan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getCountPerusahaan ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Karyawan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getCountKaryawan ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
          </div>

         
          <div class="card shadow mb-4">
            <div class="card-header bg-admin py-3">
              <h5 class="m-0 font-weight-bold text-white float-left">Activity Log</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                    <th>Waktu</th>
                    <th>User</th>
                    <th>Role</th>
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

	  <?php $this->load->view("admin/_partials/footer.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("admin/_partials/modal.php") ?>

<?php $this->load->view("admin/_partials/js_footer.php") ?>
<script>
  $(document).ready(function(){
    $("#sidebar_menu_dashboard").addClass("active");
     var table = $('#dataTable').DataTable({
      // "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('admin/dashboard/actifity_log/fetch') ?>",
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
  });
</script>
</body>
</html>


