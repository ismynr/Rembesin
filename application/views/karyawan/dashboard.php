<?php
  $tbMr = "tb_master_rembes";
  $tbR = "tb_rembes";
  $tbKry = "tb_karyawan";

  $getIdKaryawan = $this->db->get_where($tbKry, ['id_user'=>$this->session->userdata('id_user')])->row();

  $getMrembes = $this->db->get_where($tbMr, ["id_karyawan"=>$getIdKaryawan->id_karyawan])->num_rows();
  // $getRembes = $this->db->get_where($tbR)->num_rows();
  $getRembes = $this->db->query('SELECT * FROM tb_master_rembes INNER JOIN tb_rembes ON tb_master_rembes.id_master_rembes=tb_rembes.id_master_rembes WHERE tb_master_rembes.id_karyawan='.$getIdKaryawan->id_karyawan.'')->num_rows();

  $getRUnclaimed = $this->db->get_where($tbMr, ["status"=>"0","id_karyawan"=>$getIdKaryawan->id_karyawan])->num_rows();
  $getRClaimed = $this->db->get_where($tbMr, ["status"=>"1","id_karyawan"=>$getIdKaryawan->id_karyawan])->num_rows();
  $getRUnsubmited = $this->db->get_where($tbMr, ["submit"=>"0","status"=>"0","id_karyawan"=>$getIdKaryawan->id_karyawan])->num_rows();
  $getRSubmited = $this->db->get_where($tbMr, ["submit"=>"1","status"=>"0","id_karyawan"=>$getIdKaryawan->id_karyawan])->num_rows();
  


  $getKaryawan=$this->db->get_where("tb_karyawan", ["id_user" => $this->session->userdata('id_user')])->row();
  $getSumLumpsum = $this->db->query("SELECT SUM(uang_lumpsum) as uang_lumpsum from tb_master_rembes inner join tb_karyawan on tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan inner join tb_perusahaan on tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan inner join (SELECT id_master_rembes, SUM(total_rembes) AS total_rembes FROM tb_rembes GROUP BY id_master_rembes) AS rmb  on rmb.id_master_rembes = tb_master_rembes.id_master_rembes where tb_master_rembes.status = '0' AND tb_karyawan.id_karyawan = '$getKaryawan->id_karyawan'")->row();
  $getSumRembes = $this->db->query("SELECT SUM(total_rembes) as total_rembes from tb_master_rembes inner join tb_karyawan on tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan inner join tb_perusahaan on tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan inner join (SELECT id_master_rembes, SUM(total_rembes) AS total_rembes FROM tb_rembes GROUP BY id_master_rembes) AS rmb  on rmb.id_master_rembes = tb_master_rembes.id_master_rembes where tb_master_rembes.status = '0' AND tb_karyawan.id_karyawan = '$getKaryawan->id_karyawan'")->row();

  $getLastLogin = $this->db->get_where("tb_user", ['id_user'=>$this->session->userdata('id_user')])->row();
 ?>
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

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 float-left">Dashboard</h1>
            <h6 class=" mb-0 text-gray-800 float-right">Last Login : <?= date("d, M Y H:i:s", strtotime($getLastLogin->logged_at)) ?></h6>
          </div>

          <div class="card bg-purple mb-3">
              <div class="card-body p-3">
                <h5 class="m-0 font-weight-bold text-white">Data Rembes</h5>
              </div>
            </div>
          <div class="row mb-5">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kegiatan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getMrembes ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nota Rembes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getRembes ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-receipt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card bg-info mb-3">
              <div class="card-body p-3">
                <h5 class="m-0 font-weight-bold text-white">Ringkasan Nota</h5>
              </div>
            </div>
          <div class="row mb-5">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-3 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rembes Unclaimed</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getRUnclaimed ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-3 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rembes Claimed</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getRClaimed ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rembes Unsubmited</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getRUnsubmited ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-list-ul fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rembes Submited</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getRSubmited ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tasks fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card bg-pink mb-3">
              <div class="card-body p-3">
                <h5 class="m-0 font-weight-bold text-white">Total Keuangan Rembes (unclaimed)</h5>
              </div>
            </div>
          <div class="row mb-5">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-4 mb-4">
              <div class="card border-left-pink shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-pink text-uppercase mb-1">Uang Yang Belum Dirembes</div>
                      <?php $utangPerusahaan = $getSumLumpsum->uang_lumpsum - $getSumRembes->total_rembes != null ? $getSumLumpsum->uang_lumpsum - $getSumRembes->total_rembes:"0" ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?=  number_format($getSumLumpsum->uang_lumpsum < $getSumRembes->total_rembes ? substr($utangPerusahaan,1) :"0",0,',','.')?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comment-dollar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-4 mb-4">
              <div class="card border-left-pink shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-pink text-uppercase mb-1">Uang Dinas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($getSumLumpsum->uang_lumpsum != null ? $getSumLumpsum->uang_lumpsum:"0",0,',','.') ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="card border-left-pink shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-pink text-uppercase mb-1">Uang Dinas Terpakai</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($getSumRembes->total_rembes,0,',','.') ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-funnel-dollar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header  bg-primary py-3">
              <h5 class="m-0 font-weight-bold text-white float-left">Activity Log</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                    <th>Waktu</th>
                    <!-- <th>User</th>
                    <th>Role</th> -->
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

	  <?php $this->load->view("karyawan/_partials/modal.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("karyawan/_partials/modal.php") ?>

<?php $this->load->view("karyawan/_partials/js_footer.php") ?>
<script>
  $(document).ready(function(){
    $("#sidebar_menu_dashboard").addClass("active");
  });

  $(document).ready(function(){
    $("#sidebar_menu_dashboard").addClass("active");
     var table = $('#dataTable').DataTable({
      // "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= base_url('karyawan/dashboard/activity_log/fetch') ?>",
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
