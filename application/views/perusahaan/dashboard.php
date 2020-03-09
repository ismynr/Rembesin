<?php 
$id_user = $this->session->userdata('id_user');
$getPerusahaan = $this->db->query("SELECT * FROM tb_perusahaan WHERE id_user='".$id_user."'")->row();
$getAllKaryawan = $this->db->query("SELECT * FROM tb_karyawan WHERE id_perusahaan='".$getPerusahaan->id_perusahaan."'")->row();
$getCountKaryawan = $this->db->query("SELECT COUNT(*) AS count FROM tb_karyawan WHERE id_perusahaan='".$getPerusahaan->id_perusahaan."'")->row();

$queryMr = "SELECT COUNT(*) as count FROM tb_master_rembes INNER JOIN tb_karyawan ON tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan INNER JOIN tb_perusahaan ON tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan ";
$queryR = "SELECT COUNT(*) as count FROM tb_rembes INNER JOIN tb_master_rembes ON tb_master_rembes.id_master_rembes=tb_rembes.id_master_rembes INNER JOIN tb_karyawan ON tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan INNER JOIN tb_perusahaan ON tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan ";

$getCountKegiatan = $this->db->query("$queryMr WHERE tb_perusahaan.id_perusahaan = '".$getPerusahaan->id_perusahaan."'")->row();
$getCountRembes = $this->db->query("$queryR WHERE tb_perusahaan.id_perusahaan = '".$getPerusahaan->id_perusahaan."'")->row();
$getCountUnsubmit = $this->db->query("$queryMr WHERE tb_perusahaan.id_perusahaan = '".$getPerusahaan->id_perusahaan."' AND tb_master_rembes.submit = '0'")->row();
$getCountSubmit = $this->db->query("$queryMr WHERE tb_perusahaan.id_perusahaan = '".$getPerusahaan->id_perusahaan."' AND tb_master_rembes.submit = '1'")->row();
$getCountRembesUnsubmit = $this->db->query("$queryR WHERE tb_perusahaan.id_perusahaan = '".$getPerusahaan->id_perusahaan."' AND tb_master_rembes.submit='0'")->row();
$getCountRembesSubmit = $this->db->query("$queryR WHERE tb_perusahaan.id_perusahaan = '".$getPerusahaan->id_perusahaan."' AND tb_master_rembes.submit='1'")->row();
$getCountUnclaimed = $this->db->query("$queryMr WHERE tb_master_rembes.status = '0' AND tb_master_rembes.submit = '1' AND tb_perusahaan.id_perusahaan = '".$getPerusahaan->id_perusahaan."' AND tb_master_rembes.tanggal_submit > NOW() + INTERVAL -3 DAY ")->row();
$getCountClaimed = $this->db->query("$queryMr WHERE tb_master_rembes.status = '1' AND tb_master_rembes.submit = '1' AND tb_perusahaan.id_perusahaan = '".$getPerusahaan->id_perusahaan."'")->row();
$getCountUrgent = $this->db->query("$queryMr WHERE tb_master_rembes.status = '0' AND tb_master_rembes.submit = '1' AND tb_perusahaan.id_perusahaan = '".$getPerusahaan->id_perusahaan."' AND tb_master_rembes.tanggal_submit < NOW() + INTERVAL -3 DAY ")->row();

$get_id_perusahaan=$this->db->get_where("tb_perusahaan", ["id_user" => $this->session->userdata('id_user')])->row();
$getSumLumpsum = $this->db->query("SELECT SUM(uang_lumpsum) as uang_lumpsum from tb_master_rembes inner join tb_karyawan on tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan inner join tb_perusahaan on tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan inner join (SELECT id_master_rembes, SUM(total_rembes) AS total_rembes FROM tb_rembes GROUP BY id_master_rembes) AS rmb  on rmb.id_master_rembes = tb_master_rembes.id_master_rembes where tb_master_rembes.status = '0' AND tb_master_rembes.submit = '1' AND tb_perusahaan.id_perusahaan = '$get_id_perusahaan->id_perusahaan'")->row();
$getSumRembes = $this->db->query("SELECT SUM(total_rembes) as total_rembes from tb_master_rembes inner join tb_karyawan on tb_master_rembes.id_karyawan=tb_karyawan.id_karyawan inner join tb_perusahaan on tb_karyawan.id_perusahaan=tb_perusahaan.id_perusahaan inner join (SELECT id_master_rembes, SUM(total_rembes) AS total_rembes FROM tb_rembes GROUP BY id_master_rembes) AS rmb  on rmb.id_master_rembes = tb_master_rembes.id_master_rembes where tb_master_rembes.status = '0' AND tb_master_rembes.submit = '1' AND tb_perusahaan.id_perusahaan = '$get_id_perusahaan->id_perusahaan'")->row();


$getLastLogin = $this->db->get_where("tb_user", ['id_user'=>$this->session->userdata('id_user')])->row();
 ?>
 
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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 float-left">Dashboard</h1>
            <h6 class=" mb-0 text-gray-800 float-right">Last Login : <?= date("d, M Y H:i:s", strtotime($getLastLogin->logged_at)) ?></h6>
          </div>

          <!-- Content Row -->
          <div class="card mb-3 bg-purple">
            <div class="card-body p-3">
              <h5 class="m-0 font-weight-bold text-white">Data Keseluruhan </h5>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md-4 mb-4">
              <div class="card border-left-purple shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-purple text-uppercase mb-1">Karyawan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getCountKaryawan->count ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-4 mb-4">
              <div class="card border-left-purple shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-purple text-uppercase mb-1">Kegiatan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getCountKegiatan->count ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-4 mb-4">
              <div class="card border-left-purple shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-purple text-uppercase mb-1">Rembes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getCountRembes->count ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="far fa-list-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-3 bg-info">
            <div class="card-body p-3">
              <h5 class="m-0 font-weight-bold text-white">Rincian Kegiatan </h5>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kegiatan Belum DiSubmit</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <table class="table table-borderless table-sm m-0">
                          <tr>
                            <th width="30%">Kegiatan : </th>
                            <th width="30%"><?= $getCountUnsubmit->count ?></th>
                            <th width="30%">Nota : </th>
                            <th><?= $getCountRembesUnsubmit->count ?></th>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-list-ul fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kegiatan Sudah Disubmit</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <table class="table table-borderless table-sm m-0">
                          <tr>
                            <th width="30%">Kegiatan : </th>
                            <th width="30%"><?= $getCountSubmit->count ?></th>
                            <th width="30%">Nota : </th>
                            <th><?= $getCountRembesSubmit->count ?></th>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tasks fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="card mb-3 bg-orange">
            <div class="card-body p-3">
              <h5 class="m-0 font-weight-bold text-white">Data Rembes</h5>
            </div>
          </div>
          <div class="row mb-5">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-4 mb-4">
              <div class="card border-left-orange shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-orange text-uppercase mb-1">Rembes Unclaimed</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getCountUnclaimed->count ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-4 mb-4">
              <div class="card border-left-orange shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-orange text-uppercase mb-1">Rembes Unclaimed (Urgent)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getCountUrgent->count?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 mb-4">
              <div class="card border-left-orange shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-orange text-uppercase mb-1">Rembes Claimed</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $getCountClaimed->count ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-3 bg-pink">
            <div class="card-body p-3">
              <h5 class="m-0 font-weight-bold text-white">Keuangan Rembes (unclaimed)</h5>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md-6 mb-4">
              <div class="card border-left-pink shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-pink text-uppercase mb-1">Pengeluaran</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= $getSumLumpsum->uang_lumpsum != null ? number_format($getSumLumpsum->uang_lumpsum,0,',','.'):"0" ?></div>

                    </div>
                    <div class="col-auto">
                      <i class="fas fa-external-link-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-6 mb-4">
              <div class="card border-left-pink shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-pink text-uppercase mb-1">Rembes Harus Dibayar</div>
                      <?php $utang = $getSumLumpsum->uang_lumpsum - $getSumRembes->total_rembes; ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= $getSumLumpsum->uang_lumpsum < $getSumRembes->total_rembes ? number_format(substr($utang,1),0,',','.'):"0" ?></div>

                    </div>
                    <div class="col-auto">
                      <i class="far fa-money-bill-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header bg-company py-3">
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
        <!-- Content fluid -->

  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

	  <?php $this->load->view("perusahaan/_partials/modal.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("perusahaan/_partials/modal.php") ?>

<?php $this->load->view("perusahaan/_partials/js_footer.php") ?>

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
        url:"<?= base_url('perusahaan/dashboard/activity_log/fetch') ?>",
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
